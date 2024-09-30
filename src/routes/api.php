<?php

use App\Http\Controllers\Pa\AchievementController;
use App\Http\Controllers\Pa\AuthorizationController;
use App\Http\Controllers\Pa\ExaminationSheetController;
use App\Http\Controllers\Pa\FileUpload;
use App\Http\Controllers\Pa\UserController;
use Illuminate\Support\Facades\Route;

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

Route::prefix('auth')
        ->group(function () {
                Route::post('/signin', [AuthorizationController::class, 'signin']);
                Route::post('/login', [AuthorizationController::class, 'login']);
                Route::post('/check', [AuthorizationController::class, 'check'])->middleware('auth:sanctum');
                Route::post('/logout', [AuthorizationController::class, 'logout'])->middleware('auth:sanctum');
        });

Route::prefix('pa/users')
        ->middleware('auth:sanctum')
        ->group(function () {
                Route::put('/personal_data/edit', [UserController::class, 'personalDataEdit']);
                Route::put('/main_info/edit', [UserController::class, 'mainInfoEdit']);
                Route::prefix('files')->group(function () {
                        Route::post('/upload',  [FileUpload::class, 'upload']);
                        Route::delete('/delete', [FileUpload::class, 'delete']);
                });
                Route::put('/dissertation_work/edit', [UserController::class, 'dissertationWorkEdit']);
                Route::put('/scientific_supervisor/edit', [UserController::class, 'scientificSupervisorEdit']);
        });

Route::prefix('pa/achievments')
        ->group(function () {
                Route::put('/edit', [AchievementController::class, 'edit']);
                Route::delete('/delete', [AchievementController::class, 'delete']);
        });

Route::prefix('pa/examination-sheets')
        ->group(function () {
                Route::put('/edit', [ExaminationSheetController::class, 'edit']);
                Route::delete('/delete', [ExaminationSheetController::class, 'delete']);
        });
