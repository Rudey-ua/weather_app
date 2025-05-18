<?php

namespace App\Http\Controllers;

use App\DataTransferObjects\SubscriptionData;
use App\DataTransferObjects\WeatherData;
use App\Exceptions\EmailAlreadySubscribedException;
use App\Exceptions\InvalidInputException;
use App\Exceptions\TokenNotFoundException;
use App\Http\Requests\SubscribeWeatherRequest;
use App\Services\WeatherService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class WeatherController extends Controller
{
    public function __construct(public WeatherService $weatherService)
    {

    }

    public function getWeather(Request $request): JsonResponse|Response
    {
        $data = $this->weatherService->getCurrentWeatherByCity($request['city']);

        if (isset($data['error']) && $data['error']['code'] === config('services.weather.error_codes.not_found')) {
            return response(null, 404);
        }

        if (isset($data['current'])) {
            return response()->json(WeatherData::fromArray($data['current']));
        }
        return response(null, 400);
    }

    public function subscribe(SubscribeWeatherRequest $request): Response
    {
        $validated = $request->validated();
        $subscriptionData = SubscriptionData::fromArray($validated);

        try {
            $this->weatherService->subscribeForUpdates($subscriptionData);
            return response(null, 200);

        } catch (EmailAlreadySubscribedException $e) {
            return $e->render();
        } catch (InvalidInputException $e) {
            return $e->render();
        }
    }

    public function confirm(string $token): Response
    {
        try {
            $this->weatherService->confirmEmailSubscription($token);
            return response(null, 200);

        } catch (TokenNotFoundException $e) {
            return $e->render();
        } catch (InvalidInputException $e) {
            return $e->render();
        }
    }

    public function unsubscribe(string $token): Response
    {
        try {
            $this->weatherService->unsubscribe($token);
            return response(null, 200);

        } catch (TokenNotFoundException $e) {
            return $e->render();
        } catch (InvalidInputException $e) {
            return $e->render();
        }
    }
}
