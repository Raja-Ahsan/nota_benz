<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\ProductCategory;
use App\Models\ProductType;
use App\Models\ProductVariation;
use App\Models\ProductVariationValue;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 🔹 Category
        $category = ProductCategory::firstOrCreate([
            'slug' => 'demo-category',
        ], [
            'name' => 'Demo Category',
            'status' => 'active',
        ]);

        // 🔹 Product Types
        $simpleType = ProductType::firstOrCreate(['slug' => 'simple'], ['name' => 'Simple']);
        $variableType = ProductType::firstOrCreate(['slug' => 'variable'], ['name' => 'Variable']);

        // =====================================================
        // 🔹 SIMPLE PRODUCT
        // =====================================================

        Product::updateOrCreate(
            ['slug' => 'simple-mug'],
            [
                'category_id' => $category->id,
                'name' => 'Simple Mug',
                'product_type_id' => $simpleType->id,
                'price' => 500,
                'from_price' => null,
                'to_price' => null,
                'description' => 'This is a simple product',
                'status' => 'active',
                'created_by' => 1,
            ]
        );

        // =====================================================
        // 🔹 VARIABLE PRODUCT (SKU matrix: Size × Color per row)
        // =====================================================

        $variableProduct = Product::updateOrCreate(
            ['slug' => 't-shirt'],
            [
                'category_id' => $category->id,
                'name' => 'T-Shirt',
                'product_type_id' => $variableType->id,
                'price' => 0,
                'from_price' => 100,
                'to_price' => 500,
                'description' => 'T-shirt with size and color options (each row is one SKU).',
                'status' => 'active',
                'created_by' => 1,
            ]
        );

        $variableProduct->attributeItems()->delete();
        foreach ($variableProduct->variations()->with('image')->get() as $existing) {
            if ($existing->image) {
                $existing->image->delete();
            }
            $existing->values()->delete();
            $existing->delete();
        }

        $sizeAttribute = ProductAttribute::firstOrCreate(
            ['name' => 'Size'],
            ['created_by' => 1]
        );

        $colorAttribute = ProductAttribute::firstOrCreate(
            ['name' => 'Color'],
            ['created_by' => 1]
        );

        $sort = 0;
        foreach (['Small', 'Medium', 'Large'] as $size) {
            foreach (['Red', 'Blue'] as $color) {
                $variation = ProductVariation::create([
                    'product_id' => $variableProduct->id,
                    'price' => 100,
                    'sort_order' => $sort,
                ]);

                ProductVariationValue::create([
                    'product_variation_id' => $variation->id,
                    'product_attribute_id' => $sizeAttribute->id,
                    'value' => $size,
                ]);

                ProductVariationValue::create([
                    'product_variation_id' => $variation->id,
                    'product_attribute_id' => $colorAttribute->id,
                    'value' => $color,
                ]);

                $sort++;
            }
        }
    }
}
