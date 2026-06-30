<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Ticket extends Model
{
    protected $fillable = [
        'ticket_number',
        'title',
        'description',
        'priority',
        'status',
        'created_by',
        'assigned_to',
    ];

    public function comments()
{
    return $this->hasMany(Comment::class)->latest();
}

    // User who created the ticket
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

public function technician()
{
    return $this->belongsTo(User::class, 'assigned_to');
}
public function activities()
{
    return $this->hasMany(Activity::class)->latest();
}
}