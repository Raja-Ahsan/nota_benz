<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->get();
        return view('screens.admin.products.index', get_defined_vars());
    }

    public function create()
    {
        return view('screens.admin.products.create');
    }
}
