<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MidtransPayment extends Model
{
    protected $fillable = [
        'cart_id',
        'payment_status',
        'payment_amount',
        'payment_date',
        'snap_token'
    ];

    protected $table = 'midtrans_payments';
}