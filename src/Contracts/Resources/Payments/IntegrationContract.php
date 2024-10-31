<?php

declare(strict_types=1);

namespace GoHighLevelSDK\Contracts\Resources\Payments;

interface IntegrationContract
{
    /**
     * Create White-label Integration Provider
     *
     *
     * @see https://highlevel.stoplight.io/docs/integrations/38fc7b49d107d-create-white-label-integration-provider
     */
    public function create(array $params);

    /**
     * List White-label Integration Providers
     *
     * @see https://highlevel.stoplight.io/docs/integrations/cbdced5c59dfd-list-white-label-integration-providers
     */
    public function list(string $altId, string $altType, array $params = []);
}
