<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Ticket;
use App\Models\Comment;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
    'name',
    'email',
    'password',
    'role',
    'profile_photo',
];
    /**
     * The attributes that should be hidden for serialization.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Attribute casting.
     */
    protected function casts(): array
{
    return [
        'email_verified_at' => 'datetime',
        'last_login_at' => 'datetime',
        'password' => 'hashed',
    ];
}

    /**
     * Comments made by this user.
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function attachments()
{
    return $this->hasMany(Attachment::class);
}

    /**
     * Tickets created by this user.
     */
    public function createdTickets()
    {
        return $this->hasMany(Ticket::class, 'created_by');
    }

    /**
     * Tickets assigned to this user.
     */
    public function assignedTickets()
    {
        return $this->hasMany(Ticket::class, 'assigned_to');
    }

    public function getProfilePhotoUrlAttribute()
{
    if ($this->profile_photo) {

        return asset('storage/'.$this->profile_photo);

    }

    return 'https://ui-avatars.com/api/?name='
            . urlencode($this->name)
            . '&background=2563eb'
            . '&color=ffffff'
            . '&size=200';
}
}