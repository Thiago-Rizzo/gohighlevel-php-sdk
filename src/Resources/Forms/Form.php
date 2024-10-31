<?php

declare(strict_types=1);

namespace MusheAbdulHakim\GoHighLevel\Resources\Forms;

use MusheAbdulHakim\GoHighLevel\Contracts\Resources\Forms\FormContract;
use MusheAbdulHakim\GoHighLevel\Resources\Concerns\Transportable;
use MusheAbdulHakim\GoHighLevel\ValueObjects\Transporter\Payload;

final class Form implements FormContract
{
    use Transportable;

    /**
     * {@inheritDoc}
     */
    public function submissions(string $locationId, array $params = [])
    {
        $params['locationId'] = $locationId;
        $payload = Payload::get('forms/submissions', $params);

        return $this->transporter->requestObject($payload)->data();
    }

    /**
     * {@inheritDoc}
     */
    public function uploadToCustomFields(string $locationId, string $contactId, array $params = [])
    {
        $params['locationId'] = $locationId;
        $params['contactId'] = $contactId;
        $payload = Payload::upload('forms/upload-custom-files/', $params);

        return $this->transporter->requestObject($payload)->data();
    }

    /**
     * {@inheritDoc}
     */
    public function list(string $locationId, array $params = [])
    {
        $params['locationId'] = $locationId;
        $payload = Payload::get('forms/', $params);

        return $this->transporter->requestObject($payload)->data();
    }
}
