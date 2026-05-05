<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class OrderController extends Controller
{
    public function index()
    {
        // get it specifically orders for company owner and get all orders for admin
        $user = current_user();
        if ($user->hasRole(config('roles.admin'))) {
            $orders = Order::with('user', 'items.product', 'addresses')->latest()->get();
        } elseif ($user->hasRole(config('roles.league_contractor'))) {
            $orders = Order::with('user', 'items.product', 'addresses')
                ->whereHas('items.product', function ($q) use ($user) {
                    $q->where('company_id', $user->company->id);
                })
                ->latest()
                ->get();
        } else {
            $orders = Order::with('user', 'items.product', 'addresses')->where('user_id', $user->id)->latest()->get();
        }

        return view('screens.admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $user = current_user();
        $isOwner = $order->user_id === $user->id;
        $isAdmin = $user->hasRole(config('roles.admin'));
        $isLeagueContractor = $user->hasRole(config('roles.league_contractor'));

        if ($isOwner || $isAdmin) {
            // Customer who placed order, or admin: allow
        } elseif ($isLeagueContractor && $user->company) {
            $hasProduct = $order->items()->whereHas('product', function ($q) use ($user) {
                $q->where('company_id', $user->company->id);
            })->exists();
            if (! $hasProduct) {
                abort(403, 'You can only view orders that contain your products.');
            }
        } else {
            abort(403);
        }

        $order->load('user', 'items.product', 'addresses');

        return view('screens.admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order): JsonResponse
    {
        $user = current_user();

        $allowedStatuses = [
            'pending',
            'processing',
            'shipped',
            'delivered',
            'completed',
            'cancelled',
        ];

        $isAdmin = $user->role === config('roles.admin');
        $contractorRole = config('roles.league_contractor');
        $isLeagueContractor = $contractorRole && $user->role === $contractorRole;

        if ($isAdmin) {
            // Full access
        } elseif ($isLeagueContractor && $user->company) {
            $hasProduct = $order->items()
                ->whereHas('product', function ($q) use ($user) {
                    $q->where('company_id', $user->company->id);
                })
                ->exists();

            if (! $hasProduct) {
                return response()->json(['message' => __('Unauthorized')], 403);
            }
        } else {
            return response()->json(['message' => __('Unauthorized')], 403);
        }

        $validated = $request->validate([
            'order_status' => ['required', 'string', Rule::in($allowedStatuses)],
        ]);

        $order->update([
            'order_status' => $validated['order_status'],
        ]);

        return response()->json([
            'message' => __('Order status updated successfully.'),
            'status' => $order->order_status,
        ]);
    }
}
