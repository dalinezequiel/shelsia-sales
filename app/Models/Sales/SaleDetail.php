<?php

namespace App\Models\Sales;

use App\Models\Product\Product;
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

    public function belongsToSale()
    {
        return $this->belongsTo(Sale::class);
    }

    public function belongsToProduct()
    {
        return $this->belongsTo(Product::class);
    }
}
