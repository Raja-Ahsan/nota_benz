<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductAttribute;

class StoreController extends Controller
{
    public function index()
    {
        $products = Product::with([
            'category',
            'productType',
            'images',
            'variations',
        ])->get();

        return view('screens.web.artifacts.index', get_defined_vars());
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
