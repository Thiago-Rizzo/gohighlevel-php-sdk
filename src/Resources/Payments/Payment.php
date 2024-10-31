<?php

namespace GoHighLevelSDK\Resources\Payments;

use GoHighLevelSDK\Contracts\Resources\Payments\CustomProviderContract;
use GoHighLevelSDK\Contracts\Resources\Payments\IntegrationContract;
use GoHighLevelSDK\Contracts\Resources\Payments\OrderContract;
use GoHighLevelSDK\Contracts\Resources\Payments\OrderFulfillmentContract;
use GoHighLevelSDK\Contracts\Resources\Payments\PaymentContract;
use GoHighLevelSDK\Contracts\Resources\Payments\SubscriptionContract;
use GoHighLevelSDK\Contracts\Resources\Payments\TransactionContract;
use GoHighLevelSDK\Resources\Concerns\Transportable;

class Payment implements PaymentContract
{
    use Transportable;

    public function integration(): IntegrationContract
    {
        return new Integration($this->transporter);
    }

    public function order(): OrderContract
    {
        return new Order($this->transporter);
    }

    public function orderFulfillment(): OrderFulfillmentContract
    {
        return new OrderFulfillment($this->transporter);
    }

    public function transaction(): TransactionContract
    {
        return new Transaction($this->transporter);
    }

    public function subscription(): SubscriptionContract
    {
        return new Subscription($this->transporter);
    }

    public function customProvider(): CustomProviderContract
    {
        return new CustomProvider($this->transporter);
    }
}
