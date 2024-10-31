<?php

declare(strict_types=1);

namespace GoHighLevelSDK\Resources\Funnels;

use GoHighLevelSDK\Contracts\Resources\Funnels\FunnelContract;
use GoHighLevelSDK\Contracts\Resources\Funnels\RedirectContract;
use GoHighLevelSDK\Resources\Concerns\Transportable;
use GoHighLevelSDK\ValueObjects\Transporter\Payload;

final class Funnel implements FunnelContract
{
    use Transportable;

    public function list(string $locationId, array $params = [])
    {
        $params['locationId'] = $locationId;
        $payload = Payload::get('funnels/funnel/list/', $params);

        return $this->transporter->requestObject($payload)->get('funnels');
    }

    public function pages(string $funnelId, string $locationId, int $limit, int $offset, array $params = [])
    {
        $params['funnelId'] = $funnelId;
        $params['locationId'] = $locationId;
        $params['limit'] = $limit;
        $params['offset'] = $offset;
        $payload = Payload::get('funnels/page', $params);

        return $this->transporter->requestObject($payload)->data();
    }

    public function redirect(): RedirectContract
    {
        return new Redirect($this->transporter);
    }
}
