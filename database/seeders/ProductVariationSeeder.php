<?php

namespace Database\Seeders;

use App\Models\AttributeValue;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\ProductCategory;
use App\Models\ProductVariant;
use Illuminate\Database\Seeder;
use App\Models\ProductType;

class ProductVariationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * Inserts demo product + variants only when no variants exist yet.
     */
    public function run(): void
    {
        $productType = ProductType::where('slug', 'variable')->first();

        if (! $productType) {
            throw new \Exception('Variable product type not found. Run ProductTypeSeeder first.');
        }

        $category = ProductCategory::query()
            ->where('slug', 'demo-clothing')
            ->first();

        if (! $category) {
            $this->call(ProductCategorySeeder::class);
            $category = ProductCategory::query()
                ->where('slug', 'demo-clothing')
                ->firstOrFail();
        }

        $product = Product::updateOrCreate(
            [
                'name' => 'T-Shirt (Demo)',
                'category_id' => $category->id,
            ],
            [
                'description' => 'Premium cotton t-shirt — demo seed',
                'product_type_id' => $productType->id,
                'created_by' => 1,
            ]
        );

        $color = ProductAttribute::firstOrCreate(
            ['product_id' => $product->id, 'name' => 'Color'],
            ['created_by' => 1]
        );

        $size = ProductAttribute::firstOrCreate(
            ['product_id' => $product->id, 'name' => 'Size'],
            ['created_by' => 1]
        );

        $red = AttributeValue::firstOrCreate(
            ['attribute_id' => $color->id, 'value' => 'Red'],
            ['created_by' => 1]
        );
        $blue = AttributeValue::firstOrCreate(
            ['attribute_id' => $color->id, 'value' => 'Blue'],
            ['created_by' => 1]
        );

        $m = AttributeValue::firstOrCreate(
            ['attribute_id' => $size->id, 'value' => 'M'],
            ['created_by' => 1]
        );
        $l = AttributeValue::firstOrCreate(
            ['attribute_id' => $size->id, 'value' => 'L'],
            ['created_by' => 1]
        );
    }
}
