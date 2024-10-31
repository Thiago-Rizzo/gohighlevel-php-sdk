<?php

declare(strict_types=1);

namespace GoHighLevelSDK\Resources\Workflows;

use GoHighLevelSDK\Contracts\Resources\Workflows\WorkflowsContract;
use GoHighLevelSDK\Resources\Concerns\Transportable;
use GoHighLevelSDK\ValueObjects\Transporter\Payload;

class Workflow implements WorkflowsContract
{
    use Transportable;

    /**
     * {@inheritDoc}
     */
    public function get(string $locationId)
    {
        $params['locationId'] = $locationId;
        $payload = Payload::get('workflows/', $params);

        return $this->transporter->requestObject($payload)->data();
    }
}
