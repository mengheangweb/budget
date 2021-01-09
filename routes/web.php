<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\NotificationListController;

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

Route::middleware(['timeRestrict'])->group(function () {

    Route::get('/', [HomeController::class, 'index']);
    Route::get('/transaction', [TransactionController::class, 'index']);
    Route::get('/transaction/create', [TransactionController::class, 'create']);
    Route::post('/transaction/store', [TransactionController::class, 'store']);
    Route::get('/transaction/edit/{id}', [TransactionController::class, 'edit']);
    Route::patch('/transaction/update/{id}', [TransactionController::class, 'update']);
    Route::delete('/transaction/delete/{id}', [TransactionController::class, 'delete']);
    Route::get('/transaction/restore/{id}', [TransactionController::class, 'restore']);

    Route::prefix('category')->group(function() {
        Route::get('/', [CategoryController::class, 'index']);
        Route::get('/create', [CategoryController::class, 'create']);
        Route::get('/view/{id}', [CategoryController::class, 'show']);
    });

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/notification', [App\Http\Controllers\NotificationController::class, 'index'])->name('notificationList');
    Route::get('/notification/read/{id}', [App\Http\Controllers\NotificationController::class, 'read'])->name('notificationRead');
    Route::get('/notification/delete/{id}', [App\Http\Controllers\NotificationController::class, 'delete'])->name('notificationRead');
});

Auth::routes();

