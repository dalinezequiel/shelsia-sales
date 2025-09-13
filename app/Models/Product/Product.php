<?php

namespace App\Models\Product;

use App\Models\Sales\SaleDetail;
use App\Models\Supplier\Supplier;
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
        'promotional_price',
        'validity',
        'minimum_stock',
        'maximum_stock',
        'available_stock',
        'location',
        'image',
        'is_active'
    ];

    public function hasSaleDetail()
    {
        return $this->hasOne(SaleDetail::class);
    }

    public function productCategory()
    {
        return $this->belongsTo(ProductCategory::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
