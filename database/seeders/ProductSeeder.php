<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\ProductAttributeItem;
use App\Models\ProductCategory;
use App\Models\ProductType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
            'slug' => 'demo-category'
        ], [
            'name' => 'Demo Category',
            'status' => 'active'
        ]);

        // 🔹 Product Types
        $simpleType = ProductType::firstOrCreate(['slug' => 'simple'], ['name' => 'Simple']);
        $variableType = ProductType::firstOrCreate(['slug' => 'variable'], ['name' => 'Variable']);

        // =====================================================
        // 🔹 SIMPLE PRODUCT
        // =====================================================

        $simpleProduct = Product::updateOrCreate(
            ['slug' => 'simple-mug'],
            [
                'category_id' => $category->id,
                'name' => 'Simple Mug',
                'product_type_id' => $simpleType->id,
                'price' => 500,
                'description' => 'This is a simple product',
                'status' => 'active',
                'created_by' => 1,
            ]
        );

        // =====================================================
        // 🔹 VARIABLE PRODUCT
        // =====================================================

        $variableProduct = Product::updateOrCreate(
            ['slug' => 't-shirt'],
            [
                'category_id' => $category->id,
                'name' => 'T-Shirt',
                'product_type_id' => $variableType->id,
                'price' => 0,
                'description' => 'T-shirt with multiple sizes',
                'status' => 'active',
                'created_by' => 1,
            ]
        );

        $sizeAttribute = ProductAttribute::firstOrCreate(
            ['name' => 'Size'],
            ['created_by' => 1]
        );

        foreach (['Small', 'Medium', 'Large'] as $size) {
            ProductAttributeItem::updateOrCreate(
                ['name' => $size],
                [
                    'product_id' => $variableProduct->id,
                    'product_attribute_id' => $sizeAttribute->id,
                    'price' => 100,
                    'created_by' => 1,
                ]
            );
        }

        $colorAttribute = ProductAttribute::firstOrCreate(
            ['name' => 'Color'],
            ['created_by' => 1]
        );

        foreach (['Red', 'Blue'] as $color) {
            ProductAttributeItem::updateOrCreate(
                ['name' => $color],
                [
                    'product_id' => $variableProduct->id,
                    'product_attribute_id' => $colorAttribute->id,
                    'price' => 100,
                    'created_by' => 1,
                ]
            );
        }
    }
}
