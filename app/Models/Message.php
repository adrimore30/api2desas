<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'content','is_read','sender_profile_id','receiver_profile_id','profile_id'
    ];

    public function sender() {
        return $this->belongsTo(Profile::class, 'sender_profile_id');
    }

    public function receiver() {
        return $this->belongsTo(Profile::class, 'receiver_profile_id');
    }

    public function profile() {
        return $this->belongsTo(Profile::class);
    }
}
