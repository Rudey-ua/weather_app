<?php

use App\Http\Controllers\WeatherController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['controller' => WeatherController::class], function () {

    Route::get('/weather', 'getWeather');
    Route::post('/subscribe', 'subscribe');

    Route::get('/confirm/{token}', 'confirm');
    Route::get('/unsubscribe/{token}', 'unsubscribe');
});
