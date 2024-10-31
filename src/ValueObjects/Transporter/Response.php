<?php

declare(strict_types=1);

namespace GoHighLevelSDK\ValueObjects\Transporter;

/**
 *
 * @internal
 */
final class Response
{
    private $data;

    /**
     * Creates a new Response value object.
     *
     * @param string|array $data
     */
    private function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Creates a new Response value object from the given data.
     *
     * @param array|string $data
     * @param array $headers
     */
    public static function from($data, array $headers): self
    {
        return new self($data);
    }

    /**
     * Returns the response data.
     *
     * @return array|string
     */
    public function data()
    {
        return $this->data;
    }

    /**
     * Get item from the response data.
     *
     * @return array|string
     */
    public function get(string $key)
    {
        return $this->data[$key];
    }

    /**
     * Returns the response meta data
     *
     * @return array|string
     */
    public function meta()
    {
        return $this->data['meta'];
    }

    /**
     * Returns the response traceId
     */
    public function traceId(): string
    {
        return $this->data['traceId'];
    }
}
