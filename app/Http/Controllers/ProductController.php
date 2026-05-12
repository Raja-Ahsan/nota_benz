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
use Illuminate\Support\Facades\Storage;
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
        $variationAttributes = $this->fixedVariationAttributes();
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

        $variationAttributes = $this->fixedVariationAttributes();

        $variationDefinitions = $variationAttributes->map(fn (ProductAttribute $a) => [
            'id' => $a->id,
            'name' => $a->name,
        ])->values();

        $product->load([
            'images',
            'variations.values',
            'variations.image',
        ]);

        $wooInitialBlocks = $product->productType?->slug === 'variable'
            ? $this->buildWooInitialBlocksFromProduct($product, $variationAttributes)
            : [];

        return view('screens.admin.products.edit', compact(
            'product',
            'categories',
            'productTypes',
            'variationAttributes',
            'variationDefinitions',
            'wooInitialBlocks'
        ));
    }

    public function create()
    {
        $categories = ProductCategory::query()
            ->where('status', 'active')
            ->orderBy('name')
            ->get();

        $productTypes = ProductType::query()->orderBy('name')->get();

        $variationAttributes = $this->fixedVariationAttributes();

        $variationDefinitions = $variationAttributes->map(fn (ProductAttribute $a) => [
            'id' => $a->id,
            'name' => $a->name,
        ])->values();

        $wooInitialBlocks = [
            [
                'color' => '',
                'rows' => [
                    ['size' => '', 'price' => '', 'image_url' => '', 'image_path' => null],
                ],
            ],
        ];

        return view('screens.admin.products.create', compact(
            'categories',
            'productTypes',
            'variationAttributes',
            'variationDefinitions',
            'wooInitialBlocks'
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
            'images.*' => $this->permissiveProductImageRules(),
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

        $variationAttributes = $this->fixedVariationAttributes();
        [$normalizedVariationRows, $rowImageUploads] = $this->validatedVariableProductVariations($request, $type, $variationAttributes);

        $slugSource = $request->filled('slug') ? $request->input('slug') : $request->input('name');
        $slug = $this->uniqueProductSlug((string) $slugSource);

        DB::transaction(function () use ($request, $base, $type, $normalizedVariationRows, $rowImageUploads, $slug, $variationAttributes) {
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
                $this->replaceProductVariationsFromRequest(
                    $request,
                    $product,
                    $normalizedVariationRows,
                    null,
                    $rowImageUploads,
                    $variationAttributes
                );
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
            'images.*' => $this->permissiveProductImageRules(),
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

        $variationAttributes = $this->fixedVariationAttributes();
        [$normalizedVariationRows, $rowImageUploads] = $this->validatedVariableProductVariations($request, $type, $variationAttributes);

        $slug = $slugRaw !== ''
            ? $this->uniqueProductSlug($slugRaw, $product->id)
            : $product->slug;

        $preservedVariationImagePaths = null;
        if ($type->slug === 'variable') {
            $preservedVariationImagePaths = $this->matchPreservedVariationPathsByOptions(
                $product,
                $normalizedVariationRows,
                $variationAttributes
            );
        }

        DB::transaction(function () use ($request, $base, $type, $normalizedVariationRows, $rowImageUploads, $preservedVariationImagePaths, $product, $slug, $variationAttributes) {
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

            $product->attributeItems()->delete();

            if ($type->slug === 'variable') {
                $this->replaceProductVariationsFromRequest(
                    $request,
                    $product,
                    $normalizedVariationRows,
                    $preservedVariationImagePaths,
                    $rowImageUploads,
                    $variationAttributes
                );
            } else {
                $this->replaceProductVariationsFromRequest(
                    $request,
                    $product,
                    [],
                    null,
                    [],
                    $variationAttributes
                );
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
     * Variable products always use Color + Size (rows are still stored as product_variation_values).
     *
     * @return Collection<int, ProductAttribute>
     */
    private function fixedVariationAttributes(): Collection
    {
        $uid = auth()->id();

        return collect(['Color', 'Size'])->map(function (string $name) use ($uid): ProductAttribute {
            $existing = ProductAttribute::query()->where('name', $name)->orderBy('id')->first();
            if ($existing) {
                return $existing;
            }

            return ProductAttribute::create([
                'name' => $name,
                'created_by' => $uid,
            ]);
        });
    }

    /**
     * @return array{0: list<array{price: float, options: array<int, string>}>, 1: list<UploadedFile|null>}
     */
    private function validatedVariableProductVariations(Request $request, ProductType $type, Collection $variationAttributes): array
    {
        if ($type->slug !== 'variable') {
            return [[], []];
        }

        if ($this->requestUsesWooAttributeBlocks($request)) {
            return $this->validatedWooAttributeBlocks($request, $variationAttributes);
        }

        return $this->validatedVariationRowsFlat($request, $variationAttributes);
    }

    private function requestUsesWooAttributeBlocks(Request $request): bool
    {
        $blocks = $request->input('attr_blocks');

        return is_array($blocks) && count($blocks) > 0;
    }

    /**
     * @return array{0: list<array{price: float, options: array<int, string>}>, 1: list<UploadedFile|null>}
     */
    private function validatedWooAttributeBlocks(Request $request, Collection $variationAttributes): array
    {
        $colorAttr = $variationAttributes->first(fn (ProductAttribute $a) => strcasecmp($a->name, 'Color') === 0);
        $sizeAttr = $variationAttributes->first(fn (ProductAttribute $a) => strcasecmp($a->name, 'Size') === 0);
        if (! $colorAttr || ! $sizeAttr) {
            throw ValidationException::withMessages([
                'attr_blocks' => __('Color and Size attributes are required for variable products.'),
            ]);
        }

        $request->validate([
            'attr_blocks' => ['required', 'array', 'min:1'],
            'attr_blocks.*.color' => ['required', 'string', 'max:255'],
            'attr_blocks.*.rows' => ['required', 'array', 'min:1'],
            'attr_blocks.*.rows.*.size' => ['required', 'string', 'max:255'],
            'attr_blocks.*.rows.*.price' => ['required', 'numeric', 'min:0'],
            'attr_blocks.*.rows.*.image' => $this->permissiveProductImageRules(),
        ]);

        $blocks = $request->input('attr_blocks', []);
        $attributeIds = $variationAttributes->pluck('id')->map(fn ($id) => (int) $id)->values()->all();
        $normalized = [];
        $uploads = [];
        $signatures = [];

        foreach ($blocks as $bi => $block) {
            $color = trim((string) ($block['color'] ?? ''));
            $rows = is_array($block['rows'] ?? null) ? $block['rows'] : [];
            foreach ($rows as $ri => $row) {
                $size = trim((string) ($row['size'] ?? ''));
                $price = (float) ($row['price'] ?? 0);
                $flat = [
                    (int) $colorAttr->id => $color,
                    (int) $sizeAttr->id => $size,
                ];
                $sig = collect($attributeIds)->map(fn (int $id) => mb_strtolower(trim((string) ($flat[$id] ?? ''))))->join('|');
                if (isset($signatures[$sig])) {
                    throw ValidationException::withMessages([
                        "attr_blocks.{$bi}.rows.{$ri}.size" => __('Duplicate row: the same combination of :attrs already exists.', ['attrs' => $variationAttributes->pluck('name')->join(', ')]),
                    ]);
                }
                $signatures[$sig] = true;

                $normalized[] = [
                    'price' => $price,
                    'options' => $flat,
                ];
                $file = $request->file("attr_blocks.{$bi}.rows.{$ri}.image");
                $uploads[] = ($file instanceof UploadedFile && $file->isValid()) ? $file : null;
            }
        }

        return [$normalized, $uploads];
    }

    /**
     * @return array{0: list<array{price: float, options: array<int, string>}>, 1: list<UploadedFile|null>}
     */
    private function validatedVariationRowsFlat(Request $request, Collection $variationAttributes): array
    {
        $attributeIds = $variationAttributes->pluck('id')->map(fn ($id) => (int) $id)->values()->all();

        $request->validate([
            'variation_rows' => ['required', 'array', 'min:1'],
            'variation_rows.*.price' => ['required', 'numeric', 'min:0'],
            'variation_rows.*.options' => ['required', 'array'],
            'variation_rows.*.image' => $this->permissiveProductImageRules(),
        ]);

        $rows = $request->input('variation_rows', []);
        $signatures = [];
        $normalized = [];
        $uploads = [];

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
            $file = $request->file("variation_rows.{$idx}.image");
            $uploads[] = ($file instanceof UploadedFile && $file->isValid()) ? $file : null;
        }

        return [$normalized, $uploads];
    }

    /**
     * @param  list<array{price: float, options: array<int, string>}>  $normalizedRows
     * @return list<string|null>
     */
    private function matchPreservedVariationPathsByOptions(Product $product, array $normalizedRows, Collection $variationAttributes): array
    {
        $product->loadMissing(['variations.values', 'variations.image']);
        $attributeIds = $variationAttributes->pluck('id')->map(fn ($id) => (int) $id)->values()->all();

        $lookup = [];
        foreach ($product->variations as $v) {
            $flat = [];
            foreach ($attributeIds as $aid) {
                $flat[$aid] = $v->values->firstWhere('product_attribute_id', $aid)?->value ?? '';
            }
            $sig = collect($attributeIds)->map(fn (int $id) => mb_strtolower(trim((string) ($flat[$id] ?? ''))))->join('|');
            if (trim(str_replace('|', '', $sig)) === '') {
                continue;
            }
            if (! isset($lookup[$sig])) {
                $raw = trim((string) ($v->image?->image ?? ''));
                $lookup[$sig] = $raw !== '' ? $raw : null;
            }
        }

        $out = [];
        foreach ($normalizedRows as $row) {
            $flat = $row['options'];
            $sig = collect($attributeIds)->map(fn (int $id) => mb_strtolower(trim((string) ($flat[$id] ?? ''))))->join('|');
            $out[] = $lookup[$sig] ?? null;
        }

        return $out;
    }

    private function findMatchingNewRowIndexForOldVariation(
        ProductVariation $existing,
        array $normalizedRows,
        Collection $variationAttributes
    ): ?int {
        $attributeIds = $variationAttributes->pluck('id')->map(fn ($id) => (int) $id)->values()->all();
        $oldSig = collect($attributeIds)->map(function (int $id) use ($existing) {
            return mb_strtolower(trim((string) ($existing->values->firstWhere('product_attribute_id', $id)?->value ?? '')));
        })->join('|');

        foreach ($normalizedRows as $ni => $row) {
            $flat = $row['options'];
            $newSig = collect($attributeIds)->map(fn (int $id) => mb_strtolower(trim((string) ($flat[$id] ?? ''))))->join('|');
            if ($newSig === $oldSig) {
                return $ni;
            }
        }

        return null;
    }

    private function resolveRowImageUpload(Request $request, array $rowImageUploads, int $idx): ?UploadedFile
    {
        if (array_key_exists($idx, $rowImageUploads)) {
            $f = $rowImageUploads[$idx];

            return ($f instanceof UploadedFile && $f->isValid()) ? $f : null;
        }
        $legacy = $request->file("variation_rows.{$idx}.image");

        return ($legacy instanceof UploadedFile && $legacy->isValid()) ? $legacy : null;
    }

    /**
     * @return list<array{color: string, rows: list<array{size: string, price: float|string, image_url: string, image_path: string|null}>}>
     */
    private function buildWooInitialBlocksFromProduct(Product $product, Collection $variationAttributes): array
    {
        $colorAttr = $variationAttributes->first(fn (ProductAttribute $a) => strcasecmp($a->name, 'Color') === 0);
        $sizeAttr = $variationAttributes->first(fn (ProductAttribute $a) => strcasecmp($a->name, 'Size') === 0);
        if (! $colorAttr || ! $sizeAttr) {
            return [
                [
                    'color' => '',
                    'rows' => [
                        ['size' => '', 'price' => '', 'image_url' => '', 'image_path' => null],
                    ],
                ],
            ];
        }

        $product->loadMissing(['variations.values', 'variations.image']);
        /** @var array<string, list<array{size: string, price: float|string, image_url: string, image_path: string|null}>> $byColor */
        $byColor = [];
        foreach ($product->variations->sortBy('sort_order') as $v) {
            $color = trim((string) $v->values->firstWhere('product_attribute_id', $colorAttr->id)?->value);
            if ($color === '') {
                $color = (string) __('Uncategorized');
            }
            $size = trim((string) $v->values->firstWhere('product_attribute_id', $sizeAttr->id)?->value);
            if (! isset($byColor[$color])) {
                $byColor[$color] = [];
            }
            $byColor[$color][] = [
                'size' => $size,
                'price' => $v->price,
                'image_url' => $v->image?->publicUrl() ?? '',
                'image_path' => $v->image?->image,
            ];
        }

        $blocks = [];
        foreach ($byColor as $color => $rows) {
            $blocks[] = ['color' => $color, 'rows' => $rows];
        }

        if ($blocks === []) {
            $blocks[] = [
                'color' => '',
                'rows' => [
                    ['size' => '', 'price' => '', 'image_url' => '', 'image_path' => null],
                ],
            ];
        }

        return $blocks;
    }

    /**
     * @param  list<array{price: float, options: array<int, string>}>  $normalizedRows
     * @param  list<string|null>|null  $preservedImagePaths
     * @param  list<UploadedFile|null>  $rowImageUploads
     */
    private function replaceProductVariationsFromRequest(
        Request $request,
        Product $product,
        array $normalizedRows,
        ?array $preservedImagePaths,
        array $rowImageUploads,
        Collection $variationAttributes,
    ): void {
        $oldVariants = $product->variations()->with('image')->orderBy('sort_order')->get()->values();

        foreach ($oldVariants as $idx => $existing) {
            if ($existing->image) {
                $newIdx = $this->findMatchingNewRowIndexForOldVariation($existing, $normalizedRows, $variationAttributes);
                $upload = $newIdx !== null ? $this->resolveRowImageUpload($request, $rowImageUploads, $newIdx) : null;
                $hasNewValidImage = $upload instanceof UploadedFile && $upload->isValid();
                $preservedPath = $newIdx !== null && is_array($preservedImagePaths) && array_key_exists($newIdx, $preservedImagePaths)
                    ? $preservedImagePaths[$newIdx]
                    : null;
                $preservedPath = is_string($preservedPath) ? trim($preservedPath) : '';
                $oldPath = trim((string) $existing->image->image);

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
            $file = $this->resolveRowImageUpload($request, $rowImageUploads, $idx);
            if ($file instanceof UploadedFile && $file->isValid()) {
                $path = ProductPublicImage::store($file);
            } elseif (is_array($preservedImagePaths) && array_key_exists($idx, $preservedImagePaths)) {
                $p = $preservedImagePaths[$idx];
                $path = is_string($p) && trim($p) !== '' ? trim($p) : null;
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
            if (str_starts_with($path, 'uploads/')) {
                $full = public_path($path);
                if (is_file($full)) {
                    @unlink($full);
                }

                continue;
            }
            if ($path !== '') {
                Storage::disk('public')->delete($path);
            }
        }
    }

    /**
     * Accept any image MIME (image/*) or raster files PHP can probe via getimagesize (covers many RAW/HEIC cases).
     *
     * @return array<int, \Closure|string>
     */
    private function permissiveProductImageRules(): array
    {
        return [
            'nullable',
            'file',
            function (string $attribute, mixed $value, \Closure $fail): void {
                if (! $value instanceof UploadedFile || ! $value->isValid()) {
                    return;
                }
                $mime = strtolower((string) $value->getMimeType());
                if (str_starts_with($mime, 'image/')) {
                    return;
                }
                $path = $value->getRealPath();
                if ($path && @getimagesize($path)) {
                    return;
                }
                if ($path && function_exists('mime_content_type')) {
                    $detected = @mime_content_type($path);
                    if (is_string($detected) && str_starts_with(strtolower($detected), 'image/')) {
                        return;
                    }
                }
                $fail(__('The file must be an image.'));
            },
        ];
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
