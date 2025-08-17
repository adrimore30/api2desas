<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;


//   Usuarios (RESTful básico)


// Versión automática con apiResource
Route::apiResource('users', UserController::class);

// Versión explícita con cada acción
Route::prefix('users')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('users.index');       // Listar usuarios
    Route::post('/', [UserController::class, 'store'])->name('users.store');      // Crear usuario
    Route::get('/{user}', [UserController::class, 'show'])->name('users.show');   // Ver usuario
    Route::put('/{user}', [UserController::class, 'update'])->name('users.update'); // Actualizar usuario
    Route::delete('/{user}', [UserController::class, 'destroy'])->name('users.destroy'); // Eliminar usuario
});


//   Ruta protegida con Sanctum
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
