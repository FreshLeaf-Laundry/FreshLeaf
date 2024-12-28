<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    protected $fillable = [
        'code',
        'discount',
        'expiry_date',
    ];

    protected $casts = [
        'expiry_date' => 'date'
    ];
}
