<?php

use App\Http\Controllers\Pa\AchievementController;
use App\Http\Controllers\Pa\AuthorizationController;
use App\Http\Controllers\Pa\ExaminationSheetController;
use App\Http\Controllers\Pa\UserController;
use Illuminate\Http\Request;
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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::prefix('auth')
        ->group(function () {
                Route::post('/signin', [AuthorizationController::class, 'signin']);
                Route::post('/login', [AuthorizationController::class, 'login']);
                Route::post('/check', [AuthorizationController::class, 'check'])->middleware('auth:sanctum', 'acount');
                Route::post('/logout', [AuthorizationController::class, 'logout'])->middleware('auth:sanctum', 'acount');
        });

Route::prefix('pa/users')
        ->group(function () {
                Route::put('/edit', [UserController::class, 'edit']);
                Route::delete('/delete', [UserController::class, 'detete']);
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
