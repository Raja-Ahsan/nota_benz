<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\ProductVariation;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CartItemController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'product_id' => 'required|integer|exists:products,id',
            'qty' => 'nullable|integer|min:1|max:999',
            'product_variation_id' => [
                'nullable',
                'integer',
                Rule::exists('product_variations', 'id')->where(fn ($q) => $q->where('product_id', (int) $request->input('product_id'))),
            ],
        ]);

        $qty = isset($data['qty']) ? (int) $data['qty'] : 1;
        $qty = max(1, min(999, $qty));

        $product = Product::findOrFail($data['product_id']);

        $variation = null;
        if (! empty($data['product_variation_id'])) {
            $variation = ProductVariation::query()
                ->where('id', (int) $data['product_variation_id'])
                ->where('product_id', $product->id)
                ->first();
        }

        $unitPrice = $this->resolveLineUnitPrice($product, $variation);

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

        // 2️⃣ add or update item (merge qty if line already exists — standard storefront behavior)
        $item = $cart->items()->where('product_id', $product->id)->first();

        if ($item) {
            $item->increment('qty', $qty);
        } else {
            $cart->items()->create([
                'product_id' => $product->id,
                'qty' => $qty,
                'price' => $unitPrice,
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

    /**
     * Variable products store base price as 0; use the chosen variation or a safe fallback.
     */
    private function resolveLineUnitPrice(Product $product, ?ProductVariation $variation): float
    {
        if ($variation) {
            $p = (float) $variation->price;
            if ($p > 0) {
                return $p;
            }
        }

        $base = (float) $product->price;
        if ($base > 0) {
            return $base;
        }

        if ($product->isVariable()) {
            $from = (float) ($product->from_price ?? 0);
            if ($from > 0) {
                return $from;
            }
            $minVar = (float) ($product->variations()->min('price') ?? 0);
            if ($minVar > 0) {
                return $minVar;
            }
        }

        return max(0.0, $base);
    }
}
