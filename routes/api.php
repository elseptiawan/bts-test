<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoListController;
use App\Http\Controllers\ItemController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('register', 'App\Http\Controllers\AuthController@register');
Route::post('login', 'App\Http\Controllers\AuthController@login');

Route::group(['middleware' => ['jwt.auth']], function () {
    Route::post('logout', 'App\Http\Controllers\AuthController@logout');

    Route::prefix('todo-lists')->group(function () {
        Route::get('/', [TodoListController::class, 'index']);
        Route::post('/', [TodoListController::class, 'store']);
        Route::get('/{id}', [TodoListController::class, 'show']);
        Route::put('/{id}', [TodoListController::class, 'update']);
        Route::delete('/{id}', [TodoListController::class, 'destroy']);
    });
});

Route::prefix('todo-lists/{todoListId}/items')->group(function () {
    Route::get('/', [ItemController::class, 'index']);
    Route::post('/', [ItemController::class, 'store']);
    Route::get('/{id}', [ItemController::class, 'show']);
    Route::put('/{id}', [ItemController::class, 'update']);
    Route::delete('/{id}', [ItemController::class, 'destroy']);
    Route::patch('/{id}', [ItemController::class, 'updateStatus']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
