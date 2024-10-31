<?php

declare(strict_types=1);

namespace GoHighLevelSDK\Contracts;

use GoHighLevelSDK\Exceptions\ErrorException;
use GoHighLevelSDK\Exceptions\TransporterException;
use GoHighLevelSDK\Exceptions\UnserializableResponse;
use GoHighLevelSDK\ValueObjects\Transporter\Payload;
use GoHighLevelSDK\ValueObjects\Transporter\Response;
use Psr\Http\Message\ResponseInterface;

interface TransporterContract
{
    /**
     * Sends a request to a server.
     *
     * @return Response<array<array-key, mixed>|string>
     *
     * @throws ErrorException|UnserializableResponse|TransporterException
     */
    public function requestObject(Payload $payload): Response;

    /**
     * Sends a content request to a server.
     *
     * @throws ErrorException|TransporterException
     */
    public function requestContent(Payload $payload): string;

    /**
     * Sends a stream request to a server.
     **
     * @throws ErrorException
     */
    public function requestStream(Payload $payload): ResponseInterface;
}
