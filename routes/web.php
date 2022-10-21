<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', [\App\Http\Controllers\IndexController::class, 'index'])->name('home');
Route::get('/login', [\App\Http\Controllers\IndexController::class, 'login'])->name('login');
Route::get('/users', [\App\Http\Controllers\Api\v1\UserController::class, 'index'])->name('users');
Route::post('/user/destroy', [\App\Http\Controllers\Api\v1\UserController::class, 'destroy'])->name('users.destroy');
Route::get('/user/create', [\App\Http\Controllers\Api\v1\UserController::class, 'create'])->name('users.create');
Route::post('/user/store', [\App\Http\Controllers\Api\v1\UserController::class, 'store'])->name('users.store');
Route::get('/user/edit', [\App\Http\Controllers\Api\v1\UserController::class, 'edit'])->name('users.edit');
Route::post('/user/update', [\App\Http\Controllers\Api\v1\UserController::class, 'update'])->name('users.update');