<?php

use App\Http\Controllers\Api\ProjectController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('projects', ProjectController::class)
    ->names('api.projects');
    Route::apiResource('tasks', \App\Http\Controllers\Api\TaskController::class)
    ->names('api.tasks');
    Route::apiResource('users', \App\Http\Controllers\Api\UserController::class)
    ->names('api.users');
});