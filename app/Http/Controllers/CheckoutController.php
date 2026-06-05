<?php

namespace App\Http\Controllers;

use App\Mail\GuestCheckoutWelcomeMail;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Stripe\PaymentIntent;
use Stripe\Stripe;

class CheckoutController extends Controller
{
    public function index()
    {
        $checkout = Cart::current();
        $user = Auth::user();

        if (! $checkout || $checkout->items->isEmpty()) {
            return redirect()
                ->route('cart.index')
                ->with('error', __('Your cart is empty.'));
        }

        $checkout->load(['items.product.images']);

        return view('screens.web.checkout.index', compact('checkout', 'user'));
    }

    public function success(Order $order)
    {
        if (! Auth::check()) {
            abort(403);
        }

        if ((int) $order->user_id !== (int) Auth::id()) {
            abort(403);
        }

        $order->load('items.product');

        return view('screens.web.order-success.index', compact('order'));
    }

    public function createPaymentIntent()
    {
        $cart = Cart::current();

        if (! $cart || $cart->items->isEmpty()) {
            return response()->json(['message' => 'Cart empty'], 422);
        }

        Stripe::setApiKey(config('services.stripe.secret'));

        $intent = PaymentIntent::create([
            'amount' => (int) ($cart->total() * 100),
            'currency' => 'usd',
            'metadata' => [
                'user_id' => Auth::check() ? (string) Auth::id() : 'guest',
                'cart_id' => (string) $cart->id,
            ],
        ]);

        return response()->json([
            'clientSecret' => $intent->client_secret,
            'payment_intent_id' => $intent->id,
        ]);
    }

    public function storeAfterPayment(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'payment_intent_id' => 'required|string',
            'billing_name' => 'required|string|max:255',
            'billing_email' => 'required|email',
            'billing_phone' => ['required', 'string', 'max:22', 'regex:/^[0-9+\-\s()]{7,22}$/'],
            'billing_address' => 'required|string',
            'billing_city' => 'required|string',
            'billing_state' => 'required|string',
            'billing_zip' => ['required', 'string', 'regex:/^[0-9]{3,10}$/'],
            'billing_country' => 'required|string',
            'shipping_name' => 'nullable|string|max:255',
            'shipping_email' => 'nullable|email|max:255',
            'shipping_phone' => 'nullable|string|max:22',
            'shipping_address' => 'nullable|string',
            'shipping_city' => 'nullable|string',
            'shipping_state' => 'nullable|string',
            'shipping_zip' => ['nullable', 'string', 'regex:/^[0-9]{3,10}$/'],
            'shipping_country' => 'nullable|string',
        ], [
            'billing_zip.regex' => __('ZIP / postal code must contain digits only (3–10 characters).'),
            'shipping_zip.regex' => __('Shipping ZIP must contain digits only (3–10 characters).'),
            'billing_phone.regex' => __('Enter a valid phone number.'),
        ]);

        Stripe::setApiKey(config('services.stripe.secret'));

        $intent = PaymentIntent::retrieve($validated['payment_intent_id']);

        if ($intent->status !== 'succeeded') {
            return response()->json([
                'message' => __('Payment not completed'),
            ], 422);
        }

        $existingOrder = Order::query()
            ->where('payment_intent_id', $intent->id)
            ->first();

        if ($existingOrder) {
            $existingOrder->loadMissing('user');

            return $this->checkoutSuccessResponse($request, $existingOrder, null);
        }

        $cart = Cart::current();

        if (! $cart || $cart->items->isEmpty()) {
            return response()->json([
                'message' => __('Cart empty — if you were charged, contact support with your payment receipt.'),
            ], 422);
        }

        $newAccountPassword = null;

        if (Auth::check()) {
            $user = Auth::user();
        } else {
            $email = mb_strtolower(trim($validated['billing_email']));
            $user = User::query()->whereRaw('LOWER(email) = ?', [$email])->first();

            if (! $user) {
                $newAccountPassword = Str::password(14, true, true, true, false);
                $user = User::create([
                    'name' => $validated['billing_name'],
                    'email' => $email,
                    'password' => $newAccountPassword,
                    'role' => config('roles.user'),
                ]);
            }
        }

        DB::beginTransaction();

        try {
            $order = Order::create([
                'user_id' => $user->id,
                'total_qty' => $cart->items->sum('qty'),
                'tax' => 0,
                'discount' => 0,
                'total' => $cart->total(),
                'payment_status' => 'paid',
                'order_status' => 'pending',
                'payment_method' => 'stripe',
                'payment_intent_id' => $intent->id,
            ]);

            $order->addresses()->create([
                'billing_name' => $request->billing_name,
                'billing_email' => $request->billing_email,
                'billing_phone' => $request->billing_phone,
                'billing_address' => $request->billing_address,
                'billing_city' => $request->billing_city,
                'billing_state' => $request->billing_state,
                'billing_zip' => $request->billing_zip,
                'billing_country' => $request->billing_country,
                'shipping_name' => $request->shipping_name,
                'shipping_email' => $request->shipping_email,
                'shipping_phone' => $request->shipping_phone,
                'shipping_address' => $request->shipping_address,
                'shipping_city' => $request->shipping_city,
                'shipping_state' => $request->shipping_state,
                'shipping_zip' => $request->shipping_zip,
                'shipping_country' => $request->shipping_country,
            ]);

            foreach ($cart->items as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'price' => $item->price,
                    'qty' => $item->qty,
                    'total' => $item->subtotal,
                ]);
            }

            $cart->items()->delete();
            $cart->delete();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'message' => __('Order failed'),
                'error' => $e->getMessage(),
            ], 500);
        }

        if ($newAccountPassword !== null) {
            try {
                Mail::to($user->email)->send(new GuestCheckoutWelcomeMail($user, $newAccountPassword, $order));
            } catch (\Throwable $e) {
                Log::error('Guest checkout welcome email failed', [
                    'message' => $e->getMessage(),
                    'user_id' => $user->id,
                    'order_id' => $order->id,
                ]);
            }
        }

        return $this->checkoutSuccessResponse($request, $order, $newAccountPassword);
    }

    private function checkoutSuccessResponse(Request $request, Order $order, ?string $newAccountPassword): JsonResponse
    {
        $order->loadMissing('user');

        if (Auth::check()) {
            return response()->json([
                'success' => true,
                'order_id' => $order->id,
            ]);
        }

        if ($newAccountPassword !== null) {
            Auth::login($order->user);

            return response()->json([
                'success' => true,
                'order_id' => $order->id,
            ]);
        }

        $request->session()->put('post_checkout_order_id', $order->id);

        return response()->json([
            'success' => true,
            'login_required' => true,
            'redirect_url' => route('login'),
            'message' => __('Your order is placed. Sign in with your existing password to view your confirmation.'),
        ]);
    }
}
