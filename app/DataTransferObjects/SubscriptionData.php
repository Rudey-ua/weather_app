<?php

namespace App\DataTransferObjects;

readonly class SubscriptionData
{
    public function __construct(
        public string $email,
        public string $city,
        public string $frequency
    ){}

    public static function fromArray(array $data): self
    {
        return new self(
            email: $data['email'],
            city: $data['city'],
            frequency: $data['frequency']
        );
    }
}
