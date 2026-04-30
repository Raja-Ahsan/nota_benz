<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttributeValue extends Model
{
    protected $guarded = ['id'];

    public function productAttribute()
    {
        return $this->belongsTo(ProductAttribute::class, 'attribute_id');
    }

    public function productVariant()
    {
        return $this->belongsTo(ProductVariant::class);
    }
}
