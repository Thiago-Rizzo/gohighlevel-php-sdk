<?php

declare(strict_types=1);

namespace GoHighLevelSDK\Resources\Contacts;

use GoHighLevelSDK\Contracts\Resources\Contacts\SearchContract;
use GoHighLevelSDK\Resources\Concerns\Transportable;
use GoHighLevelSDK\ValueObjects\Transporter\Payload;

final class Search implements SearchContract
{
    use Transportable;

    public function getDuplicate(string $locationId, $parameters = []): void
    {
        $parameters['locationId'] = $locationId;
        Payload::get('contacts/search/duplicate', $parameters);
    }
}
