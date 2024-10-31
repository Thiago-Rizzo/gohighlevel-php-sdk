<?php

namespace GoHighLevelSDK\Resources\Payments;

use GoHighLevelSDK\Contracts\Resources\Payments\IntegrationContract;
use GoHighLevelSDK\Resources\Concerns\Transportable;
use GoHighLevelSDK\ValueObjects\Transporter\Payload;

class Integration implements IntegrationContract
{
    use Transportable;

    /**
     * {@inheritDoc}
     */
    public function create(array $params)
    {
        $payload = Payload::create('payments/integrations/provider/whitelabel', $params);

        return $this->transporter->requestObject($payload)->data();
    }

    /**
     * {@inheritDoc}
     */
    public function list(string $altId, string $altType, array $params = [])
    {
        $payload = Payload::get('payments/integrations/provider/whitelabel', $params);

        return $this->transporter->requestObject($payload)->data();
    }
}
