<?php

declare(strict_types=1);

namespace GoHighLevelSDK\Resources\Calendars;

use GoHighLevelSDK\Contracts\Resources\Calendars\EventContract;
use GoHighLevelSDK\Resources\Concerns\Transportable;
use GoHighLevelSDK\ValueObjects\Transporter\Payload;

final class Event implements EventContract
{
    use Transportable;

    public function list(string $locationId, array $params = [])
    {
        $params['locationId'] = $locationId;
        $payload = Payload::get('calendars/events/', $params);

        return $this->transporter->requestObject($payload)->data();
    }

    /**
     * {@inheritDoc}
     */
    public function get(string $locationId, string $startTime, string $endTime, array $params = [])
    {
        $params['locationId'] = $locationId;
        $params['startTime'] = $startTime;
        $params['endTime'] = $endTime;
        $payload = Payload::get('calendars/events/', $params);

        return $this->transporter->requestObject($payload)->data();
    }

    /**
     * {@inheritDoc}
     */
    public function slots(string $locationId, string $endTime, string $startTime, array $params = [])
    {
        $params['endtime'] = $endTime;
        $params['startTime'] = $startTime;
        $params['locationId'] = $locationId;
        $payload = Payload::get('calendars/blocked-slots/', $params);

        return $this->transporter->requestObject($payload)->get('events');
    }

    /**
     * {@inheritDoc}
     */
    public function getAppointment(string $eventId)
    {
        $payload = Payload::get("calendars/events/appointments/{$eventId}");

        return $this->transporter->requestObject($payload)->get('event');
    }

    /**
     * {@inheritDoc}
     */
    public function editAppointment(string $eventId, array $params = [])
    {
        $payload = Payload::put("calendars/events/appointments/{$eventId}", $params);

        return $this->transporter->requestObject($payload)->data();
    }

    /**
     * {@inheritDoc}
     */
    public function createAppointment(string $calendarId, string $locationId, string $contactId, string $startTime, array $params)
    {
        $params['calendarId'] = $calendarId;
        $params['locationId'] = $locationId;
        $params['contactId'] = $contactId;
        $params['startTime'] = $startTime;
        $payload = Payload::create('calendars/events/appointments/', $params);

        return $this->transporter->requestObject($payload)->data();
    }

    /**
     * {@inheritDoc}
     */
    public function createSlot(string $locationId, string $startTime, string $endTime, array $params = [])
    {
        $params['locationId'] = $locationId;
        $params['startTime'] = $startTime;
        $params['endTime'] = $endTime;
        $payload = Payload::create('calendars/events/block-slots', $params);

        return $this->transporter->requestObject($payload)->data();
    }

    /**
     * {@inheritDoc}
     */
    public function editSlot(string $eventId, array $params = [])
    {
        $payload = Payload::put("calendars/events/block-slots/{$eventId}", $params);

        return $this->transporter->requestObject($payload)->data();
    }

    /**
     * {@inheritDoc}
     */
    public function delete(string $eventId)
    {
        $payload = Payload::delete('calendars/events', $eventId);

        return $this->transporter->requestObject($payload)->data();
    }
}
