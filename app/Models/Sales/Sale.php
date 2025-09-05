<?php

namespace App\Models\Sales;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = [
        'id',
        'description',
        'customer_name',
        'discount',
        'shipping',
        'payment_method',
        'is_paid',
        'created_at'
    ];
}
