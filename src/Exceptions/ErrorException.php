<?php

declare(strict_types=1);

namespace GoHighLevelSDK\Exceptions;

use Exception;

final class ErrorException extends Exception
{
    private array $contents = [];

    /**
     * Creates a new Exception instance.
     */
    public function __construct(array $contents)
    {
        $message = ($contents['message'] ?: (string)$this->contents['code']) ?: 'Unknown error';

        if (is_array($message)) {
            $message = implode(PHP_EOL, $message);
        }

        parent::__construct($message);
    }

    /**
     * Returns the error message.
     */
    public function getErrorMessage(): string
    {
        return $this->getMessage();
    }

    /**
     * Returns the error type.
     */
    public function getErrorType(): ?string
    {
        return $this->contents['type'];
    }

    /**
     * Returns the error code.
     *
     * @return string|int|null
     */
    public function getErrorCode()
    {
        return $this->contents['code'];
    }
}
