<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $fillable = [
        'plate',
        'brand',
        'model',
        'year',
        'type',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}