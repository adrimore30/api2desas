<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = ['event_notification','publication_id'];

    public function publication() {
        return $this->belongsTo(Publication::class);
    }
}
