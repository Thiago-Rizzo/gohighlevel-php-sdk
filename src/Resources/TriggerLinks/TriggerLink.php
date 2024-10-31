<?php

declare(strict_types=1);

namespace GoHighLevelSDK\Resources\TriggerLinks;

use GoHighLevelSDK\Contracts\Resources\TriggerLinks\TriggerLinkContract;
use GoHighLevelSDK\Resources\Concerns\Transportable;
use GoHighLevelSDK\ValueObjects\Transporter\Payload;

final class TriggerLink implements TriggerLinkContract
{
    use Transportable;

    public function update(string $linkId, array $params)
    {
        $payload = Payload::put("links/{$linkId}", $params);

        return $this->transporter->requestObject($payload)->data();
    }

    public function delete(string $linkId)
    {
        $payload = Payload::delete('links/', $linkId);

        return $this->transporter->requestObject($payload)->data();
    }

    public function get(string $locationId)
    {
        $params['locationId'] = $locationId;
        $payload = Payload::get('links/', $params);

        return $this->transporter->requestObject($payload)->data();

    }

    public function create(array $params)
    {
        $payload = Payload::post('links/', $params);

        return $this->transporter->requestObject($payload)->data();
    }
}
