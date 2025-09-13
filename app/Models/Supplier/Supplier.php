<?php

namespace App\Models\Supplier;

use App\Models\Finance\Finance;
use App\Models\Product\Product;
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

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function finances()
    {
        return $this->hasMany(Finance::class);
    }
}
