<?php

declare(strict_types=1);

namespace GoHighLevelSDK\Resources\SocialPlanner;

use GoHighLevelSDK\Contracts\Resources\SocialPlanner\Google as GoogleSocialPlanner;
use GoHighLevelSDK\Resources\Concerns\Transportable;
use GoHighLevelSDK\ValueObjects\Transporter\Payload;

class Google implements GoogleSocialPlanner
{
    use Transportable;

    public function oAuth(string $locationId, string $userId, array $params = [])
    {
        $params['locationId'] = $locationId;
        $params['userId'] = $userId;
        $payload = Payload::get('social-media-posting/oauth/google/start', $params);

        return $this->transporter->requestObject($payload)->data();

    }

    public function businessLocations(string $accountId, string $locationId)
    {
        $payload = Payload::get("social-media-posting/oauth/$locationId/google/locations/$accountId");

        return $this->transporter->requestObject($payload)->data();
    }

    public function setBusinessLocation(string $accountId, string $locationId, array $params = [])
    {
        $payload = Payload::post("social-media-posting/oauth/$locationId/google/locations/$accountId", $params);

        return $this->transporter->requestObject($payload)->data();
    }
}
