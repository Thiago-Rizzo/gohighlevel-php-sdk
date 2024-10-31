<?php

declare(strict_types=1);

namespace GoHighLevelSDK\Resources\Calendars;

use GoHighLevelSDK\Contracts\Resources\Calendars\CalendarResourceContract;
use GoHighLevelSDK\Resources\Concerns\Transportable;
use GoHighLevelSDK\ValueObjects\Transporter\Payload;

final class CalendarResource implements CalendarResourceContract
{
    use Transportable;

    public function get(string $id, string $resourceType)
    {
        $payload = Payload::get("calendars/resources/{$resourceType}/{$id}");

        return $this->transporter->requestObject($payload)->data();
    }

    public function update(string $id, string $resourceType, array $params = [])
    {
        $payload = Payload::put("calendars/resources/{$resourceType}/{$id}", $params);

        return $this->transporter->requestObject($payload)->data();

    }

    public function delete(string $id, string $resourceType)
    {
        $payload = Payload::delete("calendars/resources/{$resourceType}/", $id);

        return $this->transporter->requestObject($payload)->data();

    }

    public function list(string $resourceType, $params = [])
    {
        $payload = Payload::get("calendars/resources/{$resourceType}", $params);

        return $this->transporter->requestObject($payload)->data();

    }

    public function create(string $resourceType, $params = [])
    {
        $payload = Payload::create("calendars/resources/{$resourceType}", $params);

        return $this->transporter->requestObject($payload)->data();

    }
}
