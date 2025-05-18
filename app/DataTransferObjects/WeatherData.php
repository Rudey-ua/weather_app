<?php

namespace App\DataTransferObjects;

class WeatherData
{
    public function __construct(
        public float $temperature,
        public float $humidity,
        public string $description
    ){}

    public static function fromArray(array $data): self
    {
        return new self(
            temperature: $data['temp_c'],
            humidity: $data['humidity'],
            description: $data['condition']['text']
        );
    }
}
