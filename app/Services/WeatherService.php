<?php

namespace App\Services;

use App\DataTransferObjects\SubscriptionData;
use App\Exceptions\EmailAlreadySubscribedException;
use App\Exceptions\InvalidInputException;
use App\Exceptions\TokenNotFoundException;
use App\Mail\ConfirmWeatherSubscriptionMail;
use App\Models\WeatherSubscription;
use App\Repositories\SubscriptionRepository;
use Exception;
use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class WeatherService
{
    public function __construct(public SubscriptionRepository $subscriptionRepository)
    {

    }

    public function getCurrentWeatherByCity(string $city): PromiseInterface|Response|null
    {
        $apiKey = config('services.weather.api_key');
        $url = config('services.weather.base_url') . config('services.weather.endpoints.current_weather');

        try {
            return Http::get($url, "q={$city}&key={$apiKey}");

        } catch (Exception $e) {
            Log::error("Failed to fetch weather data for {$city}. Reason: {$e->getMessage()}");
            return null;
        }
    }

    /**
     * @throws EmailAlreadySubscribedException
     * @throws InvalidInputException
     */
    public function subscribeForUpdates(SubscriptionData $data): WeatherSubscription
    {
        if ($this->subscriptionRepository->checkCityAndFrequency($data)) {
            throw new EmailAlreadySubscribedException();
        }
        $response = $this->getCurrentWeatherByCity($data->city);

        if (isset($response['error']) && $response['error']['code'] === config('services.weather.error_codes.not_found')) {
            throw new InvalidInputException();
        }
        $subscription = $this->subscriptionRepository->create($data);

        Mail::to($subscription->email)->send(new ConfirmWeatherSubscriptionMail($subscription->token));

        return $subscription;
    }

    /**
     * @throws TokenNotFoundException
     * @throws InvalidInputException
     */
    public function confirmEmailSubscription(string $token): void
    {
        $subscription = $this->subscriptionRepository->findSubscriptionByToken($token);

        if (is_null($subscription)) {
            throw new TokenNotFoundException();
        }
        if ($subscription->subscription_confirmed) {
            throw new InvalidInputException();
        }
        $this->subscriptionRepository->confirm($subscription);
    }

    /**
     * @throws TokenNotFoundException
     * @throws InvalidInputException
     */
    public function unsubscribe(string $token): void
    {
        $subscription = $this->subscriptionRepository->findSubscriptionByToken($token);

        if (is_null($subscription)) {
            throw new TokenNotFoundException();
        }
        if (!$subscription->subscription_confirmed) {
            throw new InvalidInputException();
        }
        $this->subscriptionRepository->unsubscribe($subscription);
    }
}
