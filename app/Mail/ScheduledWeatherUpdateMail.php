<?php

namespace App\Mail;

use App\DataTransferObjects\WeatherData;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ScheduledWeatherUpdateMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(public WeatherData $weatherData, public string $type, public string $city, public string $token)
    {
        //
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $type = ucfirst($this->type);

        return new Envelope(
            subject: "{$type} Weather update",
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.scheduled-weather-update-mail',
            with: [
                'city' => $this->city,
                'temperature' => $this->weatherData->temperature,
                'humidity' => $this->weatherData->humidity,
                'description' => $this->weatherData->description,
                'token' => $this->token
            ]
        );
    }
}
