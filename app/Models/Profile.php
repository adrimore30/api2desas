<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = ['password','photo','user_id','role_id'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function role() {
        return $this->belongsTo(Role::class);
    }

    public function publications() {
        return $this->hasMany(Publication::class);
    }

    // mensajes (como emisor)
    public function sentMessages() {
        return $this->hasMany(Message::class, 'sender_profile_id');
    }

    // mensajes (como receptor)
    public function receivedMessages() {
        return $this->hasMany(Message::class, 'receiver_profile_id');
    }
}
