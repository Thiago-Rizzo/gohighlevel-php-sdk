<?php

declare(strict_types=1);

namespace GoHighLevelSDK\Contracts;

interface StringableContract
{
    /**
     * Returns the string representation of the object.
     */
    public function toString(): string;
}
