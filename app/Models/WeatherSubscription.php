<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WeatherSubscription extends Model
{
    protected $fillable = [
        'email',
        'city',
        'frequency',
        'token',
        'subscription_confirmed'
    ];
}
