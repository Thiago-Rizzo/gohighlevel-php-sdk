<?php

declare(strict_types=1);

namespace GoHighLevelSDK\Resources\Campaigns;

use GoHighLevelSDK\Contracts\Resources\Campaigns\CampaignContract;
use GoHighLevelSDK\Resources\Concerns\Transportable;
use GoHighLevelSDK\ValueObjects\Transporter\Payload;

final class Campaign implements CampaignContract
{
    use Transportable;

    public function get(string $locationId, array $params = [])
    {
        $params['locationId'] = $locationId;
        $payload = Payload::get('campaigns/', $params);

        return $this->transporter->requestObject($payload)->get('campaigns');
    }
}
