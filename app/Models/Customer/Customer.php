<?php

namespace App\Models\Customer;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'id',
        'name',
        'surname',
        'gender',
        'phone',
        'email',
        'address',
        'is_active',
        'created_at',
    ];
}
