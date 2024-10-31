<?php

declare(strict_types=1);

namespace GoHighLevelSDK\ValueObjects\Transporter;

use GoHighLevelSDK\Enums\Transporter\ContentType;

/**
 * @internal
 */
final class Headers
{
    private array $headers;

    /**
     * Creates a new Headers value object.
     *
     * @param array $headers
     */
    private function __construct(array $headers)
    {
        $this->headers = $headers;
    }

    /**
     * Creates a new Headers value object
     */
    public static function create(): self
    {
        return new self([]);
    }

    /**
     * Creates a new Headers value object with the given API token.
     */
    public static function withAuthorization(ApiKey $apiKey): self
    {
        return new self([
            'Authorization' => "Bearer {$apiKey->toString()}",
        ]);
    }

    /**
     * Creates a new Headers value object, with the given content type, and the existing headers.
     */
    public function withContentType(string $contentType, string $suffix = ''): self
    {
        return new self(array_merge(
            $this->headers,
            ['Content-Type' => $contentType . $suffix]
        ));
    }

    /**
     * Creates a new Headers value object, with the given api version, and the existing headers.
     */
    public function withApiVersion(string $apiVersion): self
    {
        return new self(array_merge(
            $this->headers,
            ['Version' => $apiVersion]
        ));
    }

    /**
     * Creates a new Headers value object, with the newly added header, and the existing headers.
     */
    public function withCustomHeader(string $name, string $value): self
    {
        return new self(array_merge(
            $this->headers,
            [$name => $value]
        ));
    }

    /**
     * @return array $headers
     */
    public function toArray(): array
    {
        return $this->headers;
    }
}
