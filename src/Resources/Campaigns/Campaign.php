<?php

declare(strict_types=1);

namespace MusheAbdulHakim\GoHighLevel\Resources\Campaigns;

use MusheAbdulHakim\GoHighLevel\Contracts\Resources\Campaigns\CampaignContract;
use MusheAbdulHakim\GoHighLevel\Resources\Concerns\Transportable;
use MusheAbdulHakim\GoHighLevel\ValueObjects\Transporter\Payload;

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
