<?php

namespace App\Models\Sales;

use App\Models\PaymentMethod\PaymentMethod;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = [
        'id',
        'description',
        'customer_name',
        'discount',
        'shipping',
        'status',
        'created_at'
    ];

    public function hasDetails()
    {
        return $this->hasMany(SaleDetail::class);
    }

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }
}
