<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $guarded = ['id'];
    public function user()
    {
        // test
        return $this->belongsTo(User::class);
    }
}
