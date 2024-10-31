<?php

declare(strict_types=1);

namespace GoHighLevelSDK\Resources\Locations;

use GoHighLevelSDK\Contracts\Resources\Locations\SearchContract;
use GoHighLevelSDK\Resources\Concerns\Transportable;
use GoHighLevelSDK\ValueObjects\Transporter\Payload;

class Search implements SearchContract
{
    use Transportable;

    /**
     * {@inheritDoc}
     */
    public function search(array $params)
    {
        $payload = Payload::get('locations/search', $params);

        return $this->transporter->requestObject($payload)->get('locations');
    }

    /**
     * {@inheritDoc}
     */
    public function tasks(string $locationId, array $params = [])
    {
        $payload = Payload::get("locations/{$locationId}/tasks/search", $params);

        return $this->transporter->requestObject($payload)->get('tasks');
    }
}
