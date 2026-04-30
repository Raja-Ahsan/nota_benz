<?php

namespace Database\Seeders;

use App\Models\AttributeValue;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\ProductVariant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Casts\Attribute;

class ProductVariationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $product = Product::create([
            'name' => 'T-Shirt',
            'description' => 'Premium cotton t-shirt',
            'created_by' => 1,
        ]);

        // 🔥 Attributes
        $color = ProductAttribute::create([
            'product_id' => $product->id,
            'name' => 'Color'
        ]);

        $size = ProductAttribute::create([
            'product_id' => $product->id,
            'name' => 'Size'
        ]);

        // 🔥 Attribute Values
        $red  = AttributeValue::create(['attribute_id' => $color->id, 'value' => 'Red']);
        $blue = AttributeValue::create(['attribute_id' => $color->id, 'value' => 'Blue']);

        $m = AttributeValue::create(['attribute_id' => $size->id, 'value' => 'M']);
        $l = AttributeValue::create(['attribute_id' => $size->id, 'value' => 'L']);

        // 🔥 Variant 1 (Red + M)
        $variant1 = ProductVariant::firstOrCreate(
            ['sku' => 'TSH-RED-M'], // 🔥 ONLY UNIQUE FIELD
            [
                'product_id' => $product->id,
                'category_id' => 1,
                'price' => 1000,
                'stock' => 10,
                'created_by' => 1,
            ]
        );

        $variant1->attributeValues()->attach([$red->id, $m->id]);
    }
}
