<?php

declare(strict_types=1);

namespace MusheAbdulHakim\GoHighLevel\Resources\Auth;

use MusheAbdulHakim\GoHighLevel\Contracts\Auth\OAuthContract;
use MusheAbdulHakim\GoHighLevel\Enums\Transporter\ContentType;
use MusheAbdulHakim\GoHighLevel\Enums\Transporter\Method;
use MusheAbdulHakim\GoHighLevel\Resources\Concerns\Transportable;
use MusheAbdulHakim\GoHighLevel\ValueObjects\Transporter\Payload;
use MusheAbdulHakim\GoHighLevel\ValueObjects\Transporter\Response;

final class OAuth implements OAuthContract
{
    use Transportable;

    public function get(string $client_id, string $client_secret, string $grant_type, array $params = []): Response
    {
        $params['client_id'] = $client_id;
        $params['client_secret'] = $client_secret;
        $params['grant_type'] = $grant_type;
        $payload = Payload::custom(Method::POST, ContentType::URL_ENCODE, 'oauth/token/', $params);

        return $this->transporter->requestObject($payload);
    }

    /**
     * @param string $companyId
     * @param string $locationId
     * @return array|string
     * @throws \MusheAbdulHakim\GoHighLevel\Exceptions\ErrorException
     * @throws \MusheAbdulHakim\GoHighLevel\Exceptions\TransporterException
     * @throws \MusheAbdulHakim\GoHighLevel\Exceptions\UnserializableResponse
     */
    public function AcessFromAgency(string $companyId, string $locationId)
    {
        $params['companyId'] = $companyId;
        $params['locationId'] = $locationId;
        $payload = Payload::post('oauth/locationToken', $params);

        return $this->transporter->requestObject($payload)->data();
    }

    /**
     * @param string $appId
     * @param string $companyId
     * @param array $params
     * @return array|string
     * @throws \MusheAbdulHakim\GoHighLevel\Exceptions\ErrorException
     * @throws \MusheAbdulHakim\GoHighLevel\Exceptions\TransporterException
     * @throws \MusheAbdulHakim\GoHighLevel\Exceptions\UnserializableResponse
     */
    public function appLocation(string $appId, string $companyId, array $params = [])
    {
        $params['appId'] = $appId;
        $params['companyId'] = $companyId;
        $payload = Payload::get('oauth/installedLocations', $params);

        return $this->transporter->requestObject($payload)->data();
    }

    /**
     * @param string $appId
     * @param string $companyId
     * @param array $params
     * @return array|string
     * @throws \MusheAbdulHakim\GoHighLevel\Exceptions\ErrorException
     * @throws \MusheAbdulHakim\GoHighLevel\Exceptions\TransporterException
     * @throws \MusheAbdulHakim\GoHighLevel\Exceptions\UnserializableResponse
     */
    public function location(string $appId, string $companyId, array $params = [])
    {
        $params['appId'] = $appId;
        $params['companyId'] = $companyId;
        $payload = Payload::get('oauth/installedLocations', $params);

        return $this->transporter->requestObject($payload)->data();

    }
}
