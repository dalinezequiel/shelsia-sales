<?php

namespace App\Models\PaymentMethod;

use App\Models\Sales\Sale;
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

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }
}
