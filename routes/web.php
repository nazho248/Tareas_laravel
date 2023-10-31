<?php

use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [TodoController::class, 'index']);
Route::get('index', [TodoController::class, 'index']);
Route::get('create', [TodoController::class, 'create']);
Route::get('details', [TodoController::class, 'details']);
Route::get('edit', [TodoController::class, 'edit']);
Route::get('delete', [TodoController::class, 'delete']);
Route::post('store-data', [TodoController::class, 'store']);


//details
Route::get('details/{todo}', [TodoController::class, 'details']);

Route::get('details/edit/{todo}', [TodoController::class, 'edit']);
Route::post('update/{todo}', [TodoController::class, 'update']);

//borrar
Route::get('delete/{todo}', [TodoController::class, 'delete']);


Route::get('complete/{todo}', [TodoController::class, 'complete']);



