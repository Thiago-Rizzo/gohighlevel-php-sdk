<?php

declare(strict_types=1);

namespace GoHighLevelSDK;

use Closure;
use Exception;
use GuzzleHttp\Client as GuzzleClient;
use Http\Discovery\Psr18Client;
use Http\Discovery\Psr18ClientDiscovery;
use GoHighLevelSDK\Transporters\HttpTransporter;
use GoHighLevelSDK\ValueObjects\Transporter\ApiKey;
use GoHighLevelSDK\ValueObjects\Transporter\BaseUri;
use GoHighLevelSDK\ValueObjects\Transporter\Headers;
use GoHighLevelSDK\ValueObjects\Transporter\QueryParams;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

final class Factory
{
    /**
     * The API key for the requests.
     */
    private ?string $apiKey = null;

    /**
     * The API Version.
     */
    private ?string $apiVersion = null;

    /**
     * The HTTP client for the requests.
     */
    private ?ClientInterface $httpClient = null;

    /**
     * The base URI for the requests.
     */
    private ?string $baseUri = null;

    /**
     * The HTTP headers for the requests.
     *
     * @var array
     */
    private array $headers = [];

    private ?Closure $streamHandler = null;

    /**
     * The query parameters for the requests.
     *
     * @var array
     */
    private array $queryParams = [];

    /**
     * Sets the API key for the requests.
     */
    public function withApiKey(string $apiKey): self
    {
        $this->apiKey = trim($apiKey);

        return $this;
    }

    /**
     * Sets the API Version for the requests
     *
     * @return $this
     */
    public function withVersion(?string $apiVersion): self
    {
        $this->apiVersion = trim((string) $apiVersion);

        return $this;
    }

    /**
     * Sets the HTTP client for the requests.
     * If no client is provided the factory will try to find one using PSR-18 HTTP Client Discovery.
     */
    public function withHttpClient(ClientInterface $client): self
    {
        $this->httpClient = $client;

        return $this;
    }

    /**
     * Sets the stream handler for the requests. Not required when using Guzzle.
     */
    public function withStreamHandler(Closure $streamHandler): self
    {
        $this->streamHandler = $streamHandler;

        return $this;
    }

    /**
     * Sets the base URI for the requests.
     * If no URI is provided the factory will use the default OpenAI API URI.
     */
    public function withBaseUri(string $baseUri): self
    {
        $this->baseUri = $baseUri;

        return $this;
    }

    /**
     * Adds a custom HTTP header to the requests.
     */
    public function withHttpHeader(string $name, string $value): self
    {
        $this->headers[$name] = $value;

        return $this;
    }

    /**
     * Adds a Content-Type HTTP header to the requests.
     */
    public function withContentType(string $value): self
    {
        $this->headers['Content-Type'] = $value;

        return $this;
    }

    /**
     * Adds a custom query parameter to the request url.
     */
    public function withQueryParam(string $name, string $value): self
    {
        $this->queryParams[$name] = $value;

        return $this;
    }

    /**
     * Creates a new stream handler for "stream" requests.
     */
    private function makeStreamHandler(ClientInterface $client): Closure
    {
        if (! is_null($this->streamHandler)) {
            return $this->streamHandler;
        }

        if ($client instanceof GuzzleClient) {
            return fn (RequestInterface $request): ResponseInterface => $client->send($request, ['stream' => true]);
        }

        if ($client instanceof Psr18Client) {
            return fn (RequestInterface $request): ResponseInterface => $client->sendRequest($request);
        }

        return function (RequestInterface $_): void {
            throw new Exception('To use stream requests you must provide an stream handler closure via the OpenAI factory.');
        };
    }

    public function make(): Client
    {
        $headers = Headers::create();
        if ($this->apiKey !== null) {
            $headers = Headers::withAuthorization(ApiKey::from($this->apiKey));
        }

        if ($this->apiVersion !== null) {
            $headers = $headers->withApiVersion($this->apiVersion);
        }

        foreach ($this->headers as $name => $value) {
            $headers = $headers->withCustomHeader($name, $value);
        }

        $baseUri = BaseUri::from($this->baseUri ?: 'https://services.leadconnectorhq.com');

        $queryParams = QueryParams::create();
        foreach ($this->queryParams as $name => $value) {
            $queryParams = $queryParams->withParam($name, $value);
        }
        $client = $this->httpClient ??= Psr18ClientDiscovery::find();

        $sendAsync = $this->makeStreamHandler($client);

        $transporter = new HttpTransporter($client, $baseUri, $headers, $queryParams, $sendAsync);

        return new Client($transporter);
    }
}
