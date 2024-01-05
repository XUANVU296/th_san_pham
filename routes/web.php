<?php

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
Route::get('/login-admin', [\App\Http\Controllers\AuthController::class, 'login'])->name('login');
Route::post('/checklogin', [\App\Http\Controllers\AuthController::class, 'checklogin'])->name('checklogin');
Route::prefix('/')->middleware(['auth.check'])->group(function () {
    Route::get('/logout-admin', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');
    Route::resource('categories', \App\Http\Controllers\CategoryController::class);
    Route::resource('products', \App\Http\Controllers\ProductController::class);
    Route::resource('tags', \App\Http\Controllers\TagController::class);
    Route::resource('users', \App\Http\Controllers\UserController::class);
    Route::resource('groups', \App\Http\Controllers\GroupController::class);
    Route::get('import-excel', [\App\Http\Controllers\ExcelController::class, 'importExcel'])->name('inport');
});
Route::get('/login/google', [\App\Http\Controllers\AuthController::class, 'googleLogin'])->name('login-google');
Route::get('/login/google/callback', [\App\Http\Controllers\AuthController::class, 'handleGoogleCallback']);
Route::get('forget-password', [\App\Http\Controllers\AuthController::class, 'showLinkRequestForm'])->name('forget.password.get');
Route::post('forget-password', [\App\Http\Controllers\AuthController::class, 'sendResetLinkEmail'])->name('forget.password.post');
