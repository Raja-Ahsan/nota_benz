<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\ProductCategory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    private const ARTIFACTS_PER_PAGE = 16;

    public function index()
    {
        $products = $this->artifactProductsBaseQuery()->paginate(self::ARTIFACTS_PER_PAGE);

        $categories = ProductCategory::query()
            ->where('status', 'active')
            ->orderBy('name')
            ->get();

        return view('screens.web.artifacts.index', compact('products', 'categories'));
    }

    public function filterArtifacts(Request $request): JsonResponse
    {
        $data = $request->validate([
            'search' => 'nullable|string|max:120',
            'category_id' => 'nullable|integer|exists:product_categories,id',
            'type' => 'nullable|in:all,simple,variable',
            'price_min' => 'nullable|numeric|min:0',
            'price_max' => 'nullable|numeric|min:0',
        ]);

        if (isset($data['price_min'], $data['price_max']) && (float) $data['price_max'] < (float) $data['price_min']) {
            return response()->json(['message' => __('Invalid price range.')], 422);
        }

        $query = $this->artifactProductsBaseQuery();
        $this->applyArtifactFilters($query, $data);

        $products = $query->paginate(self::ARTIFACTS_PER_PAGE)->withQueryString();

        return response()->json([
            'html' => view('screens.web.artifacts.partials.product-grid', compact('products'))->render(),
            'count' => $products->total(),
            'current_page' => $products->currentPage(),
            'last_page' => $products->lastPage(),
            'next_page' => $products->currentPage() + 1,
            'has_more' => $products->hasMorePages(),
        ]);
    }

    private function artifactProductsBaseQuery(): Builder
    {
        return Product::query()
            ->with([
                'category',
                'productType',
                'images',
                'variations',
            ])
            ->latest();
    }

    /**
     * @param  array<string, mixed>  $filters
     */
    private function applyArtifactFilters(Builder $query, array $filters): void
    {
        if (! empty($filters['search'])) {
            $term = '%'.addcslashes($filters['search'], '%_\\').'%';
            $query->where('name', 'like', $term);
        }

        if (! empty($filters['category_id'])) {
            $query->where('category_id', (int) $filters['category_id']);
        }

        $type = $filters['type'] ?? 'all';
        if ($type === 'simple' || $type === 'variable') {
            $query->whereHas('productType', fn (Builder $q) => $q->where('slug', $type));
        }

        $min = $filters['price_min'] ?? null;
        $max = $filters['price_max'] ?? null;
        if ($min === null && $max === null) {
            return;
        }

        $query->where(function (Builder $outer) use ($min, $max) {
            $outer->where(function (Builder $q) use ($min, $max) {
                $q->whereHas('productType', fn (Builder $t) => $t->where('slug', 'simple'));
                if ($min !== null) {
                    $q->where('price', '>=', $min);
                }
                if ($max !== null) {
                    $q->where('price', '<=', $max);
                }
            })->orWhere(function (Builder $q) use ($min, $max) {
                $q->whereHas('productType', fn (Builder $t) => $t->where('slug', 'variable'));
                if ($min !== null && $max !== null) {
                    $q->whereNotNull('from_price')
                        ->whereNotNull('to_price')
                        ->where('from_price', '<=', $max)
                        ->where('to_price', '>=', $min);
                } elseif ($min !== null) {
                    $q->whereNotNull('to_price')->where('to_price', '>=', $min);
                } elseif ($max !== null) {
                    $q->whereNotNull('from_price')->where('from_price', '<=', $max);
                }
            });
        });
    }

    public function show(Product $product)
    {
        $product->load([
            'category',
            'productType',
            'images' => fn ($q) => $q->orderBy('sort_order'),
            'variations.values',
            'variations.image',
        ]);

        $galleryImages = $product->images
            ->filter(fn ($img) => $img->product_attribute_item_id === null && $img->product_variation_id === null)
            ->sortBy('sort_order')
            ->values();

        $primaryGallery = $galleryImages->firstWhere('is_primary', true) ?? $galleryImages->first();
        $defaultMainImage = $primaryGallery?->publicUrl()
            ?: asset('assets/images/placeholders/img-not-available.png');

        $isVariable = $product->isVariable()
            && $product->variations->isNotEmpty();

        $usedAttributeIds = $product->variations
            ->flatMap(fn ($v) => $v->values->pluck('product_attribute_id'))
            ->unique()
            ->sort()
            ->values();

        $dimensionModels = ProductAttribute::query()
            ->whereIn('id', $usedAttributeIds)
            ->orderBy('name')
            ->get();

        $dimensions = $dimensionModels->map(fn ($a) => [
            'id' => (int) $a->id,
            'name' => $a->name,
        ])->values()->all();

        $variationsPayload = $product->variations
            ->sortBy('sort_order')
            ->values()
            ->map(function ($v) {
                $opts = [];
                foreach ($v->values as $val) {
                    $opts[(string) $val->product_attribute_id] = $val->value;
                }

                return [
                    'id' => $v->id,
                    'price' => (float) $v->price,
                    'imageUrl' => $v->image?->publicUrl() ?: '',
                    'options' => $opts,
                ];
            })
            ->all();

        $galleryImageUrls = $galleryImages
            ->map(fn ($img) => $img->publicUrl())
            ->filter()
            ->values()
            ->all();

        $matrixPayload = [
            'dimensions' => $dimensions,
            'variations' => $variationsPayload,
            'defaultMain' => $defaultMainImage,
            'galleryUrls' => $galleryImageUrls,
        ];

        return view('screens.web.artifacts.show', compact(
            'product',
            'galleryImages',
            'defaultMainImage',
            'isVariable',
            'galleryImageUrls',
            'matrixPayload',
        ));
    }
}
