<?php

declare(strict_types=1);

namespace MusheAbdulHakim\GoHighLevel\ValueObjects\Transporter;

final class ApiKey
{
    public string $apiKey;

    /**
     * Creates a new API token value object.
     */
    private function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
    }

    public static function from(string $apiKey): self
    {
        return new self($apiKey);
    }

    public function toString(): string
    {
        return $this->apiKey;
    }
}
