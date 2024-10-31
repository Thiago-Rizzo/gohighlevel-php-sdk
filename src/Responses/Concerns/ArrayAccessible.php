<?php

declare(strict_types=1);

namespace GoHighLevelSDK\Responses\Concerns;

use BadMethodCallException;

/**
 * @template TArray of array
 *
 * @mixin Response<TArray>
 */
trait ArrayAccessible
{
    /**
     * {@inheritDoc}
     */
    public function offsetExists( $offset): bool
    {
        return array_key_exists($offset, $this->toArray());
    }

    /**
     * {@inheritDoc}
     */
    public function offsetGet( $offset)
    {
        return $this->toArray()[$offset]; // @phpstan-ignore-line
    }

    /**
     * {@inheritDoc}
     */
    public function offsetSet( $offset,  $value): void
    {
        throw new BadMethodCallException('Cannot set response attributes.');
    }

    /**
     * {@inheritDoc}
     */
    public function offsetUnset( $offset): void
    {
        throw new BadMethodCallException('Cannot unset response attributes.');
    }
}
