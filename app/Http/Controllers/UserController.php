<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // GET /api/users
    public function index()
    {
        return response()->json(User::all(), 200);
    }

    // POST /api/users
    public function store(Request $request)
    {
        $request->validate([
            'firstname' => 'required|string',
            'lastname'  => 'required|string',
            'email'     => 'required|email|unique:users,email',
            'location'  => 'required|string',
            'password'  => 'required|min:6',
            'role_id'   => 'required|exists:roles,id',
        ]);

        $user = User::create([
            'firstname' => $request->firstname,
            'lastname'  => $request->lastname,
            'email'     => $request->email,
            'location'  => $request->location,
            'password'  => Hash::make($request->password),
            'role_id'   => $request->role_id,
        ]);

        return response()->json($user, 201);
    }

    // GET /api/users/{id}
    public function show($id)
    {
        $user = User::findOrFail($id);
        return response()->json($user, 200);
    }

    // PUT /api/users/{id}
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'email' => 'email|unique:users,email,' . $id,
            'role_id' => 'exists:roles,id',
        ]);

        $user->update([
            'firstname' => $request->firstname ?? $user->firstname,
            'lastname'  => $request->lastname ?? $user->lastname,
            'email'     => $request->email ?? $user->email,
            'location'  => $request->location ?? $user->location,
            'password'  => $request->password ? Hash::make($request->password) : $user->password,
            'role_id'   => $request->role_id ?? $user->role_id,
        ]);

        return response()->json($user, 200);
    }

    // DELETE /api/users/{id}
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(['message' => 'User deleted'], 200);
    }
}
