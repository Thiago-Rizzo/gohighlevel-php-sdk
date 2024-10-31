<?php

declare(strict_types=1);

namespace GoHighLevelSDK\Resources\Conversations;

use GoHighLevelSDK\Contracts\Resources\Conversations\SearchContract;
use GoHighLevelSDK\Resources\Concerns\Transportable;
use GoHighLevelSDK\ValueObjects\Transporter\Payload;

final class Search implements SearchContract
{
    use Transportable;

    public function make(string $locationId, $parameters = [])
    {
        $parameters['locationId'] = $locationId;
        $payload = Payload::get('conversations/search', $parameters);

        return $this->transporter->requestObject($payload)->data();
    }
}
