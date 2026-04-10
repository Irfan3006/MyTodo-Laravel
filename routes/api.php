<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\TodoApiController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth');

// Todo API
Route::get('/todos', [TodoApiController::class, 'index']);
Route::post('/todos', [TodoApiController::class, 'store']);
Route::get('/todos/{todo}', [TodoApiController::class, 'show']);
Route::put('/todos/{todo}', [TodoApiController::class, 'update']);
Route::delete('/todos/{todo}', [TodoApiController::class, 'destroy']);
