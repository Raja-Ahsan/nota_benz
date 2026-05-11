<?php

namespace App\Support;

use Illuminate\Http\UploadedFile;

class ProductPublicImage
{
    /**
     * Store on the `public` disk under `products/` (same pattern as blogs: storage/app/public → /storage/…).
     * Returns the path to persist on `product_images.image` (e.g. products/abc.jpg).
     */
    public static function store(UploadedFile $file): string
    {
        $safe = preg_replace('/[^a-zA-Z0-9._-]/', '_', $file->getClientOriginalName());
        $name = uniqid('', true).'_'.$safe;

        return $file->storeAs('products', $name, 'public');
    }
}
