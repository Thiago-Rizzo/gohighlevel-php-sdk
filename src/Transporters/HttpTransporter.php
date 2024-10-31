<?php

declare(strict_types=1);

namespace GoHighLevelSDK\Transporters;

use Closure;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;
use JsonException;
use GoHighLevelSDK\Contracts\TransporterContract;
use GoHighLevelSDK\Enums\Transporter\ContentType;
use GoHighLevelSDK\Exceptions\ErrorException;
use GoHighLevelSDK\Exceptions\TransporterException;
use GoHighLevelSDK\Exceptions\UnserializableResponse;
use GoHighLevelSDK\ValueObjects\Transporter\BaseUri;
use GoHighLevelSDK\ValueObjects\Transporter\Headers;
use GoHighLevelSDK\ValueObjects\Transporter\Payload;
use GoHighLevelSDK\ValueObjects\Transporter\QueryParams;
use GoHighLevelSDK\ValueObjects\Transporter\Response;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\ResponseInterface;
use Throwable;

/**
 * @internal
 */
final class HttpTransporter implements TransporterContract
{
    private ClientInterface $client;

    private BaseUri $baseUri;

    private Headers $headers;

    private QueryParams $queryParams;

    private Closure $streamHandler;

    /**
     * Creates a new Http Transporter instance.
     */
    public function __construct(
        ClientInterface $client,
        BaseUri         $baseUri,
        Headers         $headers,
        QueryParams     $queryParams,
        Closure         $streamHandler
    )
    {
        $this->client = $client;
        $this->baseUri = $baseUri;
        $this->headers = $headers;
        $this->queryParams = $queryParams;
        $this->streamHandler = $streamHandler;
    }

    /**
     * {@inheritDoc}
     *
     * @return Response<mixed>
     *
     * @throws ErrorException
     * @throws JsonException
     * @throws TransporterException
     * @throws UnserializableResponse
     */
    public function requestObject(Payload $payload): Response
    {
        $request = $payload->toRequest($this->baseUri, $this->headers, $this->queryParams);

        $response = $this->sendRequest(fn(): ResponseInterface => $this->client->sendRequest($request));

        if ($response->getStatusCode() === 404) {
            throw new RequestException('404 Error. Please check the endpoint', $request, $response);
        }

        $contents = $response->getBody()->getContents();

        if (str_contains($response->getHeaderLine('Content-Type'), ContentType::TEXT_PLAIN)) {
            return Response::from($contents, $response->getHeaders());
        }

        $this->throwIfJsonError($response, $contents);

        try {
            /** @var array{error?: array{message: string, type: string, code: string}} $data */
            $data = json_decode($contents, true, JSON_THROW_ON_ERROR);
        } catch (Throwable $jsonException) {
            throw new UnserializableResponse($jsonException);
        }

        return Response::from($data, $response->getHeaders());
    }

    /**
     * {@inheritDoc}
     */
    public function requestContent(Payload $payload): string
    {
        $request = $payload->toRequest($this->baseUri, $this->headers, $this->queryParams);

        $response = $this->sendRequest(fn(): ResponseInterface => $this->client->sendRequest($request));

        $contents = $response->getBody()->getContents();

        $this->throwIfJsonError($response, $contents);

        return $contents;
    }

    /**
     * {@inheritDoc}
     */
    public function requestStream(Payload $payload): ResponseInterface
    {
        $request = $payload->toRequest($this->baseUri, $this->headers, $this->queryParams);

        $response = $this->sendRequest(fn() => ($this->streamHandler)($request));

        $this->throwIfJsonError($response, $response);

        return $response;
    }

    private function sendRequest(Closure $callable): ResponseInterface
    {
        try {
            return $callable();
        } catch (Throwable $clientException) {
            if ($clientException instanceof ClientException) {
                $this->throwIfJsonError($clientException->getResponse(), $clientException->getResponse()->getBody()->getContents());
            }

            throw new TransporterException($clientException);
        }
    }

    /**
     * @param ResponseInterface $response
     * @param string|ResponseInterface $contents
     * @return void
     * @throws ErrorException
     * @throws UnserializableResponse
     */
    private function throwIfJsonError(ResponseInterface $response, $contents): void
    {
        if ($response->getStatusCode() < 400) {
            return;
        }

        if (!str_contains($response->getHeaderLine('Content-Type'), ContentType::JSON)) {
            return;
        }

        if ($contents instanceof ResponseInterface) {
            $contents = $contents->getBody()->getContents();
        }

        try {
            /** @var array{error?: array{message: string|array, type: string, code: string}} $response */
            $response = json_decode($contents, true, JSON_THROW_ON_ERROR);

            if (isset($response['error'])) {
                throw new ErrorException($response);
            }
        } catch (Throwable $jsonException) {
            throw new UnserializableResponse($jsonException);
        }
    }
}
