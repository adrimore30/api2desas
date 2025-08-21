<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicationController;
use App\Http\Controllers\MessageController;

Route::apiResource('users', UserController::class);
Route::apiResource('roles', RoleController::class);
Route::apiResource('profiles', ProfileController::class);

Route::get('/user', function (Request $request) {
    return $request->user();
}
)->middleware('auth:sanctum');

Route::apiResource('publications', PublicationController::class);

Route::apiResource('messages', MessageController::class);
