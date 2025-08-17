<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    /**
     * Método para listar todos los usuarios con filtros, ordenamiento y paginación
     */
    public function index()
    {
        $users = User::included()->filter()->sort()->getOrPaginate();
        return response()->json($users);
    }

    /**
     * Guarda un nuevo usuario en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'firstname' => 'required|max:255',
            'lastname'  => 'required|max:255',
            'email'     => 'required|email|unique:users,email|max:255',
            'location'  => 'required|max:255',
            'password'  => 'required|min:6|max:255',
        ]);

        $data = $request->all();
        $data['password'] = Hash::make($request->password);

        $user = User::create($data);

        return response()->json($user, 201);
    }

    /**
     * Muestra un usuario específico por su ID con relaciones incluidas
     */
    public function show($id)
    {
        $user = User::included()->findOrFail($id);
        return response()->json($user);
    }

    /**
     * Actualiza los datos de un usuario existente
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }

        $request->validate([
            'firstname' => 'required|max:255',
            'lastname'  => 'required|max:255',
            'email'     => 'required|email|max:255|unique:users,email,' . $user->id,
            'location'  => 'required|max:255',
            'password'  => 'nullable|min:6|max:255',
        ]);

        $data = $request->all();
        
        // Solo actualizar la contraseña si se proporciona
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        return response()->json($user, 200);
    }

    /**
     * Elimina un usuario de la base de datos
     */
    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }

        $user->delete();

        return response()->json(['message' => 'Usuario eliminado'], 200);
    }
}