<?php

declare(strict_types=1);

namespace GoHighLevelSDK\Resources;

use GoHighLevelSDK\Contracts\Resources\BusinessContract;
use GoHighLevelSDK\ValueObjects\Transporter\Payload;
use GoHighLevelSDK\ValueObjects\Transporter\Response;

final class Business implements BusinessContract
{
    use Concerns\Transportable;

    public function update(string $businessId, array $params): Response
    {
        $payload = Payload::put("businesses/$businessId", $params);

        return $this->transporter->requestObject($payload);
    }

    public function delete(string $businessId): Response
    {
        $payload = Payload::delete('businesses/', $businessId);

        return $this->transporter->requestObject($payload);
    }

    public function get(string $businessId): Response
    {
        $payload = Payload::get("businesses/{$businessId}");

        return $this->transporter->requestObject($payload);
    }

    public function getByLocation(string $locationId): Response
    {
        $payload = Payload::get('businesses/', [
            'locationId' => $locationId,
        ]);

        return $this->transporter->requestObject($payload);
    }

    public function create(string $name, string $locationId, array $params): Response
    {
        $params['name'] = $name;
        $params['locationId'] = $locationId;
        $payload = Payload::create('businesses/', $params);

        return $this->transporter->requestObject($payload);
    }
}
