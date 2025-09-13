<?php

namespace App\Models\Finance;

use App\Models\PaymentMethod\PaymentMethod;
use App\Models\Period\Period;
use App\Models\Supplier\Supplier;
use Illuminate\Database\Eloquent\Model;

class Finance extends Model
{
    protected $fillable = [
        'id',
        'account_plan',
        'description',
        'category',
        'due_date',
        'amount',
        'date_of_issue',
        'observation',
        'is_active'
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function period()
    {
        return $this->belongsTo(Period::class);
    }
}
