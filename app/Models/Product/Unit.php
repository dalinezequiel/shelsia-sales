<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $fillable = [
        'id',
        'description',
        'abbreviation',
        'observation',
        'is_active',
        'created_at',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
