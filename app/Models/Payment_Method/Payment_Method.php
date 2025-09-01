<?php

namespace App\Models\Payment_Method;

use Illuminate\Database\Eloquent\Model;

class Payment_Method extends Model
{
    protected $fillable = [
        'id',
        'description',
        'observation',
        'is_active',
        'created_at',
    ];
}
