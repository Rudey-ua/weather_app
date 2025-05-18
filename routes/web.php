<?php

use App\Http\Controllers\WebWeatherController;
use Illuminate\Support\Facades\Route;


Route::post('/subscribe', [WebWeatherController::class, 'subscribe'])->name('weather.subscribe');
Route::get('/', [WebWeatherController::class, 'showForm'])->name('weather.form');
