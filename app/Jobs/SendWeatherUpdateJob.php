<?php

namespace App\Jobs;

use App\DataTransferObjects\WeatherData;
use App\Mail\ScheduledWeatherUpdateMail;
use App\Repositories\SubscriptionRepository;
use App\Services\WeatherService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendWeatherUpdateJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public string $type)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $weatherService = app(WeatherService::class);
        $subscriptionRepository = app(SubscriptionRepository::class);
        $scheduledSubscriptions = $subscriptionRepository->getScheduledWeatherSubscriptions($this->type);

        if (empty($scheduledSubscriptions)) {
            Log::info("Empty subscription $this->type list!");
            return;
        }

        foreach($scheduledSubscriptions as $subscription) {

            $weather = $weatherService->getCurrentWeatherByCity($subscription->city);
            $weatherData = WeatherData::fromArray($weather['current']);

            Mail::to($subscription->email)->queue(new ScheduledWeatherUpdateMail(
                    weatherData: $weatherData,
                    type: $subscription->frequency,
                    city: $subscription->city,
                    token: $subscription->token
                )
            );
        }
    }
}
