<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Schedule::command('app:send-hourly-weather-update')->hourly();
Schedule::command('app:send-daily-weather-update')->dailyAt('9:00');
