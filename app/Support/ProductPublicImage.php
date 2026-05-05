<?php

namespace App\Support;

use Illuminate\Http\UploadedFile;

class ProductPublicImage
{
    /** Relative path under `public/` (e.g. uploads/products/abc.jpg). Use with asset(). */
    public static function store(UploadedFile $file): string
    {
        $relativeDir = 'uploads/products';
        $absoluteDir = public_path($relativeDir);
        if (! is_dir($absoluteDir)) {
            mkdir($absoluteDir, 0755, true);
        }

        $safe = preg_replace('/[^a-zA-Z0-9._-]/', '_', $file->getClientOriginalName());
        $filename = uniqid('', true).'_'.$safe;
        $file->move($absoluteDir, $filename);

        return $relativeDir.'/'.$filename;
    }
}
