<?php

declare(strict_types=1);

namespace GoHighLevelSDK\Contracts\Resources\Payments;

interface OrderFulfillmentContract
{
    /**
     *Create order fulfillment
     *
     * @see https://highlevel.stoplight.io/docs/integrations/1e091099a92c6-create-order-fulfillment
     */
    public function create(string $orderId, array $params);

    /**
     * List fulfillment
     *
     * @see https://highlevel.stoplight.io/docs/integrations/670fe5beec7de-list-fulfillment
     */
    public function list(string $orderId, array $params);
}
