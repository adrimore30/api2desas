<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    // Listar todos los perfiles
    public function index()
    {
       $profiles = Profile::with(['user', 'role'])->get();

        return response()->json([
            'message' => 'Perfiles obtenidos correctamente',
            'data' => $profiles
        ], 200);
    }

    // Crear un nuevo perfil
    public function store(Request $request)
    {
        $validated = $request->validate([
            'password' => 'required|string|min:6',
            'photo' => 'nullable|string',
            'user_id' => 'required|integer',
            'role_id' => 'required|integer',
        ]);

        $profile = Profile::create($validated);

        return response()->json([
            'message' => 'Perfil creado correctamente',
            'data' => $profile
        ], 201);
    }

    // Mostrar un perfil específico
    public function show($id)
    {
        $profile = Profile::findOrFail($id);
        return response()->json($profile, 200);
    }

    // Modificar un perfil existente
    public function update(Request $request, $id)
    {
        $profile = Profile::findOrFail($id);

        $validated = $request->validate([
            'password' => 'nullable|string|min:6',
            'photo' => 'nullable|string',
            'user_id' => 'nullable|integer',
            'role_id' => 'nullable|integer',
        ]);

        $profile->update($validated);

        return response()->json([
            'message' => 'Perfil actualizado correctamente',
            'data' => $profile
        ], 200);
    }

    // Eliminar un perfil
    public function destroy($id)
    {
        $profile = Profile::findOrFail($id);
        $profile->delete();

        return response()->json(['message' => 'Perfil eliminado correctamente'], 200);
    }
}
