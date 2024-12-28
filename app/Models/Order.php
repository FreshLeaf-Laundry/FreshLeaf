<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'kg',
        'order_date',
        'pickup_date',
        'total_price',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
