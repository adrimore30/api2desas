<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;

use App\Http\Controllers\MessageController;
use App\Http\Controllers\PublicationController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::apiResource('publications', PublicationController::class);
Route::apiResource('Message', MessageController::class);
Route::apiResource('users', UserController::class);
Route::apiResource('roles', RoleController::class);
