<?php

namespace App\Models\Period;

use App\Models\Finance\Finance;
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

    public function finances()
    {
        return $this->hasMany(Finance::class);
    }
}
