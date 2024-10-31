<?php

declare(strict_types=1);

namespace MusheAbdulHakim\GoHighLevel\Resources\Locations;

use MusheAbdulHakim\GoHighLevel\Contracts\Resources\Locations\TagContract;
use MusheAbdulHakim\GoHighLevel\Resources\Concerns\Transportable;
use MusheAbdulHakim\GoHighLevel\ValueObjects\Transporter\Payload;

class Tag implements TagContract
{
    use Transportable;

    /**
     * {@inheritDoc}
     */
    public function lists(string $locationId)
    {
        $payload = Payload::get("locations/{$locationId}/tags");

        return $this->transporter->requestObject($payload)->get('tags');
    }

    /**
     * {@inheritDoc}
     */
    public function create(string $locationId, array $params)
    {
        $payload = Payload::create("locations/{$locationId}/tags", $params);

        return $this->transporter->requestObject($payload)->get('tag');
    }

    /**
     * {@inheritDoc}
     */
    public function get(string $locationId, string $tagId)
    {
        $payload = Payload::get("locations/{$locationId}/tags/{$tagId}");

        return $this->transporter->requestObject($payload)->get('tag');
    }

    /**
     * {@inheritDoc}
     */
    public function update(string $locationId, string $tagId, array $params)
    {
        $payload = Payload::put("locations/{$locationId}/tags/{$tagId}", $params);

        return $this->transporter->requestObject($payload)->get('tag');
    }

    /**
     * {@inheritDoc}
     */
    public function delete(string $locationId, string $tagId)
    {
        $payload = Payload::delete("locations/{$locationId}/tags", $tagId);

        return $this->transporter->requestObject($payload)->data();
    }
}
