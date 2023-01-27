<?php

use App\Http\Controllers\Api\v1\RunsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\Api\v1\UserController;
use App\Http\Controllers\Api\v1\ProjectController;
use App\Http\Controllers\Api\v1\TasksController;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Api\v1\StepsController;

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

    Route::get('/tasks', [TasksController::class, 'index'])->name('tasks');
    Route::get('/task/create', [TasksController::class, 'create'])->name('tasks.create');
    Route::post('/task/store', [TasksController::class, 'store'])->name('tasks.store');
    Route::get('/task/edit', [TasksController::class, 'edit'])->name('tasks.edit');
    Route::post('/task/update', [TasksController::class, 'update'])->name('tasks.update');

    Route::post('/steps/store', [StepsController::class, 'store'])->name('steps.store');
    Route::post('/steps/getStepsByTask', [StepsController::class, 'getStepsByTask'])->name('steps.get');

    Route::get('/runs', [RunsController::class, 'index'])->name('runs');
    Route::get('/run/create', [RunsController::class, 'create'])->name('runs.create');
    Route::post('/run/store', [RunsController::class, 'store'])->name('runs.store');
    Route::get('/run/edit', [RunsController::class, 'edit'])->name('runs.edit');
});



Route::controller(AuthController::class)
    ->group(function() {
        Route::post('/login', 'login')->name('login')->middleware('guest');
        Route::delete('/logout', 'logout')->name('logout')->middleware('auth');
});


Route::inertia('/login', 'Login');
