<?php

namespace GoHighLevelSDK\Resources\Payments;

use GoHighLevelSDK\Contracts\Resources\Payments\CustomProviderContract;
use GoHighLevelSDK\Resources\Concerns\Transportable;
use GoHighLevelSDK\ValueObjects\Transporter\Payload;

class CustomProvider implements CustomProviderContract
{
    use Transportable;

    /**
     * {@inheritDoc}
     */
    public function create(string $locationId, array $params = [])
    {
        $params['locationId'] = $locationId;
        $payload = Payload::create('payments/custom-provider/provider', $params);

        return $this->transporter->requestObject($payload)->data();
    }

    /**
     * {@inheritDoc}
     */
    public function delete(string $locationId)
    {
        $params['locationId'] = $locationId;
        $payload = Payload::deleteFromUri('payments/custom-provider/provider');

        return $this->transporter->requestObject($payload)->data();
    }

    /**
     * {@inheritDoc}
     */
    public function getConfig(string $locationId)
    {
        $params['locationId'] = $locationId;
        $payload = Payload::get('payments/custom-provider/connect', $params);

        return $this->transporter->requestObject($payload)->data();
    }

    /**
     * {@inheritDoc}
     */
    public function createConfig(string $locationId, array $params)
    {
        $payload = Payload::post("payments/custom-provider/connect?locationId={$locationId}", $params);

        return $this->transporter->requestObject($payload)->data();
    }

    /**
     * {@inheritDoc}
     */
    public function deleteConfig(string $locationId, bool $liveMode)
    {
        $params['liveMode'] = $liveMode;
        $payload = Payload::post("payments/custom-provider/disconnect?locationId={$locationId}", $params);

        return $this->transporter->requestObject($payload)->data();
    }
}
