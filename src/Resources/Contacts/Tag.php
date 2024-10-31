<?php

declare(strict_types=1);

namespace GoHighLevelSDK\Resources\Contacts;

use GoHighLevelSDK\Contracts\Resources\Contacts\TagContract;
use GoHighLevelSDK\Resources\Concerns\Transportable;
use GoHighLevelSDK\ValueObjects\Transporter\Payload;
use GoHighLevelSDK\ValueObjects\Transporter\Response;

final class Tag implements TagContract
{
    use Transportable;

    /*
    *@inheritDoc
    */
    public function create(string $contactId, $tags)
    {
        $payload = Payload::create("contacts/{$contactId}/tags", [
            'tags' => $tags,
        ]);

        return $this->transporter->requestObject($payload)->get('tags');
    }

    /**
     * {@inheritDoc}
     */
    public function remove(string $contactId): Response
    {
        $payload = Payload::deleteFromUri("contacts/{$contactId}/tags");

        return $this->transporter->requestObject($payload);
    }
}
