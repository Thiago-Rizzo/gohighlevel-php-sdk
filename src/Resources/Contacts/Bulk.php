<?php

declare(strict_types=1);

namespace GoHighLevelSDK\Resources\Contacts;

use GoHighLevelSDK\Contracts\Resources\Contacts\BulkContract;
use GoHighLevelSDK\Resources\Concerns\Transportable;
use GoHighLevelSDK\ValueObjects\Transporter\Payload;

final class Bulk implements BulkContract
{
    use Transportable;

    /**
     * {@inheritDoc}
     */
    public function addOrRemove(string $locationId, array $ids, string $businessId): array
    {
        $payload = Payload::create('contacts/bulk/business', [
            'locationId' => $locationId,
            'ids' => $ids,
            'businessId' => $businessId,
        ]);

        return $this->transporter->requestObject($payload)->data();
    }
}
