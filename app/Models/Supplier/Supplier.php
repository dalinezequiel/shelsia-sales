<?php

namespace App\Models\Supplier;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
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
