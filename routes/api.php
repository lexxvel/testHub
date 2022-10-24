<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\v1\UserController;
use App\Http\Controllers\api\v1\ProjectController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('users', [UserController::class, 'getUsers']);
Route::post('user/delete', [UserController::class, 'deleteUser']); 
Route::post('user/add', [UserController::class, 'addUser']); 

Route::get('projects', [ProjectController::class, 'getProjects']);
Route::post('project/add', [ProjectController::class, 'addProject']); 
Route::post('project/delete', [ProjectController::class, 'deleteProject']);