<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $guarded = ['id'];

    /** Public browser URL (paths stored relative to `public/`, e.g. uploads/products/…). */
    public function publicUrl(): string
    {
        $raw = trim((string) $this->image);
        if ($raw === '') {
            return '';
        }
        if (preg_match('#^https?://#i', $raw)) {
            return $raw;
        }
        $path = str_replace('\\', '/', $raw);
        $path = ltrim($path, '/');

        return $path !== '' ? asset($path) : '';
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function productAttributeItem()
    {
        return $this->belongsTo(ProductAttributeItem::class);
    }
}
