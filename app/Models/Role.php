<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

    protected $primaryKey = 'role_id';

    public function profiles()
    {
        return $this->hasMany(Profile::class, 'role_id', 'role_id');
    }
    
    /** @use HasFactory<\Database\Factories\RoleFactory> */
    use HasFactory;
}
