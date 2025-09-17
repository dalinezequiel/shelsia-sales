<?php

namespace App\Models\Forecast;

use Illuminate\Database\Eloquent\Model;

class DataFrame extends Model
{
    protected $fillable = ['id', 'ds', 'y'];
}
