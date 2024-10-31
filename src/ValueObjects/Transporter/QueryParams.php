<?php

declare(strict_types=1);

namespace MusheAbdulHakim\GoHighLevel\ValueObjects\Transporter;

/**
 * @internal
 */
final class QueryParams
{
    private array $params;

    /**
     * Creates a new Query Params value object.
     *
     * @param array $params
     */
    private function __construct(array $params)
    {
        $this->params = $params;
    }

    /**
     * Creates a new Query Params value object
     */
    public static function create(): self
    {
        return new self([]);
    }

    /**
     * Creates a new Query Params value object, with the newly added param, and the existing params.
     *
     * @params string $name
     * @params string|int $value
     */
    public function withParam(string $name, $value): self
    {
        return new self(array_merge(
            $this->params,
            [$name => $value]
        ));
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return $this->params;
    }
}
