<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $primaryKey = 'id_role_user';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id_user');
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'role_id');
    }
    /** @use HasFactory<\Database\Factories\ProfileFactory> */
    use HasFactory;
}
