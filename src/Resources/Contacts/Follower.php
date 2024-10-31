<?php

declare(strict_types=1);

namespace GoHighLevelSDK\Resources\Contacts;

use GoHighLevelSDK\Contracts\Resources\Contacts\FollowerContract;
use GoHighLevelSDK\Resources\Concerns\Transportable;
use GoHighLevelSDK\ValueObjects\Transporter\Payload;

final class Follower implements FollowerContract
{
    use Transportable;

    /**
     * {@inheritDoc}
     */
    public function add(string $contactId, array $followers)
    {
        $payload = Payload::create("contacts/$contactId/followers", [
            'followers' => $followers,
        ]);

        return $this->transporter->requestObject($payload)->data();
    }

    /**
     * {@inheritDoc}
     */
    public function create(string $contactId, array $followers)
    {
        $payload = Payload::create("contacts/{$contactId}/followers", [
            'followers' => $followers,
        ]);

        return $this->transporter->requestObject($payload)->data();
    }

    /**
     * {@inheritDoc}
     */
    public function delete(string $contactId)
    {
        $payload = Payload::deleteFromUri("contacts/{$contactId}/followers");

        return $this->transporter->requestObject($payload)->data();
    }
}
