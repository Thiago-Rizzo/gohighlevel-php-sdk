<?php

namespace GoHighLevelSDK\Resources\Products;

use GoHighLevelSDK\Contracts\Resources\Products\PriceContract;
use GoHighLevelSDK\Resources\Concerns\Transportable;
use GoHighLevelSDK\ValueObjects\Transporter\Payload;

class Price implements PriceContract
{
    use Transportable;

    /**
     * {@inheritDoc}
     */
    public function create(string $productId, array $params = [])
    {
        $payload = Payload::create("products/{$productId}/price", $params);

        return $this->transporter->requestObject($payload)->data();
    }

    /**
     * {@inheritDoc}
     */
    public function list(string $productId, string $locationId, array $params = [])
    {
        $payload = Payload::get("products/{$productId}/price", $params);

        return $this->transporter->requestObject($payload)->data();
    }

    /**
     * {@inheritDoc}
     */
    public function get(string $productId, string $priceId, array $params = [])
    {
        $payload = Payload::get("products/{$productId}/price/{$priceId}", $params);

        return $this->transporter->requestObject($payload)->data();
    }

    /**
     * {@inheritDoc}
     */
    public function update(string $productId, string $priceId, array $params = [])
    {
        $payload = Payload::put("products/{$productId}/price/{$priceId}", $params);

        return $this->transporter->requestObject($payload)->data();
    }

    /**
     * {@inheritDoc}
     */
    public function delete(string $productId, string $priceId, array $params = [])
    {
        $payload = Payload::deleteFromUri("products/{$productId}/price/{$priceId}");

        return $this->transporter->requestObject($payload)->data();
    }
}
