<?php

namespace App\Support;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * Generate URL-safe unique slugs for any Eloquent model + column.
 */
final class UniqueSlug
{
    /**
     * @param  class-string<Model>  $modelClass
     */
    public static function generate(string $modelClass, string $column, string $source, ?int $ignoreId = null): string
    {
        $slug = Str::slug(trim($source));
        if ($slug === '') {
            $slug = 'post';
        }

        $base = $slug;
        $i = 2;
        while ($modelClass::query()
            ->when($ignoreId !== null, fn ($q) => $q->where('id', '!=', $ignoreId))
            ->where($column, $slug)
            ->exists()) {
            $slug = $base.'-'.$i++;
        }

        return $slug;
    }
}
