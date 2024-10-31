<?php

declare(strict_types=1);

namespace GoHighLevelSDK\Resources\Locations;

use GoHighLevelSDK\Contracts\Resources\Locations\CustomFieldContract;
use GoHighLevelSDK\Contracts\Resources\Locations\CustomValueContract;
use GoHighLevelSDK\Contracts\Resources\Locations\LocationContract;
use GoHighLevelSDK\Contracts\Resources\Locations\SearchContract;
use GoHighLevelSDK\Contracts\Resources\Locations\TagContract;
use GoHighLevelSDK\Contracts\Resources\Locations\TemplateContract;
use GoHighLevelSDK\Contracts\Resources\Locations\TimezoneContract;
use GoHighLevelSDK\Resources\Concerns\Transportable;
use GoHighLevelSDK\ValueObjects\Transporter\Payload;

class Location implements LocationContract
{
    use Transportable;

    /**
     * {@inheritDoc}
     */
    public function create(array $params)
    {
        $payload = Payload::create('locations/', $params);

        return $this->transporter->requestObject($payload)->data();
    }

    /**
     * {@inheritDoc}
     */
    public function get(string $locationId)
    {
        $payload = Payload::get("locations/{$locationId}");

        return $this->transporter->requestObject($payload)->data();
    }

    /**
     * {@inheritDoc}
     */
    public function update(string $locationId, array $params = [])
    {
        $payload = Payload::put("locations/{$locationId}", $params);

        return $this->transporter->requestObject($payload)->data();
    }

    /**
     * {@inheritDoc}
     */
    public function delete(string $locationId, array $params = [])
    {
        $payload = Payload::delete('locations', $locationId);

        return $this->transporter->requestObject($payload)->data();
    }

    public function tag(): TagContract
    {
        return new Tag($this->transporter);
    }

    public function customField(): CustomFieldContract
    {
        return new CustomField($this->transporter);
    }

    public function customValue(): CustomValueContract
    {
        return new CustomValue($this->transporter);
    }

    public function template(): TemplateContract
    {
        return new Template($this->transporter);
    }

    public function search(): SearchContract
    {
        return new Search($this->transporter);
    }

    public function timezone(): TimezoneContract
    {
        return new Timezone($this->transporter);
    }
}
