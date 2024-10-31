<?php

namespace GoHighLevelSDK\Resources\Products;

use GoHighLevelSDK\Contracts\Resources\Products\PriceContract;
use GoHighLevelSDK\Contracts\Resources\Products\ProductContract;
use GoHighLevelSDK\Resources\Concerns\Transportable;
use GoHighLevelSDK\ValueObjects\Transporter\Payload;

class Product implements ProductContract
{
    use Transportable;

    /**
     * {@inheritDoc}
     */
    public function get(string $productId, array $params = [])
    {
        $payload = Payload::get("products/{$productId}", $params);

        return $this->transporter->requestObject($payload)->data();
    }

    /**
     * {@inheritDoc}
     */
    public function delete(string $productId, array $params = [])
    {
        $payload = Payload::deleteFromUri("products/{$productId}");

        return $this->transporter->requestObject($payload)->data();
    }

    /**
     * {@inheritDoc}
     */
    public function update(string $productId, array $params = [])
    {
        $payload = Payload::put("products/{$productId}", $params);

        return $this->transporter->requestObject($payload)->data();
    }

    /**
     * {@inheritDoc}
     */
    public function create(array $params = [])
    {
        $payload = Payload::create('products/', $params);

        return $this->transporter->requestObject($payload)->data();
    }

    /**
     * {@inheritDoc}
     */
    public function list(string $locationId, array $params = [])
    {
        $params['locationId'] = $locationId;
        $payload = Payload::get('products/', $params);

        return $this->transporter->requestObject($payload)->data();
    }

    public function price(): PriceContract
    {
        return new Price($this->transporter);
    }
}
