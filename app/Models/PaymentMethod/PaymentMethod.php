<?php

namespace App\Models\PaymentMethod;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    protected $fillable = [
        'id',
        'description',
        'operation_type',
        'observation',
        'is_active',
        'created_at',
    ];
}
