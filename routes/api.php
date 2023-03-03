<?php

use App\Http\Controllers\Api\v1\RunResultsController;
use App\Http\Controllers\Api\v1\TasksController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\v1\UserController;
use App\Http\Controllers\api\v1\ProjectController;
use App\Http\Controllers\api\v1\RunsController;
use App\Http\Controllers\Api\v1\CaseVersionsController;

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
Route::post('case/getCasesByProject', [TasksController::class, 'getCasesByProject']);
Route::post('project/add', [ProjectController::class, 'addProject']);
Route::post('project/delete', [ProjectController::class, 'deleteProject']);
Route::post('project/getProjectTree', [ProjectController::class, 'getProjectTree']);
Route::post('case/changeActualVersion', [TasksController::class, 'changeActualVersion']);
Route::post('caseVersion/getActualSteps', [CaseVersionsController::class, 'getStepsByTask']);
Route::post('caseVersion/getVersionsByTask', [CaseVersionsController::class, 'getVersionsByTask']);
Route::post('runResults/addCasesToRun', [RunResultsController::class, 'create']);
Route::post('runResults/getCasesInRun', [RunResultsController::class, 'getCasesInRun']);
Route::post('runResults/makeRun', [RunResultsController::class, 'makeRun']);

Route::post('run/changeStatus', [RunsController::class, 'changeRunStatus']);
Route::post('runs/byProject', [RunsController::class, 'getRunsByProject']);

Route::group(['middleware' => ['web']], function () {
    Route::post('projects/setPreferred', [ProjectController::class, 'setPrefProject']);
    #Route::post('caseVersions/create', [CaseVersionsController::class, 'create']);
});
