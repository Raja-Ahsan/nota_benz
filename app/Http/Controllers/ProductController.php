<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\ProductCategory;
use App\Models\ProductImage;
use App\Models\ProductType;
use App\Models\ProductVariation;
use App\Models\ProductVariationValue;
use App\Support\ProductPublicImage;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::query()
            ->with(['category', 'productType'])
            ->latest()
            ->get();

        return view('screens.admin.products.index', compact('products'));
    }

    public function show(Product $product)
    {
        $product->load([
            'category',
            'productType',
            'images',
            'variations.values.productAttribute',
            'variations.image',
        ]);

        $categories = ProductCategory::query()->where('status', 'active')->orderBy('name')->get();
        $productTypes = ProductType::query()->orderBy('name')->get();
        $variationAttributes = ProductAttribute::query()->orderBy('name')->get();
        $galleryImages = $product->images
            ->filter(fn (ProductImage $img) => $this->isGalleryImage($img))
            ->values();

        return view('screens.admin.products.show', compact(
            'product',
            'categories',
            'productTypes',
            'variationAttributes',
            'galleryImages'
        ));
    }

    public function edit(Product $product)
    {
        $categories = ProductCategory::query()
            ->where('status', 'active')
            ->orderBy('name')
            ->get();

        $productTypes = ProductType::query()->orderBy('name')->get();

        $variationAttributes = ProductAttribute::query()
            ->orderBy('name')
            ->get();

        $variationDefinitions = $variationAttributes->map(fn (ProductAttribute $a) => [
            'id' => $a->id,
            'name' => $a->name,
        ])->values();

        $product->load([
            'images',
            'variations.values',
            'variations.image',
        ]);

        return view('screens.admin.products.edit', compact(
            'product',
            'categories',
            'productTypes',
            'variationAttributes',
            'variationDefinitions'
        ));
    }

    public function create()
    {
        $categories = ProductCategory::query()
            ->where('status', 'active')
            ->orderBy('name')
            ->get();

        $productTypes = ProductType::query()->orderBy('name')->get();

        $variationAttributes = ProductAttribute::query()
            ->orderBy('name')
            ->get();

        $variationDefinitions = $variationAttributes->map(fn (ProductAttribute $a) => [
            'id' => $a->id,
            'name' => $a->name,
        ])->values();

        return view('screens.admin.products.create', compact(
            'categories',
            'productTypes',
            'variationAttributes',
            'variationDefinitions'
        ));
    }

    public function store(Request $request)
    {
        $base = $request->validate([
            'category_id' => 'required|exists:product_categories,id',
            'product_type_id' => 'required|exists:product_types,id',
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:active,inactive',
            'price' => 'nullable|numeric|min:0',
            'from_price' => 'nullable|numeric|min:0',
            'to_price' => 'nullable|numeric|min:0',
            'images' => 'nullable|array',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif',
        ]);

        $type = ProductType::query()->findOrFail($base['product_type_id']);

        if ($type->slug === 'simple') {
            $request->validate([
                'price' => 'required|numeric|min:0',
            ]);
        }

        if ($type->slug === 'variable') {
            $request->validate([
                'from_price' => 'required|numeric|min:0',
                'to_price' => ['required', 'numeric', 'min:0', 'gte:from_price'],
            ]);
        }

        $variationAttributes = ProductAttribute::query()->orderBy('name')->get();
        $normalizedVariationRows = $this->validatedVariationRows($request, $type, $variationAttributes);

        $slugSource = $request->filled('slug') ? $request->input('slug') : $request->input('name');
        $slug = $this->uniqueProductSlug((string) $slugSource);

        DB::transaction(function () use ($request, $base, $type, $normalizedVariationRows, $slug) {
            $price = $type->slug === 'simple' ? $request->input('price') : 0;

            $product = Product::create([
                'category_id' => $base['category_id'],
                'name' => $base['name'],
                'slug' => $slug,
                'product_type_id' => $type->id,
                'price' => $price,
                'from_price' => $type->slug === 'variable' ? $request->input('from_price') : null,
                'to_price' => $type->slug === 'variable' ? $request->input('to_price') : null,
                'description' => $base['description'],
                'status' => $base['status'],
                'created_by' => auth()->id(),
            ]);

            $this->syncGalleryFromRequest($request, $product);
            if ($type->slug === 'variable' && $normalizedVariationRows !== []) {
                $this->replaceProductVariationsFromRequest($request, $product, $normalizedVariationRows, null);
            }
            $this->normalizeProductImagesOrder($product->fresh());
        });

        return response()->json([
            'success' => true,
            'message' => 'Product created successfully',
            'redirect' => route('products.index'),
        ]);
    }

    public function update(Request $request, Product $product)
    {
        $type = $product->productType()->firstOrFail();

        $slugRaw = trim((string) $request->input('slug', ''));
        $request->merge(['slug' => $slugRaw === '' ? null : $slugRaw]);

        $base = $request->validate([
            'category_id' => 'required|exists:product_categories,id',
            'name' => 'required|string|max:255',
            'slug' => ['nullable', 'string', 'max:255', Rule::unique('products', 'slug')->ignore($product->id)],
            'description' => 'nullable|string',
            'status' => 'required|in:active,inactive',
            'price' => 'nullable|numeric|min:0',
            'from_price' => 'nullable|numeric|min:0',
            'to_price' => 'nullable|numeric|min:0',
            'images' => 'nullable|array',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif',
        ]);

        if ($type->slug === 'simple') {
            $request->validate([
                'price' => 'required|numeric|min:0',
            ]);
        }

        if ($type->slug === 'variable') {
            $request->validate([
                'from_price' => 'required|numeric|min:0',
                'to_price' => ['required', 'numeric', 'min:0', 'gte:from_price'],
            ]);
        }

        $variationAttributes = ProductAttribute::query()->orderBy('name')->get();
        $normalizedVariationRows = $this->validatedVariationRows($request, $type, $variationAttributes);

        $slug = $slugRaw !== ''
            ? $this->uniqueProductSlug($slugRaw, $product->id)
            : $product->slug;

        DB::transaction(function () use ($request, $base, $type, $normalizedVariationRows, $product, $slug) {
            $price = $type->slug === 'simple' ? $request->input('price') : 0;

            $product->update([
                'category_id' => $base['category_id'],
                'name' => $base['name'],
                'slug' => $slug,
                'price' => $price,
                'from_price' => $type->slug === 'variable' ? $request->input('from_price') : null,
                'to_price' => $type->slug === 'variable' ? $request->input('to_price') : null,
                'description' => $base['description'],
                'status' => $base['status'],
                'updated_by' => auth()->id(),
            ]);

            $galleryFiles = $request->file('images');
            if ($galleryFiles instanceof UploadedFile) {
                $galleryFiles = [$galleryFiles];
            } elseif (! is_array($galleryFiles)) {
                $galleryFiles = [];
            }

            $newGalleryFiles = [];
            foreach ($galleryFiles as $file) {
                if ($file && $file->isValid()) {
                    $newGalleryFiles[] = $file;
                }
            }

            if ($newGalleryFiles !== []) {
                $maxGallery = 5;
                $existingGalleryCount = $product->images()->whereNull('product_attribute_item_id')->whereNull('product_variation_id')->count();
                if ($existingGalleryCount + count($newGalleryFiles) > $maxGallery) {
                    throw ValidationException::withMessages([
                        'images' => ["You can have at most {$maxGallery} gallery images (including existing)."],
                    ]);
                }

                $sortOrder = (int) ($product->images()
                    ->whereNull('product_attribute_item_id')
                    ->whereNull('product_variation_id')
                    ->max('sort_order') ?? -1);
                foreach ($newGalleryFiles as $file) {
                    $path = ProductPublicImage::store($file);
                    $sortOrder++;
                    ProductImage::create([
                        'product_id' => $product->id,
                        'product_attribute_item_id' => null,
                        'product_variation_id' => null,
                        'image' => $path,
                        'is_primary' => false,
                        'sort_order' => $sortOrder,
                        'created_by' => auth()->id(),
                    ]);
                }
            }

            $preservedVariationImagePaths = null;
            if ($type->slug === 'variable') {
                $preservedVariationImagePaths = $product->variations()
                    ->with('image')
                    ->orderBy('sort_order')
                    ->get()
                    ->map(fn (ProductVariation $v) => $v->image?->image)
                    ->all();
            }

            $product->attributeItems()->delete();

            if ($type->slug === 'variable') {
                $this->replaceProductVariationsFromRequest($request, $product, $normalizedVariationRows, $preservedVariationImagePaths);
            } else {
                $this->replaceProductVariationsFromRequest($request, $product, [], null);
            }

            $this->normalizeProductImagesOrder($product->fresh());
        });

        return response()->json([
            'success' => true,
            'message' => 'Product updated successfully',
            'redirect' => route('products.index'),
        ]);
    }

    public function destroyGalleryImage(Request $request, Product $product, ProductImage $productImage)
    {
        abort_unless((int) $productImage->product_id === (int) $product->id, 404);
        abort_unless($productImage->product_attribute_item_id === null && $productImage->product_variation_id === null, 404);

        DB::transaction(function () use ($productImage) {
            $productImage->delete();
        });

        $this->normalizeProductImagesOrder($product->fresh());

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Image removed successfully',
            ]);
        }

        return redirect()->back()->with('success', 'Image removed successfully');
    }

    public function destroy(Request $request, Product $product)
    {
        DB::transaction(function () use ($product) {
            $this->unlinkProductImageFilesFromDisk($product);
            $product->delete();
        });

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Product deleted successfully.',
                'redirect' => route('products.index'),
            ]);
        }

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }

    private function isGalleryImage(ProductImage $img): bool
    {
        return $img->product_attribute_item_id === null && $img->product_variation_id === null;
    }

    /**
     * @return list<array{price: float, options: array<int, string>}>
     */
    private function validatedVariationRows(Request $request, ProductType $type, Collection $variationAttributes): array
    {
        if ($type->slug !== 'variable') {
            return [];
        }

        if ($variationAttributes->isEmpty()) {
            throw ValidationException::withMessages([
                'variation_rows' => __('Create attribute definitions (e.g. Size, Color) before adding a variable product.'),
            ]);
        }

        $attributeIds = $variationAttributes->pluck('id')->map(fn ($id) => (int) $id)->values()->all();

        $request->validate([
            'variation_rows' => ['required', 'array', 'min:1'],
            'variation_rows.*.price' => ['required', 'numeric', 'min:0'],
            'variation_rows.*.options' => ['required', 'array'],
            'variation_rows.*.image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,gif'],
        ]);

        $rows = $request->input('variation_rows', []);
        $signatures = [];
        $normalized = [];

        foreach ($rows as $idx => $row) {
            $opts = $row['options'] ?? [];
            $flat = [];

            foreach ($attributeIds as $aid) {
                $rawVal = $opts[(string) $aid] ?? $opts[$aid] ?? null;
                if ($rawVal === null || trim((string) $rawVal) === '') {
                    $label = $variationAttributes->firstWhere('id', $aid)?->name ?? (string) $aid;

                    throw ValidationException::withMessages([
                        "variation_rows.{$idx}.options.{$aid}" => __('Enter a value for :name on each row.', ['name' => $label]),
                    ]);
                }
                $flat[$aid] = trim((string) $rawVal);
            }

            $sig = collect($attributeIds)->map(fn (int $id) => mb_strtolower($flat[$id]))->join('|');
            if (isset($signatures[$sig])) {
                throw ValidationException::withMessages([
                    "variation_rows.{$idx}" => __('Duplicate row: the same combination of :attrs already exists.', ['attrs' => $variationAttributes->pluck('name')->join(', ')]),
                ]);
            }
            $signatures[$sig] = true;

            $normalized[] = [
                'price' => (float) $row['price'],
                'options' => $flat,
            ];
        }

        return $normalized;
    }

    /**
     * @param  list<array{price: float, options: array<int, string>}>  $normalizedRows
     * @param  list<string|null>|null  $preservedImagePaths  Indexed by row, relative paths for existing images
     */
    private function replaceProductVariationsFromRequest(Request $request, Product $product, array $normalizedRows, ?array $preservedImagePaths): void
    {
        $oldVariants = $product->variations()->with('image')->orderBy('sort_order')->get()->values();

        foreach ($oldVariants as $idx => $existing) {
            if ($existing->image) {
                $upload = $request->file("variation_rows.{$idx}.image");
                $hasNewValidImage = $upload instanceof UploadedFile && $upload->isValid();
                $preservedPath = is_array($preservedImagePaths) && array_key_exists($idx, $preservedImagePaths)
                    ? $preservedImagePaths[$idx]
                    : null;
                $preservedPath = is_string($preservedPath) ? trim($preservedPath) : '';
                $oldPath = trim((string) $existing->image->image);

                // Re-creating the same row with the same file path: only remove the DB row so the
                // `ProductImage` deleting observer does not unlink a file we still need.
                $reuseSameFileOnDisk = ! $hasNewValidImage
                    && $preservedPath !== ''
                    && $oldPath !== ''
                    && $oldPath === $preservedPath;

                if ($reuseSameFileOnDisk) {
                    DB::table('product_images')->where('id', $existing->image->id)->delete();
                } else {
                    $existing->image->delete();
                }
            }
            $existing->values()->delete();
            $existing->delete();
        }

        foreach ($normalizedRows as $idx => $row) {
            $variation = ProductVariation::create([
                'product_id' => $product->id,
                'price' => $row['price'],
                'sort_order' => $idx,
            ]);

            foreach ($row['options'] as $attrId => $value) {
                ProductVariationValue::create([
                    'product_variation_id' => $variation->id,
                    'product_attribute_id' => (int) $attrId,
                    'value' => $value,
                ]);
            }

            $path = null;
            $file = $request->file("variation_rows.{$idx}.image");
            if ($file && $file->isValid()) {
                $path = ProductPublicImage::store($file);
            } elseif (is_array($preservedImagePaths) && array_key_exists($idx, $preservedImagePaths)) {
                $path = $preservedImagePaths[$idx];
            }

            if ($path) {
                ProductImage::create([
                    'product_id' => $product->id,
                    'product_attribute_item_id' => null,
                    'product_variation_id' => $variation->id,
                    'image' => $path,
                    'is_primary' => false,
                    'sort_order' => 0,
                    'created_by' => auth()->id(),
                ]);
            }
        }
    }

    private function syncGalleryFromRequest(Request $request, Product $product): void
    {
        $sortOrder = 0;
        $primarySet = false;

        $galleryFiles = $request->file('images');
        if ($galleryFiles instanceof UploadedFile) {
            $galleryFiles = [$galleryFiles];
        } elseif (! is_array($galleryFiles)) {
            $galleryFiles = [];
        }

        foreach ($galleryFiles as $file) {
            if (! $file || ! $file->isValid()) {
                continue;
            }
            $path = ProductPublicImage::store($file);
            ProductImage::create([
                'product_id' => $product->id,
                'product_attribute_item_id' => null,
                'product_variation_id' => null,
                'image' => $path,
                'is_primary' => ! $primarySet,
                'sort_order' => $sortOrder,
                'created_by' => auth()->id(),
            ]);
            $primarySet = true;
            $sortOrder++;
        }
    }

    private function unlinkProductImageFilesFromDisk(Product $product): void
    {
        $product->loadMissing('images');
        foreach ($product->images as $img) {
            $raw = trim((string) $img->image);
            if ($raw === '' || preg_match('#^https?://#i', $raw)) {
                continue;
            }
            $path = str_replace('\\', '/', ltrim($raw, '/'));
            $full = public_path($path);
            if (is_file($full)) {
                @unlink($full);
            }
        }
    }

    private function uniqueProductSlug(string $source, ?int $ignoreProductId = null): string
    {
        $slug = Str::slug(trim($source));
        if ($slug === '') {
            $slug = 'product';
        }
        $base = $slug;
        $i = 2;
        while (Product::query()
            ->when($ignoreProductId, fn ($q) => $q->where('id', '!=', $ignoreProductId))
            ->where('slug', $slug)
            ->exists()) {
            $slug = $base.'-'.$i++;
        }

        return $slug;
    }

    private function normalizeProductImagesOrder(Product $product): void
    {
        $product->load(['images']);
        $gallery = $product->images->filter(fn (ProductImage $img) => $this->isGalleryImage($img))->sortBy('sort_order')->values();
        $options = $product->images->filter(fn (ProductImage $img) => ! $this->isGalleryImage($img))->sortBy('sort_order')->values();
        $ordered = $gallery->concat($options)->values();

        foreach ($ordered as $i => $img) {
            $img->update([
                'sort_order' => $i,
                'is_primary' => $i === 0,
            ]);
        }
    }
}
