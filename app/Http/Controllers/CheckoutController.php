<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Stripe\PaymentIntent;
use Stripe\Stripe;

class CheckoutController extends Controller
{
    public function index()
    {
        $checkout = Cart::current();
        $user = auth()->user();

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
        if ($order->user_id !== auth()->id()) {
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
                'user_id' => auth()->id(),
                'cart_id' => $cart->id,
            ],
        ]);

        return response()->json([
            'clientSecret' => $intent->client_secret,
            'payment_intent_id' => $intent->id,
        ]);
    }

    public function storeAfterPayment(Request $request)
    {
        $validated = $request->validate([
            'payment_intent_id' => 'required|string',
            'billing_name' => 'required|string|max:255',
            'billing_email' => 'required|email',
            'billing_phone' => 'required|string|max:20',
            'billing_address' => 'required|string',
            'billing_city' => 'required|string',
            'billing_state' => 'required|string',
            'billing_zip' => 'required|string',
            'billing_country' => 'required|string',
            'shipping_name' => 'nullable|string|max:255',
            'shipping_email' => 'nullable|email|max:255',
            'shipping_phone' => 'nullable|string|max:20',
            'shipping_address' => 'nullable|string',
            'shipping_city' => 'nullable|string',
            'shipping_state' => 'nullable|string',
            'shipping_zip' => 'nullable|string',
            'shipping_country' => 'nullable|string',
        ]);

        Stripe::setApiKey(config('services.stripe.secret'));

        $intent = PaymentIntent::retrieve($request->payment_intent_id);

        if ($intent->status !== 'succeeded') {
            return response()->json([
                'message' => 'Payment not completed',
            ], 422);
        }

        $cart = Cart::current();

        if (! $cart || $cart->items->isEmpty()) {
            return response()->json(['message' => 'Cart empty'], 422);
        }

        DB::beginTransaction();

        try {
            $order = Order::create([
                'user_id' => auth()->id(),
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

            return response()->json([
                'success' => true,
                'order_id' => $order->id,
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'message' => 'Order failed',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
