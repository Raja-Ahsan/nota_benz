<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\User;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        $category = BlogCategory::query()->where('slug', 'journal')->first();
        if (! $category) {
            return;
        }

        $authorId = User::query()->orderBy('id')->value('id');

        Blog::updateOrCreate(
            ['slug' => 'welcome-to-the-journal'],
            [
                'blog_category_id' => $category->id,
                'title' => 'Welcome to the journal',
                'body' => "This is sample content you can replace from the admin panel. Use it to check typography, spacing, and the story layout on the live site.\n\nDelete or edit this post anytime.",
                'featured_image' => null,
                'is_published' => true,
                'published_at' => now()->subDay(),
                'created_by' => $authorId,
            ]
        );
    }
}
