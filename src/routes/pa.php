<?php

use App\Http\Controllers\Pa\PersonalAccountController;
use App\Models\Pages\Pages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::controller(PersonalAccountController::class)
    ->middleware('auth:pa')
    ->group(function () {
        Route::get('/', 'index');
        Route::get('/signin', 'signin')->name('login')->withoutMiddleware('auth:pa');
    });
