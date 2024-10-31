<?php

declare(strict_types=1);

namespace GoHighLevelSDK\Resources\SaaS;

use GoHighLevelSDK\Contracts\Resources\SaaS\SaasContract;
use GoHighLevelSDK\Resources\Concerns\Transportable;
use GoHighLevelSDK\ValueObjects\Transporter\Payload;
use GoHighLevelSDK\ValueObjects\Transporter\Response;

class Saas implements SaasContract
{
    use Transportable;

    /**
     * {@inheritDoc}
     */
    public function get(array $params = []): Response
    {
        $payload = Payload::get('saas-api/public-api/locations', $params);

        return $this->transporter->requestObject($payload);
    }

    /**
     * {@inheritDoc}
     */
    public function update(string $locationId, array $params = []): Response
    {
        $payload = Payload::put("saas-api/public-api/update-saas-subscription/{$locationId}", $params);

        return $this->transporter->requestObject($payload);
    }

    /**
     * {@inheritDoc}
     */
    public function disable(string $companyId, array $params = []): Response
    {
        $payload = Payload::post("saas-api/public-api/bulk-disable-saas/{$companyId}", $params);

        return $this->transporter->requestObject($payload);
    }

    /**
     * {@inheritDoc}
     */
    public function enable(string $locationId, array $params = []): Response
    {
        $payload = Payload::post("saas-api/public-api/enable-saas/{$locationId}", $params);

        return $this->transporter->requestObject($payload);
    }

    /**
     * {@inheritDoc}
     */
    public function pause(string $locationId, array $params = []): Response
    {
        $payload = Payload::post("saas-api/public-api/pause/{$locationId}", $params);

        return $this->transporter->requestObject($payload);
    }

    /**
     * {@inheritDoc}
     */
    public function updateRebilling(string $companyId, array $params = []): Response
    {
        $payload = Payload::post("saas-api/public-api/update-rebilling/{$companyId}", $params);

        return $this->transporter->requestObject($payload);
    }
}
