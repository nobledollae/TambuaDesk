<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = [
        'ticket_number',
        'ticket_title',
        'user_id',
        'action',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}