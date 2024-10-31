<?php

declare(strict_types=1);

namespace GoHighLevelSDK\Contracts\Resources\Payments;

interface PaymentContract
{
    public function integration(): IntegrationContract;

    public function order(): OrderContract;

    public function orderFulfillment(): OrderFulfillmentContract;

    public function transaction(): TransactionContract;

    public function subscription(): SubscriptionContract;

    public function customProvider(): CustomProviderContract;
}
