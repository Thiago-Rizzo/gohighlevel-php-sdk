<?php

declare(strict_types=1);

namespace GoHighLevelSDK\Resources\Users;

use GoHighLevelSDK\Contracts\Resources\Users\UsersContract;
use GoHighLevelSDK\Resources\Concerns\Transportable;
use GoHighLevelSDK\ValueObjects\Transporter\Payload;

class User implements UsersContract
{
    use Transportable;

    /**
     * {@inheritDoc}
     */
    public function get(string $userId)
    {
        $payload = Payload::get("users/$userId");

        return $this->transporter->requestObject($payload)->data();
    }

    /**
     * {@inheritDoc}
     */
    public function update(string $userId, array $params = [])
    {
        $payload = Payload::put("users/$userId", $params);

        return $this->transporter->requestObject($payload)->data();
    }

    /**
     * {@inheritDoc}
     */
    public function delete(string $userId)
    {
        $payload = Payload::delete('users', $userId);

        return $this->transporter->requestObject($payload)->data();
    }

    /**
     * {@inheritDoc}
     */
    public function byLocation(string $locationId)
    {
        $params['locationId'] = $locationId;
        $payload = Payload::get('users/', $params);

        return $this->transporter->requestObject($payload)->data();
    }

    /**
     * {@inheritDoc}
     */
    public function create(string $companyId, array $params)
    {
        $params['companyId'] = $companyId;
        $payload = Payload::post('users/', $params);

        return $this->transporter->requestObject($payload)->data();
    }

    /**
     * {@inheritDoc}
     */
    public function search(string $companyId, array $params = [])
    {
        $params['companyId'] = $companyId;
        $payload = Payload::get('users/search', $params);

        return $this->transporter->requestObject($payload)->data();
    }
}
