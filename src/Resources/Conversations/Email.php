<?php

declare(strict_types=1);

namespace GoHighLevelSDK\Resources\Conversations;

use GoHighLevelSDK\Contracts\Resources\Conversations\EmailContract;
use GoHighLevelSDK\Resources\Concerns\Transportable;
use GoHighLevelSDK\ValueObjects\Transporter\Payload;

final class Email implements EmailContract
{
    use Transportable;

    /**
     * {@inheritDoc}
     */
    public function get(string $id)
    {
        $payload = Payload::get("conversations/messages/email/{$id}");

        return $this->transporter->requestObject($payload)->data();
    }

    public function cancelSchedule(string $emailMessageId)
    {
        $payload = Payload::deleteFromUri("conversations/messages/email/{$emailMessageId}/schedule");

        return $this->transporter->requestObject($payload)->data();
    }
}
