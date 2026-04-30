<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
    protected $guarded = ['id'];

    public function values()
    {
        return $this->hasMany(AttributeValue::class, 'attribute_id');
    }
    
}
