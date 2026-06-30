<?php

namespace App\Models;

use App\Models\Ticket;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{

public function comments()
{
    return $this->hasMany(Comment::class);
}
    // Tickets created by this user
public function createdTickets()
{
    return $this->hasMany(Ticket::class, 'created_by');
}

// Tickets assigned to this user
public function assignedTickets()
{
    return $this->hasMany(Ticket::class, 'assigned_to');
}
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'role',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}