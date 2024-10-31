<?php

namespace GoHighLevelSDK\Resources\Payments;

use GoHighLevelSDK\Contracts\Resources\Payments\SubscriptionContract;
use GoHighLevelSDK\Resources\Concerns\Transportable;
use GoHighLevelSDK\ValueObjects\Transporter\Payload;

class Subscription implements SubscriptionContract
{
    use Transportable;

    /**
     * {@inheritDoc}
     */
    public function list(string $altId, string $altType, array $params = [])
    {
        $params['altId'] = $altId;
        $params['altType'] = $altType;
        $payload = Payload::get('payments/subscriptions', $params);

        return $this->transporter->requestObject($payload)->data();
    }

    /**
     * {@inheritDoc}
     */
    public function get(string $subscriptionId, string $altId, string $altType, array $params = [])
    {
        $params['subscriptionId'] = $subscriptionId;
        $params['altId'] = $altId;
        $params['altType'] = $altType;
        $payload = Payload::get("payments/subscriptions/{$subscriptionId}", $params);

        return $this->transporter->requestObject($payload)->data();
    }
}
