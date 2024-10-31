<?php

declare(strict_types=1);

namespace GoHighLevelSDK\ValueObjects\Transporter;

use Http\Discovery\Psr17Factory;
use Http\Message\MultipartStream\MultipartStreamBuilder;
use JsonException;
use GoHighLevelSDK\Enums\Transporter\ContentType;
use GoHighLevelSDK\Enums\Transporter\Method;
use GoHighLevelSDK\ValueObjects\ResourceUri;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\StreamInterface;

/**
 * @internal
 */
final class Payload
{
    private string $contentType;
    private string $method;
    private ResourceUri $uri;
    private array $parameters;

    /**
     * Creates a new Request value object.
     *
     * @param string $contentType
     * @param string $method
     * @param ResourceUri $uri
     * @param array $parameters
     */
    public function __construct(
        string $contentType,
        string      $method,
        ResourceUri $uri,
        array       $parameters = []
    )
    {
        $this->contentType = $contentType;
        $this->method = $method;
        $this->uri = $uri;
        $this->parameters = $parameters;
    }

    /**
     * Creates a new Payload value object from the given parameters.
     *
     * @param array $parameters
     */
    public static function list(string $resource, array $parameters = []): self
    {
        $contentType = ContentType::JSON;
        $method = Method::GET;
        $uri = ResourceUri::list($resource);

        return new self($contentType, $method, $uri, $parameters);
    }

    /**
     * Creates a new Payload value object from the given parameters.
     *
     * @param array $parameters
     */
    public static function retrieve(string $resource, string $id, string $suffix = '', array $parameters = []): self
    {
        $contentType = ContentType::JSON;
        $method = Method::GET;
        $uri = ResourceUri::retrieve($resource, $id, $suffix);

        return new self($contentType, $method, $uri, $parameters);
    }

    /**
     * Creates a new Payload value object from the given parameters.
     *
     * @param array $parameters
     */
    public static function modify(string $resource, string $id, array $parameters = []): self
    {
        $contentType = ContentType::JSON;
        $method = Method::POST;
        $uri = ResourceUri::modify($resource, $id);

        return new self($contentType, $method, $uri, $parameters);
    }

    /**
     * Create new payload that sends a post request
     *
     * @param array $parameters
     */
    public static function post(string $resource, array $parameters = []): self
    {
        $contentType = ContentType::JSON;
        $method = Method::POST;
        $uri = ResourceUri::get($resource);

        return new self($contentType, $method, $uri, $parameters);
    }

    /**
     * Create new custom payload that sends whatever request you choose
     *
     * @param array $parameters
     */
    public static function custom(string $method, string $contentType, string $resource, array $parameters = []): self
    {
        $uri = ResourceUri::get($resource);

        return new self($contentType, $method, $uri, $parameters);
    }

    /**
     * Creates a new Payload value object from the given parameters.
     *
     * @param array $parameters
     */
    public static function put(string $resource, array $parameters = []): self
    {
        $contentType = ContentType::JSON;
        $method = Method::PUT;
        $uri = ResourceUri::get($resource);

        return new self($contentType, $method, $uri, $parameters);
    }

    /**
     * Creates a new Payload value object from the given parameters.
     *
     * @param array $parameters
     */
    public static function patch(string $resource, array $parameters = []): self
    {
        $contentType = ContentType::JSON;
        $method = Method::PATCH;
        $uri = ResourceUri::get($resource);

        return new self($contentType, $method, $uri, $parameters);
    }

    /**
     * Creates a new Payload value object from the given parameters.
     */
    public static function retrieveContent(string $resource, string $id): self
    {
        $contentType = ContentType::JSON;
        $method = Method::GET;
        $uri = ResourceUri::retrieveContent($resource, $id);

        return new self($contentType, $method, $uri);
    }

    /**
     * Creates a new Payload value object from the given parameters.
     *
     * @param array $parameters
     */
    public static function create(string $resource, array $parameters): self
    {
        $contentType = ContentType::JSON;
        $method = Method::POST;
        $uri = ResourceUri::create($resource);

        return new self($contentType, $method, $uri, $parameters);
    }

    /**
     * Creates a new Payload value object from the given parameters.
     *
     * @param array $parameters
     */
    public static function upload(string $resource, array $parameters): self
    {
        $contentType = ContentType::MULTIPART;
        $method = Method::POST;
        $uri = ResourceUri::upload($resource);

        return new self($contentType, $method, $uri, $parameters);
    }

    /**
     * Creates a new Payload value object from the given parameters.
     */
    public static function delete(string $resource, string $id): self
    {
        $contentType = ContentType::JSON;
        $method = Method::DELETE;
        $uri = ResourceUri::delete($resource, $id);

        return new self($contentType, $method, $uri);
    }

    /**
     * Creates a new Payload value object from the given parameters.
     */
    public static function deleteFromUri(string $resource): self
    {
        $contentType = ContentType::JSON;
        $method = Method::DELETE;
        $uri = ResourceUri::get($resource);

        return new self($contentType, $method, $uri);
    }

    /**
     * Create a new payload value object from the given parameters using a get method.
     *
     * @param array $params
     */
    public static function get(string $resource, array $params = []): self
    {
        $contentType = ContentType::JSON;
        $method = Method::GET;
        $uri = ResourceUri::get($resource);

        return new self($contentType, $method, $uri, $params);
    }

    /**
     * Creates a new Psr 7 Request instance.
     *
     * @throws JsonException
     */
    public function toRequest(BaseUri $baseUri, Headers $headers, QueryParams $queryParams): RequestInterface
    {
        $psr17Factory = new Psr17Factory();

        $body = null;

        $uri = $baseUri->toString() . $this->uri->toString();

        $queryParams = $queryParams->toArray();
        if ($this->method === Method::GET) {
            $queryParams = array_merge($queryParams, $this->parameters);
        }

        if ($queryParams !== []) {
            $uri .= '?' . http_build_query($queryParams);
        }

        $headers = $headers->withContentType($this->contentType);

        if ($this->method === Method::POST) {
            if ($this->contentType === ContentType::MULTIPART) {
                $streamBuilder = new MultipartStreamBuilder($psr17Factory);

                $parameters = $this->parameters;

                foreach ($parameters as $key => $value) {
                    if (is_int($value) || is_float($value) || is_bool($value)) {
                        $value = (string)$value;
                    }

                    if (is_array($value)) {
                        foreach ($value as $nestedValue) {
                            $streamBuilder->addResource($key . '[]', $nestedValue);
                        }

                        continue;
                    }

                    $streamBuilder->addResource($key, $value);
                }

                $body = $streamBuilder->build();

                $headers = $headers->withContentType($this->contentType, '; boundary=' . $streamBuilder->getBoundary());
            } else {
                $body = $psr17Factory->createStream(json_encode($this->parameters, JSON_THROW_ON_ERROR));
            }
        }

        $request = $psr17Factory->createRequest($this->method, $uri);

        if ($body instanceof StreamInterface) {
            $request = $request->withBody($body);
        }

        foreach ($headers->toArray() as $name => $value) {
            $request = $request->withHeader($name, $value);
        }

        return $request;
    }
}
