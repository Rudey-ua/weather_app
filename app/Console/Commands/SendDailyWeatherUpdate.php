<?php

namespace App\Console\Commands;

use App\Console\Constants\FrequencyTypes;
use App\Jobs\SendWeatherUpdateJob;
use Illuminate\Console\Command;

class SendDailyWeatherUpdate extends Command
{
    protected $signature = 'app:send-daily-weather-update';

    public function handle(): void
    {
        $type = FrequencyTypes::DAILY;

        $this->info("Start Send $type weather update");

        SendWeatherUpdateJob::dispatch($type);

        $this->info("End Send $type weather update");
    }
}
