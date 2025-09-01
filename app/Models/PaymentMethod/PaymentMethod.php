<?php

namespace App\Models\PaymentMethod;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    protected $fillable = [
        'id',
        'description',
        'observation',
        'is_active',
        'created_at',
    ];
}
