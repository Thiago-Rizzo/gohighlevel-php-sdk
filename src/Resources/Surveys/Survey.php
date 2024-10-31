<?php

declare(strict_types=1);

namespace GoHighLevelSDK\Resources\Surveys;

use GoHighLevelSDK\Contracts\Resources\Surveys\SurveysContract;
use GoHighLevelSDK\Resources\Concerns\Transportable;
use GoHighLevelSDK\ValueObjects\Transporter\Payload;

class Survey implements SurveysContract
{
    use Transportable;

    /**
     * {@inheritDoc}
     */
    public function submissions(string $locationId, array $params = [])
    {
        $params['locationId'] = $locationId;
        $payload = Payload::get('surveys/submissions', $params);

        return $this->transporter->requestObject($payload)->data();
    }

    /**
     * {@inheritDoc}
     */
    public function list(string $locationId, array $params = [])
    {
        $params['locationId'] = $locationId;
        $payload = Payload::get('surveys/', $params);

        return $this->transporter->requestObject($payload)->data();
    }
}
