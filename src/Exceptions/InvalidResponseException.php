<?php

declare(strict_types=1);

namespace MusheAbdulHakim\GoHighLevel\Exceptions;

use Exception;
use Psr\Http\Message\ResponseInterface;

final class InvalidResponseException extends Exception
{
    public function __construct(private ResponseInterface $response)
    {
        $message = ($response->getReasonPhrase() ?: (string) $response->getStatusCode()) ?: 'Unknown error';

        if (is_array($message)) {
            $message = implode(PHP_EOL, $message);
        }
        parent::__construct($message);
    }
}
