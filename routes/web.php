<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\TransactionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index']);
Route::get('/transaction', [TransactionController::class, 'index']);
Route::get('/transaction/create', [TransactionController::class, 'create']);
Route::post('/transaction/store', [TransactionController::class, 'store']);
Route::get('/transaction/edit/{id}', [TransactionController::class, 'edit']);
Route::patch('/transaction/update/{id}', [TransactionController::class, 'update']);
Route::delete('/transaction/delete/{id}', [TransactionController::class, 'delete']);
