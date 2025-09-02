<?php

namespace App\Models\Period;

use Illuminate\Database\Eloquent\Model;

class Period extends Model
{
    protected $fillable = [
        'id',
        'description',
        'observation',
        'is_active',
        'created_at',
    ];
}
