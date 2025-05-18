<?php

namespace App\Repositories;

use App\DataTransferObjects\SubscriptionData;
use App\Models\WeatherSubscription;
use Illuminate\Support\Str;

class SubscriptionRepository
{
    public function create(SubscriptionData $data): WeatherSubscription
    {
        return WeatherSubscription::create([
            'email' => $data->email,
            'city' => $data->city,
            'frequency' => $data->frequency,
            'token' => Str::random(32),
            'subscription_confirmed' => false
        ]);
    }

    public function checkCityAndFrequency(SubscriptionData $data): bool
    {
        return WeatherSubscription::where('email', $data->email)
            ->where('city', $data->city)
            ->where('frequency', $data->frequency)
            ->exists();
    }

    public function findSubscriptionByToken(string $token): ?WeatherSubscription
    {
        return WeatherSubscription::where('token', $token)->first();
    }

    public function confirm(WeatherSubscription $weatherSubscription): bool
    {
        return $weatherSubscription->update(['subscription_confirmed' => true]);
    }

    public function unsubscribe(WeatherSubscription $weatherSubscription): bool
    {
        return $weatherSubscription->delete();
    }
}
