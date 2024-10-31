<?php

declare(strict_types=1);

namespace MusheAbdulHakim\GoHighLevel\Contracts\Resources\Locations;

interface TimezoneContract
{
    /**
     * Fetch Timezones
     *
     * @see https://highlevel.stoplight.io/docs/integrations/588e3c8407166-fetch-timezones
     */
    public function list(string $locationId);
}
