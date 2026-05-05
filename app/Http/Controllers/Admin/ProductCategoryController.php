<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductCategoryController extends Controller
{
    public function index()
    {
        $categories = ProductCategory::query()
            ->orderByDesc('id')
            ->get();

        return view('screens.admin.product-categories.index', get_defined_vars());
    }

    public function update(Request $request, ProductCategory $category): JsonResponse|Response
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/|unique:product_categories,slug,'.$category->id,
            'status' => 'required|string|in:active,inactive',
        ], [
            'slug.regex' => __('Use lowercase letters, numbers, and single hyphens only (e.g. my-category).'),
        ]);

        $category->update($validated);

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => __('Category updated successfully.'),
                'data' => [
                    'id' => $category->id,
                    'name' => $category->name,
                    'slug' => $category->slug,
                    'status' => $category->status,
                ],
            ]);
        }

        return redirect()
            ->route('product-categories.index')
            ->with('success', __('Category updated successfully.'));
    }

    public function destroy(Request $request, ProductCategory $category): JsonResponse|Response
    {
        if ($category->products()->exists()) {
            $message = __('Cannot delete this category while it still has products. Reassign or remove those products first.');

            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => $message,
                ], 422);
            }

            return redirect()
                ->route('product-categories.index')
                ->with('error', $message);
        }

        $category->delete();

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => __('Category deleted successfully.'),
            ]);
        }

        return redirect()
            ->route('product-categories.index')
            ->with('success', __('Category deleted successfully.'));
    }
}
