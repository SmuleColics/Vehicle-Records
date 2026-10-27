<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// profile pictures are stored in the database (base64) because Vercel's filesystem is read-only
class ProfilePhoto extends Model
{
    protected $fillable = [
        'user_id',
        'mime',
        'data',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
