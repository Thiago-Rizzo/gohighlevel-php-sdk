<?php

declare(strict_types=1);

namespace MusheAbdulHakim\GoHighLevel\Contracts;

use ArrayAccess;

interface MetaInformationContract extends ArrayAccess
{
    /**
     * Returns the array representation of the meta information.
     *
     * @return TArray
     */
    public function toArray(): array;

    public function offsetExists($offset): bool;

    /**
     * @template TOffsetKey of key-of<TArray>
     *
     * @param  TOffsetKey  $offset
     * @return TArray[TOffsetKey]
     */
    public function offsetGet($offset);

    /**
     * @template TOffsetKey of key-of<TArray>
     *
     * @param  TOffsetKey  $offset
     * @param  TArray[TOffsetKey] $value
     */
    public function offsetSet($offset, $value): void;

    /**
     * @template TOffsetKey of key-of<TArray>
     *
     * @param  TOffsetKey  $offset
     */
    public function offsetUnset( $offset): void;
}
