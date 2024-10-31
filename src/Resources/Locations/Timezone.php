<?php

declare(strict_types=1);

namespace GoHighLevelSDK\Resources\Locations;

use GoHighLevelSDK\Contracts\Resources\Locations\TimezoneContract;
use GoHighLevelSDK\Resources\Concerns\Transportable;
use GoHighLevelSDK\ValueObjects\Transporter\Payload;

class Timezone implements TimezoneContract
{
    use Transportable;

    /**
     * {@inheritDoc}
     */
    public function list(string $locationId)
    {
        $payload = Payload::get("locations/{$locationId}/timezones");

        return $this->transporter->requestObject($payload)->data();
    }
}
