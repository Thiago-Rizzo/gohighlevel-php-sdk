<?php

declare(strict_types=1);

namespace MusheAbdulHakim\GoHighLevel\Contracts\Resources\Campaigns;

interface CampaignContract
{
    /**
     * Get Campaigns
     *
     * @see https://highlevel.stoplight.io/docs/integrations/6e067fcb430b7-get-campaigns
     */
    public function get(string $locationId, array $params = []);
}
