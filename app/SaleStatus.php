<?php

namespace App;

enum SaleStatus: string
{
    case PAID = 'paid';
    case PENDING = 'pending';
    case CANCELLED = 'cancelled';
}
