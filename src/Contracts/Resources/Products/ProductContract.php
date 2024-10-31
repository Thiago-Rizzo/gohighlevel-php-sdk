<?php

declare(strict_types=1);

namespace GoHighLevelSDK\Contracts\Resources\Products;

/**
 * @see https://highlevel.stoplight.io/docs/integrations/486b7c90818f4-products-api
 */
interface ProductContract
{
    /**
     * Get Product by ID
     *
     * @see https://highlevel.stoplight.io/docs/integrations/272e8f008adb0-get-product-by-id
     */
    public function get(string $productId, array $params = []);

    /**
     * Delete Product by ID
     *
     * @see https://highlevel.stoplight.io/docs/integrations/285e8c049b2e1-delete-product-by-id
     */
    public function delete(string $productId, array $params = []);

    /**
     * Update Product by ID
     *
     * @see https://highlevel.stoplight.io/docs/integrations/469d7a90e0d15-update-product-by-id
     */
    public function update(string $productId, array $params = []);

    /**
     * Create Product
     *
     * @see https://highlevel.stoplight.io/docs/integrations/9eda2dc176c9c-create-product
     */
    public function create(array $params = []);

    /**
     * List Products
     *
     * @param  array  $params  = []
     *
     * @see https://highlevel.stoplight.io/docs/integrations/7f6ce42d09400-list-products
     */
    public function list(string $locationId, array $params = []);

    public function price(): PriceContract;
}
