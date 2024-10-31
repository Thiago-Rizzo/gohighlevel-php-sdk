<?php

declare(strict_types=1);

namespace GoHighLevelSDK\Resources\Locations;

use GoHighLevelSDK\Contracts\Resources\Locations\TemplateContract;
use GoHighLevelSDK\Resources\Concerns\Transportable;
use GoHighLevelSDK\ValueObjects\Transporter\Payload;

class Template implements TemplateContract
{
    use Transportable;

    /**
     * {@inheritDoc}
     */
    public function list(string $locationId, string $originId, array $params = [])
    {
        $params['originId'] = $originId;
        $payload = Payload::get("locations/{$locationId}/templates", $params);

        return $this->transporter->requestObject($payload)->get('templates');
    }

    /**
     * {@inheritDoc}
     */
    public function delete(string $locationId, string $id)
    {
        $payload = Payload::delete('locations/{locationId}/templates/', $id);

        return $this->transporter->requestObject($payload)->data();
    }
}
