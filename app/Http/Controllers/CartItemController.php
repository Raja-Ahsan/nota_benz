<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;

class CartItemController extends Controller
{
    public function store(Request $request)
    {
        $product = Product::findOrFail($request->product_id);

        // 1️⃣ identify user / session
        if (auth()->check()) {
            $cart = Cart::firstOrCreate([
                'user_id' => auth()->id(),
            ]);
        } else {
            $sessionId = session()->getId();
            $cart = Cart::firstOrCreate([
                'session_id' => $sessionId,
            ]);
        }

        // 2️⃣ add or update item
        $item = $cart->items()->where('product_id', $product->id)->first();

        if ($item) {
            $item->increment('qty');
        } else {
            $cart->items()->create([
                'product_id' => $product->id,
                'qty' => 1,
                'price' => $product->price,
            ]);
        }

        // 3️⃣ total count
        $count = $cart->items()->sum('qty');

        return response()->json([
            'success' => true,
            'count' => $count,
            'message' => 'Product added to cart',
        ]);
    }

    public function updateQty(Request $request, $id)
    {
        $item = CartItem::findOrFail($id);

        $qty = max(1, (int) $request->qty); // qty 1 se kam na ho
        $item->update(['qty' => $qty]);

        $cart = $item->cart;

        return response()->json([
            'success' => true,
            'qty' => $item->qty,
            'itemSubtotal' => $item->subtotal,        // number
            'cartSubtotal' => $cart->total(),          // number
            'cartTotal' => $cart->total(),              // number
            'cartCount' => $cart->items->sum('qty'),
        ]);
    }

    public function destroy($id)
    {
        $item = CartItem::findOrFail($id);
        $cart = $item->cart;

        $item->delete();

        return response()->json([
            'success' => true,
            'cartSubtotal' => $cart ? $cart->total() : 0,
            'cartTotal' => $cart ? $cart->total() : 0,
            'cartCount' => $cart ? $cart->items->sum('qty') : 0,
        ]);
    }
}
