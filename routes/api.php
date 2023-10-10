<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HRController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\JobController;
use App\Permission;
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

Route::middleware(['auth:sanctum'])->group(function () 
{

    // Route::middleware(['permission:create_job'])->post('/create/job', [JobController::class, 'createJob']);
    // Route::middleware(['permission:update_job'])->put('/update/job/{jobid}', [JobController::class, 'updateJob']);
    // Route::middleware(['permission:show_specific_job'])->get('/show/job/{jobid}', [JobController::class, 'showJob']);
    // Route::middleware(['permission:show_job'])->get('/show/jobs', [JobController::class, 'showAllJobs']);
    // Route::middleware(['permission:delete_job'])->delete('/delete/job/{jobid}', [JobController::class, 'deleteJob']);

    Route::post('/create/job', [JobController::class, 'createJob']);
    Route::put('/update/job/{jobid}', [JobController::class, 'updateJob']);
    Route::get('/show/job/{jobid}', [JobController::class, 'showJob']);
    Route::get('/show/jobs', [JobController::class, 'showAllJobs']);
    Route::delete('/delete/job/{jobid}', [JobController::class, 'deleteJob']);

    Route::post('/logout', [UserController::class, 'logout']);


});


Route::post('/register/hr', [HRController::class, 'register']);
Route::post('/register/candidate', [CandidateController::class, 'register']);

Route::post('/login', [UserController::class, 'login']);

