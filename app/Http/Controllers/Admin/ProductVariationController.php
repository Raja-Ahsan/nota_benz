<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductVariationController extends Controller
{
    public function index()
    {
        return view('screens.admin.variations.index');
    }

    public function create()
    {
        return view('screens.admin.variations.create');
    }
    
    public function store(Request $request)
    {
        return response()->json([
            'success' => true,
            'message' => 'Variation created successfully',
            'redirect' => route('variations.index'),
        ]);
    }
}
