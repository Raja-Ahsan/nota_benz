<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;

class ProductVariationController extends Controller
{
    public function index()
    {
        $variants = ProductVariant::with([
            'product',
            'attributeValues.productAttribute'
        ])->latest()->get();

        return view('screens.admin.product-variations.index', get_defined_vars());
    }

    public function create()
    {
        return view('screens.admin.product-variations.create');
    }
    
    public function store(Request $request)
    {
        return response()->json([
            'success' => true,
            'message' => 'Variation created successfully',
            'redirect' => route('product-variations.index'),
        ]);
    }
}
