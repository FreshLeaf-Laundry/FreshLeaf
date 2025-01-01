<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Schedule extends Model
{
    //
    use HasFactory;
    
    protected $table = 'schedule';
    
    protected $fillable = [
        'order_id',
        'pickup_date',
        'delivery_date',
        'status',
    ];

    public function orders()
    {
        return $this->belongsTo(Order::class);
    }
}
