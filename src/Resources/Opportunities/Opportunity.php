<?php

namespace MusheAbdulHakim\GoHighLevel\Resources\Opportunities;

use MusheAbdulHakim\GoHighLevel\Contracts\Resources\Opportunities\FollowerContract;
use MusheAbdulHakim\GoHighLevel\Contracts\Resources\Opportunities\OpportunityContract;
use MusheAbdulHakim\GoHighLevel\Resources\Concerns\Transportable;
use MusheAbdulHakim\GoHighLevel\ValueObjects\Transporter\Payload;

class Opportunity implements OpportunityContract
{
    use Transportable;

    /**
     * {@inheritDoc}
     */
    public function get(string $id)
    {
        $payload = Payload::get("opportunities/{$id}");

        return $this->transporter->requestObject($payload)->get('opportunity');
    }

    /**
     * {@inheritDoc}
     */
    public function delete(string $id)
    {
        $payload = Payload::delete('opportunities/', $id);

        return $this->transporter->requestObject($payload)->data();
    }

    /**
     * {@inheritDoc}
     */
    public function update(string $id, array $params = [])
    {
        $payload = Payload::put("opportunities/{$id}", $params);

        return $this->transporter->requestObject($payload)->get('opportunity');
    }

    /**
     * {@inheritDoc}
     */
    public function updateStatus(string $id, string $status)
    {
        $params['status'] = $status;
        $payload = Payload::put("opportunities/{$id}/status", $params);

        return $this->transporter->requestObject($payload)->data();
    }

    /**
     * {@inheritDoc}
     */
    public function upsert(string $pipelineId, string $locationId, string $contactId, array $params = [])
    {
        $payload = Payload::put('opportunities/upsert', $params);

        return $this->transporter->requestObject($payload)->data();
    }

    /**
     * {@inheritDoc}
     */
    public function create(array $params = [])
    {
        $payload = Payload::create('opportunities', $params);

        return $this->transporter->requestObject($payload)->get('opportunity');
    }

    /**
     * {@inheritDoc}
     */
    public function search(string $locationId, array $params = [])
    {
        $params['location_id'] = $locationId;
        $payload = Payload::get('opportunities/search', $params);

        return $this->transporter->requestObject($payload)->data();
    }

    /**
     * {@inheritDoc}
     */
    public function pipelines(string $locationId)
    {
        $params['locationId'] = $locationId;
        $payload = Payload::get('opportunities/pipelines', $params);

        return $this->transporter->requestObject($payload)->data();
    }

    public function follower(): FollowerContract
    {
        return new Follower($this->transporter);
    }
}
