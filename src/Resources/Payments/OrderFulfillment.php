<?php

namespace GoHighLevelSDK\Resources\Payments;

use GoHighLevelSDK\Contracts\Resources\Payments\OrderFulfillmentContract;
use GoHighLevelSDK\Resources\Concerns\Transportable;
use GoHighLevelSDK\ValueObjects\Transporter\Payload;

class OrderFulfillment implements OrderFulfillmentContract
{
    use Transportable;

    /**
     * {@inheritDoc}
     */
    public function create(string $orderId, array $params)
    {
        $payload = Payload::post("payments/orders/{$orderId}/fulfillments", $params);

        return $this->transporter->requestObject($payload)->data();
    }

    /**
     * {@inheritDoc}
     */
    public function list(string $orderId, array $params)
    {
        $payload = Payload::get("payments/orders/{$orderId}/fulfillments", $params);

        return $this->transporter->requestObject($payload)->data();
    }
}
