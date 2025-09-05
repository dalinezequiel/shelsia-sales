<?php

namespace App\Models\Sales;

use Illuminate\Database\Eloquent\Model;

class SaleDetail extends Model
{
    protected $fillable = [
        'id',
        'product_name',
        'quantity',
        'price',
        'created_at'
    ];
}
