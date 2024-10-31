<?php

namespace GoHighLevelSDK\Resources\Payments;

use GoHighLevelSDK\Contracts\Resources\Payments\OrderContract;
use GoHighLevelSDK\Resources\Concerns\Transportable;
use GoHighLevelSDK\ValueObjects\Transporter\Payload;

class Order implements OrderContract
{
    use Transportable;

    /**
     * {@inheritDoc}
     */
    public function list(string $altId, string $altType, array $params = [])
    {
        $params['altId'] = $altId;
        $params['altType'] = $altType;
        $payload = Payload::get('payments/orders', $params);

        return $this->transporter->requestObject($payload)->data();
    }

    /**
     * {@inheritDoc}
     */
    public function get(string $orderId, array $params = [])
    {
        $payload = Payload::get("payments/orders/{$orderId}", $params);

        return $this->transporter->requestObject($payload)->data();
    }
}
