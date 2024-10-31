<?php

declare(strict_types=1);

namespace MusheAbdulHakim\GoHighLevel\Resources\Calendars;

use MusheAbdulHakim\GoHighLevel\Contracts\Resources\Calendars\GroupContract;
use MusheAbdulHakim\GoHighLevel\Resources\Concerns\Transportable;
use MusheAbdulHakim\GoHighLevel\ValueObjects\Transporter\Payload;

final class Group implements GroupContract
{
    use Transportable;

    public function get(string $locationId)
    {
        $payload = Payload::get('calendars/groups', [
            'locationId' => $locationId,
        ]);

        return $this->transporter->requestObject($payload)->get('groups');
    }

    public function create(array $params)
    {
        $payload = Payload::create('calendars/groups', $params);

        return $this->transporter->requestObject($payload)->get('group');
    }

    public function validate(string $locationId, string $slug, bool $available)
    {
        $params['locationId'] = $locationId;
        $params['slug'] = $slug;
        $params['available'] = $available;
        $payload = Payload::put('calendars/groups/validate-slug', $params);

        return $this->transporter->requestObject($payload)->data();
    }

    public function delete(string $groupId)
    {
        $payload = Payload::delete('calendars/groups', $groupId);

        return $this->transporter->requestObject($payload)->data();
    }

    public function update(string $groupId, array $params = [])
    {
        $payload = Payload::put("calendars/groups/{$groupId}", $params);

        return $this->transporter->requestObject($payload)->get('group');
    }

    public function disable(string $groupId, bool $isActive)
    {
        $params['isActive'] = $isActive;
        $payload = Payload::put("calendars/groups/{$groupId}/status", $params);

        return $this->transporter->requestObject($payload)->get('group');
    }
}
