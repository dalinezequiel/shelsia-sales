<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected $fillable = [
        'id',
        'description',
        'observation',
        'is_active',
        'created_at',
    ];
}
