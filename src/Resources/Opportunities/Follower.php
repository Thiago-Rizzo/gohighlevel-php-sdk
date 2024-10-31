<?php

declare(strict_types=1);

namespace GoHighLevelSDK\Resources\Opportunities;

use GoHighLevelSDK\Contracts\Resources\Opportunities\FollowerContract;
use GoHighLevelSDK\Resources\Concerns\Transportable;
use GoHighLevelSDK\ValueObjects\Transporter\Payload;

class Follower implements FollowerContract
{
    use Transportable;

    /**
     * {@inheritDoc}
     */
    public function add(string $id, array $followers)
    {
        $params['followers'] = $followers;
        $payload = Payload::post("opportunities/{$id}/followers", $params);

        return $this->transporter->requestObject($payload)->data();
    }

    /**
     * {@inheritDoc}
     */
    public function remove(string $id)
    {
        $payload = Payload::deleteFromUri("opportunities/{$id}/followers");

        return $this->transporter->requestObject($payload)->data();
    }

    /**
     * {@inheritDoc}
     */
    public function delete(string $id)
    {
        $payload = Payload::deleteFromUri("opportunities/{$id}/followers");

        return $this->transporter->requestObject($payload)->data();
    }
}
