<?php

declare(strict_types=1);

namespace GoHighLevelSDK\Resources\Calendars;

use GoHighLevelSDK\Contracts\Resources\Calendars\CalendarContract;
use GoHighLevelSDK\Contracts\Resources\Calendars\CalendarResourceContract;
use GoHighLevelSDK\Contracts\Resources\Calendars\EventContract;
use GoHighLevelSDK\Contracts\Resources\Calendars\GroupContract;
use GoHighLevelSDK\Resources\Concerns\Transportable;
use GoHighLevelSDK\ValueObjects\Transporter\Payload;

final class Calendar implements CalendarContract
{
    use Transportable;

    /**
     * {@inheritDoc}
     */
    public function slots(string $calendarId, string $startDate, string $endDate)
    {
        $params['startDate'] = $startDate;
        $params['endDate'] = $endDate;
        $payload = Payload::get("calendars/{$calendarId}/free-slots", $params);

        return $this->transporter->requestObject($payload)->data();
    }

    /**
     * {@inheritDoc}
     */
    public function update(string $calendarId, array $params = [])
    {
        $payload = Payload::put("calendars/{$calendarId}", $params);

        return $this->transporter->requestObject($payload)->get('calendar');
    }

    /**
     * {@inheritDoc}
     */
    public function get(string $calendarId)
    {
        $payload = Payload::get("calendars/{$calendarId}");

        return $this->transporter->requestObject($payload)->get('calendar');
    }

    /**
     * {@inheritDoc}
     */
    public function delete(string $calendarId)
    {
        $payload = Payload::deleteFromUri("calendars/{$calendarId}");

        return $this->transporter->requestObject($payload)->data();
    }

    /**
     * {@inheritDoc}
     */
    public function list(string $locationId, array $params = [])
    {
        $params['locationId'] = $locationId;
        $payload = Payload::get('calendars/', $params);

        return $this->transporter->requestObject($payload)->get('calendars');
    }

    /**
     * {@inheritDoc}
     */
    public function create(string $locationId, string $name, array $params = [])
    {
        $params['locationId'] = $locationId;
        $params['name'] = $name;
        $payload = Payload::create('calendars/', $params);

        return $this->transporter->requestObject($payload)->get('calendar');
    }

    /**
     * {@inheritDoc}
     */
    public function groups(): GroupContract
    {
        return new Group($this->transporter);
    }

    /**
     * {@inheritDoc}
     */
    public function events(): EventContract
    {
        return new Event($this->transporter);
    }

    /**
     * {@inheritDoc}
     */
    public function resources(): CalendarResourceContract
    {
        return new CalendarResource($this->transporter);
    }
}
