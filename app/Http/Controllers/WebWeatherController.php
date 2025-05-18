<?php

namespace App\Http\Controllers;

use App\DataTransferObjects\SubscriptionData;
use App\Exceptions\EmailAlreadySubscribedException;
use App\Exceptions\InvalidInputException;
use App\Services\WeatherService;
use Illuminate\Http\Request;

class WebWeatherController extends Controller
{
    public function showForm()
    {
        return view('welcome');
    }

    public function subscribe(Request $request, WeatherService $weatherService)
    {
        $validated = $request->validate([
            'email' => ['required', 'email'],
            'city' => ['required', 'string'],
            'frequency' => ['required', 'string', 'in:hourly,daily'],
        ]);
        $subscriptionData = SubscriptionData::fromArray($validated);

        try {
            $weatherService->subscribeForUpdates($subscriptionData);

            return back()->with('success', 'You have successfully subscribed to weather updates!');

        } catch (EmailAlreadySubscribedException $e) {
            return back()->withErrors(['email' => 'This email is already subscribed.'])->withInput();

        } catch (InvalidInputException $e) {
            return back()->withErrors(['city' => 'City not found or invalid.'])->withInput();
        }
    }
}
