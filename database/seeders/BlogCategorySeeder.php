<?php

namespace Database\Seeders;

use App\Models\BlogCategory;
use Illuminate\Database\Seeder;

class BlogCategorySeeder extends Seeder
{
    /**
     * Categories aligned with the journal filter UI (excluding "All Posts", which is a front-end filter).
     */
    public function run(): void
    {
        $rows = [
            ['name' => 'Journal', 'slug' => 'journal', 'sort_order' => 1],
            ['name' => 'Travel', 'slug' => 'travel', 'sort_order' => 2],
            ['name' => 'Yada Yada Yada', 'slug' => 'yada-yada-yada', 'sort_order' => 3],
            ['name' => 'Letters', 'slug' => 'letters', 'sort_order' => 4],
            ['name' => 'Manifestos', 'slug' => 'manifestos', 'sort_order' => 5],
        ];

        foreach ($rows as $row) {
            BlogCategory::updateOrCreate(
                ['slug' => $row['slug']],
                [
                    'name' => $row['name'],
                    'status' => 'active',
                    'sort_order' => $row['sort_order'],
                ]
            );
        }
    }
}
