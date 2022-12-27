<?php

use Illuminate\Support\Facades\Route;
use DiskominfotikBandaAceh\SSOBandaAcehPHP\Http\Controllers\SSOController;
use DiskominfotikBandaAceh\SSOBandaAcehPHP\Http\Controllers\LoginController;

Route::group(['middleware' => ['web'], 'prefix' => 'sso', 'as' => 'sso.'], function () {
    Route::get('/login', [LoginController::class, 'login'])->name('login');

    Route::group(['middleware' => ['guest'], 'prefix'=>'auth'], function () {
        Route::get('/redirect', [SSOController::class, 'redirect'])->name('redirect');
        Route::get('/callback', [SSOController::class, 'callback'])->name('callback');
        Route::get('/logout', [SSOController::class, 'logout'])->name('logout');
    });
});