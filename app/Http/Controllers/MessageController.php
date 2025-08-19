<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Lista todos los mensajes.
     */
    public function index()
    {
        // Puedes usar scopes (included, filter, sort, getOrPaginate) si quieres:
        // $messages = Message::included()->filter()->sort()->getOrPaginate();
        // return response()->json($messages);

        return response()->json(Message::all(), 200);
    }

    /**
     * Guarda un nuevo mensaje en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'content'             => 'required|string',
            'is_read'             => 'boolean',
            'sender_profile_id'   => 'required|exists:profiles,id_role_user',
            'receiver_profile_id' => 'required|exists:profiles,id_role_user',
            'profile_id'          => 'nullable|exists:profiles,id_role_user',
        ]);

        $message = Message::create($request->all());

        return response()->json($message, 201);
    }

    /**
     * Muestra un mensaje específico por su ID.
     */
    public function show($id)
    {
        $message = Message::find($id);

        if (!$message) {
            return response()->json(['message' => 'Mensaje no encontrado'], 404);
        }

        return response()->json($message, 200);
    }

    /**
     * Actualiza los datos de un mensaje existente.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'content'             => 'sometimes|string',
            'is_read'             => 'sometimes|boolean',
            'sender_profile_id'   => 'sometimes|exists:profiles,id_role_user',
            'receiver_profile_id' => 'sometimes|exists:profiles,id_role_user',
            'profile_id'          => 'sometimes|exists:profiles,id_role_user',
        ]);

        $message = Message::find($id);

        if (!$message) {
            return response()->json(['message' => 'Mensaje no encontrado'], 404);
        }

        $message->update($request->all());

        return response()->json($message, 200);
    }

    /**
     * Elimina un mensaje de la base de datos.
     */
    public function destroy($id)
    {
        $message = Message::find($id);

        if (!$message) {
            return response()->json(['message' => 'Mensaje no encontrado'], 404);
        }

        $message->delete();

        return response()->json(['message' => 'Mensaje eliminado'], 200);
    }
}
