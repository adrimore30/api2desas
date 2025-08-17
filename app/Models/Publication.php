<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Publication extends Model
{
    use HasFactory;

    protected $fillable = [
        'title_publication','type_publication','severity_publication',
        'location_publication','description_publication','url_imagen',
        'date_publication','profile_id'
    ];

    public function profile() {
        return $this->belongsTo(Profile::class);
    }

    public function categories() {
        return $this->belongsToMany(Category::class, 'publications_categories');
    }

    public function notifications() {
        return $this->hasMany(Notification::class);
    }
}
