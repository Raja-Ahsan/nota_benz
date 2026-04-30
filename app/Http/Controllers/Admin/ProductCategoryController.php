<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;

class ProductCategoryController extends Controller
{
    public function index()
    {
        $categories = ProductCategory::query()
            ->orderByDesc('id')
            ->get();

        return view('screens.admin.product-categories.index', get_defined_vars());
    }
}
