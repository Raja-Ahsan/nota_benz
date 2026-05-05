<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductImage;
use App\Models\ProductType;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $simpleType = ProductType::query()
            ->firstOrCreate(
                ['slug' => 'simple'],
                ['name' => 'Simple Product']
            );

        // Categories (idempotent for reseeding)
        $all = ProductCategory::updateOrCreate(
            ['slug' => 'all-products'],
            [
                'name' => 'All Products',
                'status' => 'active',
            ]
        );

        $nota = ProductCategory::updateOrCreate(
            ['slug' => 'notabenz'],
            [
                'name' => 'NOTaBENZ',
                'status' => 'active',
            ]
        );

        $polka = ProductCategory::updateOrCreate(
            ['slug' => 'polka-dots'],
            [
                'name' => 'POLKA DOTS COLLECTION',
                'status' => 'active',
            ]
        );

        $addImages = static function (int $productId, array $images): void {
            ProductImage::query()->where('product_id', $productId)->delete();

            foreach (array_values($images) as $index => $imagePath) {
                ProductImage::create([
                    'product_id' => $productId,
                    'image' => $imagePath,
                    'is_primary' => $index === 0 ? 1 : 0,
                ]);
            }
        };

        $products = [
            [
                'name' => 'MagSafe® tough case for iPhone®',
                'slug' => 'magsafe-case',
                'category_id' => $all->id,
                'price' => 20.50,
                'description' => 'Protect your phone with this tough, dual-layer case...',
                'status' => 'active',
                'images' => [
                    'uploads/products/magsafe/01.avif',
                    'uploads/products/magsafe/02.avif',
                    'uploads/products/magsafe/03.avif',
                    'uploads/products/magsafe/4.jpg',
                    'uploads/products/magsafe/5.jpg',
                ],
            ],
            [
                'name' => 'White glossy mug',
                'slug' => 'white-mug',
                'category_id' => $all->id,
                'price' => 7.00,
                'description' => "Whether you're drinking your morning coffee...",
                'status' => 'active',
                'images' => [
                    'uploads/products/mug/1.jpg',
                    'uploads/products/mug/2.jpg',
                    'uploads/products/mug/3.jpg',
                    'uploads/products/mug/4.jpg',
                    'uploads/products/mug/5.jpg',
                ],
            ],
            [
                'name' => 'Utility crossbody bag',
                'slug' => 'crossbody-bag',
                'category_id' => $all->id,
                'price' => 27.00,
                'description' => 'This bag is sturdy, stylish...',
                'status' => 'active',
                'images' => [
                    'uploads/products/crossbody/1.jpg',
                    'uploads/products/crossbody/2.jpg',
                    'uploads/products/crossbody/3.jpg',
                    'uploads/products/crossbody/4.jpg',
                    'uploads/products/crossbody/5.jpg',
                ],
            ],
            [
                'name' => 'Insulated tumbler with a straw',
                'slug' => 'tumbler',
                'category_id' => $nota->id,
                'price' => 22.50,
                'description' => 'Upgrade your drinkware game...',
                'status' => 'active',
                'images' => [
                    'uploads/products/tumbler/1.jpg',
                    'uploads/products/tumbler/2.jpg',
                    'uploads/products/tumbler/3.jpg',
                    'uploads/products/tumbler/4.jpg',
                    'uploads/products/tumbler/5.jpg',
                ],
            ],
            [
                'name' => 'Stainless steel water bottle',
                'slug' => 'water-bottle',
                'category_id' => $nota->id,
                'price' => 24.50,
                'description' => 'Stay hydrated all day...',
                'status' => 'active',
                'images' => [
                    'uploads/products/water-bottle/1.jpg',
                    'uploads/products/water-bottle/2.jpg',
                    'uploads/products/water-bottle/3.jpg',
                    'uploads/products/water-bottle/4.jpg',
                    'uploads/products/water-bottle/5.jpg',
                ],
            ],
            [
                'name' => 'Garment-dyed heavyweight shirt',
                'slug' => 'heavy-shirt',
                'category_id' => $nota->id,
                'price' => 18.50,
                'description' => 'Enjoy ultimate comfort...',
                'status' => 'active',
                'images' => [
                    'uploads/products/heavy-shirt/1.jpg',
                    'uploads/products/heavy-shirt/2.jpg',
                    'uploads/products/heavy-shirt/3.jpg',
                    'uploads/products/heavy-shirt/4.jpg',
                    'uploads/products/heavy-shirt/5.jpg',
                ],
            ],
            [
                'name' => 'Men’s slip-on canvas shoes',
                'slug' => 'canvas-shoes',
                'category_id' => $polka->id,
                'price' => 49.00,
                'description' => 'Made for comfort and ease...',
                'status' => 'active',
                'images' => [
                    'uploads/products/canvas-shoes/1.jpg',
                    'uploads/products/canvas-shoes/2.jpg',
                    'uploads/products/canvas-shoes/3.jpg',
                    'uploads/products/canvas-shoes/4.jpg',
                    'uploads/products/canvas-shoes/5.jpg',
                ],
            ],
            [
                'name' => 'Women’s pajama top',
                'slug' => 'pajama-top',
                'category_id' => $polka->id,
                'price' => 25.50,
                'description' => 'Silky-feel pajama top...',
                'status' => 'active',
                'images' => [
                    'uploads/products/pajama-top/1.jpg',
                    'uploads/products/pajama-top/2.jpg',
                    'uploads/products/pajama-top/3.jpg',
                    'uploads/products/pajama-top/4.jpg',
                    'uploads/products/pajama-top/5.jpg',
                ],
            ],
            [
                'name' => 'Women’s athletic shoes',
                'slug' => 'athletic-shoes',
                'category_id' => $polka->id,
                'price' => 50.00,
                'description' => 'Boost your mood...',
                'status' => 'active',
                'images' => [
                    'uploads/products/athletic-shoes/1.jpg',
                    'uploads/products/athletic-shoes/2.jpg',
                    'uploads/products/athletic-shoes/3.jpg',
                    'uploads/products/athletic-shoes/4.jpg',
                    'uploads/products/athletic-shoes/5.jpg',
                ],
            ],
        ];

        foreach ($products as $payload) {
            $images = $payload['images'] ?? [];
            unset($payload['images']);

            $product = Product::updateOrCreate(
                ['slug' => $payload['slug']],
                $payload + ['product_type_id' => $simpleType->id]
            );

            $addImages((int) $product->id, $images);
        }
    }
}
