<?php

namespace App\Http\Controllers;

use App\Models\Publication;
use Illuminate\Http\Request;
use App\Http\Resources\PublicationResource;

class PublicationController extends Controller
{
    /**
     * Listar todas las publicaciones con filtros e includes
     */
    public function index(Request $request)
    {
        $publications = Publication::query()
            ->include($request->query('include'))
            ->filter($request->query())
            ->get();

        // Usamos el resource para devolver campos con nombres bonitos
        return PublicationResource::collection($publications);
    }

    /**
     * Mostrar una publicación específica
     */
    public function show(Publication $publication, Request $request)
    {
        // Permitimos que también pueda incluir relaciones en show
        $publication->load(
            collect(explode(',', $request->query('include', '')))
                ->filter()
                ->all()
        );

        return new PublicationResource($publication);
    }

    /**
     * Crear una nueva publicación
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title_publication' => 'required|string|max:255',
            'type_publication' => 'required|string|max:100',
            'severity_publication' => 'required|string|max:100',
            'location_publication' => 'required|string|max:255',
            'description_publication' => 'required|string',
            'url_imagen' => 'nullable|string',
            'date_publication' => 'required|date',
            'profile_id' => 'required|exists:profiles,id_role_user',
        ]);

        $publication = Publication::create($validated);

        return new PublicationResource($publication);
    }

    /**
     * Actualizar una publicación existente
     */
    public function update(Request $request, Publication $publication)
    {
        $validated = $request->validate([
            'title_publication' => 'sometimes|string|max:255',
            'type_publication' => 'sometimes|string|max:100',
            'severity_publication' => 'sometimes|string|max:100',
            'location_publication' => 'sometimes|string|max:255',
            'description_publication' => 'sometimes|string',
            'url_imagen' => 'nullable|string',
            'date_publication' => 'sometimes|date',
            'profile_id' => 'sometimes|exists:profiles,id_role_user',
        ]);

        $publication->update($validated);

        return new PublicationResource($publication);
    }

    /**
     * Eliminar una publicación
     */
    public function destroy(Publication $publication)
    {
        $publication->delete();

        return response()->json(null, 204);
    }
}
