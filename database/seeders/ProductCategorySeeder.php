<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Demo Clothing', 'status' => 'active'],
            ['name' => 'Demo Accessories', 'status' => 'active'],
        ];

        foreach ($categories as $row) {
            ProductCategory::updateOrCreate(
                ['slug' => Str::slug($row['name'])],
                [
                    'name' => $row['name'],
                    'status' => $row['status'],
                ]
            );
        }
    }
}
