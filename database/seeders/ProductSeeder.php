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
                    'uploads/products/magsafe/4.avif',
                    'uploads/products/magsafe/5.avif',
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
                    'uploads/products/mug/01.avif',
                    'uploads/products/mug/02.avif',
                    'uploads/products/mug/03.avif',
                    'uploads/products/mug/04.avif',
                    'uploads/products/mug/05.avif',
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
                    'uploads/products/crossbody/01.avif',
                    'uploads/products/crossbody/02.avif',
                    'uploads/products/crossbody/03.avif',
                    'uploads/products/crossbody/04.avif',
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
                    'uploads/products/tumbler/01.avif',
                    'uploads/products/tumbler/02.avif',
                    'uploads/products/tumbler/03.avif',
                    'uploads/products/tumbler/04.avif',
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
                    'uploads/products/water-bottle/01.avif',
                    'uploads/products/water-bottle/02.avif',
                    'uploads/products/water-bottle/03.avif',
                    'uploads/products/water-bottle/04.avif',
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
                    'uploads/products/heavy-shirt/01.avif',
                    'uploads/products/heavy-shirt/02.jpg',
                    'uploads/products/heavy-shirt/03.jpg',
                    'uploads/products/heavy-shirt/04.jpg',
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
                    'uploads/products/canvas-shoes/01.avif',
                    'uploads/products/canvas-shoes/02.avif',
                    'uploads/products/canvas-shoes/03.avif',
                    'uploads/products/canvas-shoes/04.avif',
                    'uploads/products/canvas-shoes/05.avif',
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
                    'uploads/products/pajama-top/01.avif',
                    'uploads/products/pajama-top/02.avif',
                    'uploads/products/pajama-top/03.avif',
                    'uploads/products/pajama-top/04.avif',
                    'uploads/products/pajama-top/05.avif',
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
                    'uploads/products/athletic-shoes/01.avif',
                    'uploads/products/athletic-shoes/02.avif',
                    'uploads/products/athletic-shoes/03.avif',
                    'uploads/products/athletic-shoes/04.avif',
                    'uploads/products/athletic-shoes/05.avif',
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
