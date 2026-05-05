<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;

class HomeController extends Controller
{
    public function index(): View
    {
        return view('screens.web.home.index', [
            'galleryProducts' => $this->featuredGalleryProducts(),
        ]);
    }

    /**
     * Up to four active products, each from a different active category.
     * Deprioritizes the generic "all-products" bucket so the grid stays varied when possible.
     *
     * @return Collection<int, Product>
     */
    protected function featuredGalleryProducts(): Collection
    {
        $categories = ProductCategory::query()
            ->where('status', 'active')
            ->whereHas('products', fn ($q) => $q->where('status', 'active'))
            ->orderByRaw("CASE WHEN slug = 'all-products' THEN 1 ELSE 0 END")
            ->orderBy('id')
            ->limit(4)
            ->get();

        return $categories
            ->map(function (ProductCategory $category) {
                return Product::query()
                    ->where('status', 'active')
                    ->where('category_id', $category->id)
                    ->with(['category', 'images' => fn ($q) => $q->orderBy('sort_order'), 'productType'])
                    ->orderByDesc('id')
                    ->first();
            })
            ->filter()
            ->values();
    }
}
