<?php

declare(strict_types=1);

namespace GoHighLevelSDK\Resources\Contacts;

use GoHighLevelSDK\Contracts\Resources\Contacts\WorkflowContract;
use GoHighLevelSDK\Resources\Concerns\Transportable;
use GoHighLevelSDK\ValueObjects\Transporter\Payload;

final class Workflow implements WorkflowContract
{
    use Transportable;

    /**
     * {@inheritDoc}
     */
    public function create(string $contactId, string $workflowId, string $eventStartTime)
    {
        $payload = Payload::create("contacts/{$contactId}/workflow/{$workflowId}", [
            'eventStartTime' => $eventStartTime,
        ]);

        return $this->transporter->requestObject($payload)->data();
    }

    /**
     * {@inheritDoc}
     */
    public function add(string $contactId, string $workflowId, string $eventStartTime)
    {
        $payload = Payload::create("contacts/{$contactId}/workflow/{$workflowId}", [
            'eventStartTime' => $eventStartTime,
        ]);

        return $this->transporter->requestObject($payload)->data();
    }

    /**
     * {@inheritDoc}
     */
    public function delete(string $contactId, string $workflowId)
    {
        $payload = Payload::deleteFromUri("contacts/{$contactId}/workflow/{$workflowId}");

        return $this->transporter->requestObject($payload)->data();

    }
}
