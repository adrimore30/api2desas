<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;

class Message extends Model
{
    use HasFactory;

    protected $table = 'messages';
    protected $primaryKey = 'message_id';

    // Listas blancas
    protected $allowIncluded = ['sender', 'receiver', 'profile'];
    protected $allowFilter = ['message_id', 'content', 'is_read', 'sender_profile_id', 'receiver_profile_id', 'profile_id'];
    protected $allowSort = ['message_id', 'content', 'is_read', 'sender_profile_id', 'receiver_profile_id', 'profile_id', 'created_at'];

    protected $fillable = [
        'content',
        'is_read',
        'sender_profile_id',
        'receiver_profile_id',
        'profile_id'
    ];

    // Relaciones
    public function sender()
    {
        return $this->belongsTo(Profile::class, 'sender_profile_id', 'id_role_user');
    }

    public function receiver()
    {
        return $this->belongsTo(Profile::class, 'receiver_profile_id', 'id_role_user');
    }

    public function profile()
    {
        return $this->belongsTo(Profile::class, 'profile_id', 'id_role_user');
    }

    /**
     * Scope para incluir relaciones
     */
    public function scopeIncluded(Builder $query)
    {
        if (empty($this->allowIncluded) || empty(request('included'))) {
            return;
        }

        $relations = explode(',', request('included'));
        $allowIncluded = collect($this->allowIncluded);

        foreach ($relations as $key => $relationship) {
            if (!$allowIncluded->contains($relationship)) {
                unset($relations[$key]);
            }
        }

        $query->with($relations);
    }

    /**
     * Scope para filtrar registros
     */
    public function scopeFilter(Builder $query)
    {
        if (empty($this->allowFilter) || empty(request('filter'))) {
            return;
        }

        $filters = request('filter');
        $allowFilter = collect($this->allowFilter);

        foreach ($filters as $filter => $value) {
            if ($allowFilter->contains($filter)) {
                $query->where($filter, 'LIKE', '%' . $value . '%');
            }
        }
    }

    /**
     * Scope para ordenar registros
     */
    public function scopeSort(Builder $query)
    {
        if (empty($this->allowSort) || empty(request('sort'))) {
            return;
        }

        $sortFields = explode(',', request('sort'));
        $allowSort = collect($this->allowSort);

        foreach ($sortFields as $sortField) {
            $direction = 'asc';

            if (substr($sortField, 0, 1) == '-') {
                $direction = 'desc';
                $sortField = substr($sortField, 1);
            }

            if ($allowSort->contains($sortField)) {
                $query->orderBy($sortField, $direction);
            }
        }
    }

    /**
     * Scope para paginación o traer todos los registros
     */
    public function scopeGetOrPaginate(Builder $query)
    {
        if (request('perPage')) {
            $perPage = intval(request('perPage'));
            if ($perPage) {
                return $query->paginate($perPage);
            }
        }

        return $query->get();
    }
}
