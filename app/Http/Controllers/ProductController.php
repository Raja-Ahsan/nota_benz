<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\ProductAttributeItem;
use App\Models\ProductCategory;
use App\Models\ProductImage;
use App\Models\ProductType;
use App\Support\ProductPublicImage;
use Illuminate\Http\Request;
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
            'attributeItems.productAttribute',
            'attributeItems.image',
        ]);

        $categories = ProductCategory::query()->where('status', 'active')->orderBy('name')->get();
        $productTypes = ProductType::query()->orderBy('name')->get();
        $variationAttributes = ProductAttribute::query()->orderBy('name')->get();
        $galleryImages = $product->images->whereNull('product_attribute_item_id')->values();

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
            'attributeItems.productAttribute',
            'attributeItems.image',
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

        $productTypes = ProductType::query()
            ->orderBy('name')
            ->get();

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
            'images' => 'nullable|array',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif',
        ]);

        $type = ProductType::query()->findOrFail($base['product_type_id']);

        if ($type->slug === 'simple') {
            $request->validate([
                'price' => 'required|numeric|min:0',
            ]);
        }

        $variationItemsPayload = [];
        if ($type->slug === 'variable') {
            $request->validate([
                'variation_items' => 'required|array|min:1',
                'variation_items.*.product_attribute_id' => 'required|exists:product_attributes,id',
                'variation_items.*.name' => ['required', 'string', 'max:255', 'distinct'],
                'variation_items.*.price' => 'required|numeric|min:0',
                'variation_items.*.image' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif',
            ]);
            $variationItemsPayload = $request->input('variation_items', []);
        }

        $slugSource = $request->filled('slug') ? $request->input('slug') : $request->input('name');
        $slug = $this->uniqueProductSlug((string) $slugSource);

        DB::transaction(function () use ($request, $base, $type, $variationItemsPayload, $slug) {
            $price = $type->slug === 'simple' ? $request->input('price') : 0;

            $product = Product::create([
                'category_id' => $base['category_id'],
                'name' => $base['name'],
                'slug' => $slug,
                'product_type_id' => $type->id,
                'price' => $price,
                'description' => $base['description'],
                'status' => $base['status'],
                'created_by' => auth()->id(),
            ]);

            $this->syncProductMediaFromRequest($request, $product, $variationItemsPayload);
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
            'images' => 'nullable|array',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif',
        ]);

        if ($type->slug === 'simple') {
            $request->validate([
                'price' => 'required|numeric|min:0',
            ]);
        }

        $variationItemsPayload = [];
        if ($type->slug === 'variable') {
            $request->validate([
                'variation_items' => 'required|array|min:1',
                'variation_items.*.product_attribute_id' => 'required|exists:product_attributes,id',
                'variation_items.*.name' => ['required', 'string', 'max:255', 'distinct'],
                'variation_items.*.price' => 'required|numeric|min:0',
                'variation_items.*.image' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif',
            ]);
            $variationItemsPayload = $request->input('variation_items', []);
        }

        $slug = $slugRaw !== ''
            ? $this->uniqueProductSlug($slugRaw, $product->id)
            : $product->slug;

        DB::transaction(function () use ($request, $base, $type, $variationItemsPayload, $product, $slug) {
            $price = $type->slug === 'simple' ? $request->input('price') : 0;

            $product->update([
                'category_id' => $base['category_id'],
                'name' => $base['name'],
                'slug' => $slug,
                'price' => $price,
                'description' => $base['description'],
                'status' => $base['status'],
                'updated_by' => auth()->id(),
            ]);

            $galleryFiles = $request->file('images');
            if ($galleryFiles instanceof \Illuminate\Http\UploadedFile) {
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
                $existingGalleryCount = $product->images()->whereNull('product_attribute_item_id')->count();
                if ($existingGalleryCount + count($newGalleryFiles) > $maxGallery) {
                    throw ValidationException::withMessages([
                        'images' => ["You can have at most {$maxGallery} gallery images (including existing)."],
                    ]);
                }

                $sortOrder = (int) ($product->images()->whereNull('product_attribute_item_id')->max('sort_order') ?? -1);
                foreach ($newGalleryFiles as $file) {
                    $path = ProductPublicImage::store($file);
                    $sortOrder++;
                    ProductImage::create([
                        'product_id' => $product->id,
                        'product_attribute_item_id' => null,
                        'image' => $path,
                        'is_primary' => false,
                        'sort_order' => $sortOrder,
                        'created_by' => auth()->id(),
                    ]);
                }
            }

            $preservedOptionPaths = [];
            if ($type->slug === 'variable') {
                $preservedOptionPaths = $product->attributeItems()
                    ->with('image')
                    ->orderBy('id')
                    ->get()
                    ->map(fn (ProductAttributeItem $it) => $it->image?->image)
                    ->all();
            }

            $product->attributeItems()->delete();

            if ($type->slug === 'variable') {
                foreach ($variationItemsPayload as $idx => $row) {
                    $item = ProductAttributeItem::create([
                        'product_attribute_id' => $row['product_attribute_id'],
                        'product_id' => $product->id,
                        'name' => trim((string) $row['name']),
                        'price' => $row['price'],
                        'created_by' => auth()->id(),
                    ]);

                    $varImage = $request->file('variation_items.'.$idx.'.image');
                    $path = null;
                    if ($varImage && $varImage->isValid()) {
                        $path = ProductPublicImage::store($varImage);
                        $old = $preservedOptionPaths[$idx] ?? null;
                        if ($old && $old !== $path && is_file(public_path($old))) {
                            @unlink(public_path($old));
                        }
                    } else {
                        $path = $preservedOptionPaths[$idx] ?? null;
                    }

                    if ($path) {
                        ProductImage::create([
                            'product_id' => $product->id,
                            'product_attribute_item_id' => $item->id,
                            'image' => $path,
                            'is_primary' => false,
                            'sort_order' => 0,
                            'created_by' => auth()->id(),
                        ]);
                    }
                }
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
        abort_unless($productImage->product_attribute_item_id === null, 404);

        DB::transaction(function () use ($productImage) {
            $raw = trim((string) $productImage->image);
            if ($raw !== '' && ! preg_match('#^https?://#i', $raw)) {
                $full = public_path(str_replace('\\', '/', ltrim($raw, '/')));
                if (is_file($full)) {
                    @unlink($full);
                }
            }
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
        $gallery = $product->images->whereNull('product_attribute_item_id')->sortBy('sort_order')->values();
        $options = $product->images->whereNotNull('product_attribute_item_id')->sortBy('sort_order')->values();
        $ordered = $gallery->concat($options)->values();

        foreach ($ordered as $i => $img) {
            $img->update([
                'sort_order' => $i,
                'is_primary' => $i === 0,
            ]);
        }
    }

    private function syncProductMediaFromRequest(Request $request, Product $product, array $variationItemsPayload): void
    {
        $sortOrder = 0;
        $primarySet = false;

        $galleryFiles = $request->file('images');
        if ($galleryFiles instanceof \Illuminate\Http\UploadedFile) {
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
                'image' => $path,
                'is_primary' => ! $primarySet,
                'sort_order' => $sortOrder,
                'created_by' => auth()->id(),
            ]);
            $primarySet = true;
            $sortOrder++;
        }

        foreach ($variationItemsPayload as $idx => $row) {
            $item = ProductAttributeItem::create([
                'product_attribute_id' => $row['product_attribute_id'],
                'product_id' => $product->id,
                'name' => trim((string) $row['name']),
                'price' => $row['price'],
                'created_by' => auth()->id(),
            ]);

            $varImage = $request->file('variation_items.'.$idx.'.image');
            if ($varImage && $varImage->isValid()) {
                $path = ProductPublicImage::store($varImage);
                ProductImage::create([
                    'product_id' => $product->id,
                    'product_attribute_item_id' => $item->id,
                    'image' => $path,
                    'is_primary' => ! $primarySet,
                    'sort_order' => $sortOrder,
                    'created_by' => auth()->id(),
                ]);
                $primarySet = true;
                $sortOrder++;
            }
        }
    }
}
