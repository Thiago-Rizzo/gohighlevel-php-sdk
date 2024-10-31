<?php

declare(strict_types=1);

namespace GoHighLevelSDK\Resources\Contacts;

use GoHighLevelSDK\Contracts\Resources\Contacts\AppointmentContract;
use GoHighLevelSDK\Resources\Concerns\Transportable;
use GoHighLevelSDK\ValueObjects\Transporter\Payload;

final class Appointment implements AppointmentContract
{
    use Transportable;

    /**
     * {@inheritDoc}
     */
    public function contacts(string $contactId)
    {
        $payload = Payload::get("contacts/{$contactId}/appointments");

        return $this->transporter->requestObject($payload)->get('events');

    }
}
