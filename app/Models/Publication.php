<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Publication extends Model
{
    use HasFactory;

    protected $table = 'publications';
    protected $primaryKey = 'publication_id';

    protected $fillable = [
        'title_publication',
        'type_publication',
        'severity_publication',
        'location_publication',
        'description_publication',
        'url_imagen',
        'date_publication',
        'profile_id',
    ];

    // Relaciones
    public function profile()
    {
        return $this->belongsTo(Profile::class, 'profile_id', 'id_role_user');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'publications_categories', 'publication_id', 'category_id');
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class, 'publication_id', 'publication_id');
    }

    // Scope para incluir relaciones dinámicamente
    public function scopeInclude($query, $includes)
    {
        if (empty($includes)) {
            return $query;
        }

        if (is_string($includes)) {
            $includes = explode(',', $includes);
        }

        $allowedIncludes = ['profile', 'categories', 'notifications'];

        foreach ($includes as $include) {
            if (in_array($include, $allowedIncludes)) {
                $query->with($include);
            }
        }

        return $query;
    }

    // Scope para filtros dinámicos
    public function scopeFilter($query, $filters)
    {
        if (isset($filters['filter'])) {
            $filters = $filters['filter'];
        }

        if (isset($filters['title'])) {
            $query->where('title_publication', 'like', '%' . $filters['title'] . '%');
        }

        if (isset($filters['type'])) {
            $query->where('type_publication', $filters['type']);
        }

        if (isset($filters['severity'])) {
            $query->where('severity_publication', $filters['severity']);
        }

        if (isset($filters['location'])) {
            $query->where('location_publication', 'like', '%' . $filters['location'] . '%');
        }

        return $query;
    }
}
