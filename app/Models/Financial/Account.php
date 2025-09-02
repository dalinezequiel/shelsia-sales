<?php

namespace App\Models\Financial;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $fillable = [
        'id',
        'account_plan',
        'description',
        'category',
        'supplier',
        'due_date',
        'amount',
        'date_of_issue',
        'payment_method',
        'occurrence',
        'observation',
        'is_active'
    ];
}
