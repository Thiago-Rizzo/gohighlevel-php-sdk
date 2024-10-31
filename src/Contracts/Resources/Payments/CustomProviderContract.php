<?php

declare(strict_types=1);

namespace GoHighLevelSDK\Contracts\Resources\Payments;

interface CustomProviderContract
{
    /**
     *Create new integration
     *
     * @param  array  $params
     * @return array|string
     *
     * @see https://highlevel.stoplight.io/docs/integrations/d3e2affc0897a-create-new-integration
     */
    public function create(string $locationId, array $params = []);

    /**
     *Deleting an existing integration
     *
     * @see https://highlevel.stoplight.io/docs/integrations/97fffb0398f3c-deleting-an-existing-integration
     */
    public function delete(string $locationId);

    /**
     * Fetch given provider config
     *
     * @see https://highlevel.stoplight.io/docs/integrations/dec209bac6191-fetch-given-provider-config
     */
    public function getConfig(string $locationId);

    /**
     * Create new provider config
     *
     * @see https://highlevel.stoplight.io/docs/integrations/377c9e577827b-create-new-provider-config
     */
    public function createConfig(string $locationId, array $params);

    /**
     * Delete existing provider config
     *
     * @see https://highlevel.stoplight.io/docs/integrations/d9151fabd2d1a-delete-existing-provider-config
     */
    public function deleteConfig(string $locationId, bool $liveMode);
}
