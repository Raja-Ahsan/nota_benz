<?php

namespace App\Support;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use RuntimeException;

class ProductPublicImage
{
    /** Relative path under `public/` (e.g. uploads/products/abc.jpg). Use with asset(). */
    public static function store(UploadedFile $file): string
    {
        $relativeDir = 'uploads/products';
        $absoluteDir = public_path($relativeDir);

        if (! File::isDirectory($absoluteDir)) {
            File::makeDirectory($absoluteDir, 0755, true);
        }

        if (! is_writable($absoluteDir)) {
            $uploadsRoot = public_path('uploads');
            throw new RuntimeException(
                'Cannot write to '.$absoluteDir.'. The PHP-FPM / web user needs write access to '.$uploadsRoot.
                ' (typical Linux fix: sudo chown -R www-data:www-data '.$uploadsRoot.' && sudo chmod -R 775 '.$uploadsRoot.').'
            );
        }

        $safe = preg_replace('/[^a-zA-Z0-9._-]/', '_', $file->getClientOriginalName());
        $filename = uniqid('', true).'_'.$safe;
        $file->move($absoluteDir, $filename);

        return $relativeDir.'/'.$filename;
    }
}
