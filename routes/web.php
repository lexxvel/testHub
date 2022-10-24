<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\Api\v1\UserController;
use App\Http\Controllers\Api\v1\ProjectController;
use Illuminate\Support\Facades\Route;

//Route::get('/login', [\App\Http\Controllers\IndexController::class, 'login'])->name('login');

Route::middleware('auth')
    ->group(function () {
    Route::get('/', [\App\Http\Controllers\IndexController::class, 'index'])->name('home');
    Route::get('/users', [\App\Http\Controllers\Api\v1\UserController::class, 'index'])->name('users');
    Route::post('/user/destroy', [\App\Http\Controllers\Api\v1\UserController::class, 'destroy'])->name('users.destroy');
    Route::get('/user/create', [\App\Http\Controllers\Api\v1\UserController::class, 'create'])->name('users.create');
    Route::post('/user/store', [\App\Http\Controllers\Api\v1\UserController::class, 'store'])->name('users.store');
    Route::get('/user/edit', [\App\Http\Controllers\Api\v1\UserController::class, 'edit'])->name('users.edit');
    Route::post('/user/update', [\App\Http\Controllers\Api\v1\UserController::class, 'update'])->name('users.update');

    Route::get('/projects', [ProjectController::class, 'index'])->name('projects');
    Route::get('/project/create', [ProjectController::class, 'create'])->name('projects.create');
    Route::post('/project/store', [ProjectController::class, 'store'])->name('projects.store');
    Route::get('/project/edit', [ProjectController::class, 'edit'])->name('projects.edit');
    Route::post('/project/update', [ProjectController::class, 'update'])->name('projects.update');
});



Route::controller(AuthController::class)
    ->group(function() {
        Route::post('/login', 'login')->name('login')->middleware('guest');
        Route::delete('/logout', 'logout')->name('logout')->middleware('auth');
});


Route::inertia('/login', 'Login');