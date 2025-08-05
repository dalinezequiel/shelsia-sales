<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'id',
        'barcode',
        'description',
        'category',
        'unit',
        'supplier',
        'purchase_price',
        'sale_price',
        'validity',
        'minimum_stock',
        'maximum_stock',
        'available_stock',
        'location',
        'image',
        'is_active'
    ];
}
