<?php

declare(strict_types=1);

namespace MusheAbdulHakim\GoHighLevel\Resources\Conversations;

use MusheAbdulHakim\GoHighLevel\Contracts\Resources\Conversations\MessageContract;
use MusheAbdulHakim\GoHighLevel\Resources\Concerns\Transportable;
use MusheAbdulHakim\GoHighLevel\ValueObjects\Transporter\Payload;

final class Message implements MessageContract
{
    use Transportable;

    /**
     * {@inheritDoc}
     */
    public function get(string $id)
    {
        $payload = Payload::get("conversations/messages/{$id}");

        return $this->transporter->requestObject($payload)->data();
    }

    /**
     * {@inheritDoc}
     */
    public function byConversation(string $conversationId, $queryParams = [])
    {
        $payload = Payload::get("conversations/{$conversationId}/messages", $queryParams);

        return $this->transporter->requestObject($payload)->data();
    }

    /**
     * {@inheritDoc}
     */
    public function send(string $type, string $contactId, $params = [])
    {
        $params['type'] = $type;
        $params['contactId'] = $contactId;
        $payload = Payload::create('conversations/messages', $params);

        return $this->transporter->requestObject($payload)->data();
    }

    /**
     * {@inheritDoc}
     */
    public function inbound(string $type, string $conversationId, string $conversationProviderId, array $params = [])
    {
        $params['type'] = $type;
        $params['conversationId'] = $conversationId;
        $params['conversationProviderId'] = $conversationProviderId;
        $payload = Payload::create('conversations/messages/inbound', $params);

        return $this->transporter->requestObject($payload)->data();
    }

    /**
     * {@inheritDoc}
     */
    public function outbound(string $type, string $conversationId, string $conversationProviderId, array $params = [])
    {
        $params['type'] = $type;
        $params['conversationId'] = $conversationId;
        $params['conversationProviderId'] = $conversationProviderId;
        $payload = Payload::create('conversations/messages/inbound', $params);

        return $this->transporter->requestObject($payload)->data();
    }

    /**
     * {@inheritDoc}
     */
    public function cancel(string $messageId)
    {
        $payload = Payload::deleteFromUri("conversations/messages/{$messageId}/schedule");

        return $this->transporter->requestObject($payload)->data();
    }

    /**
     * {@inheritDoc}
     */
    public function upload(string $conversationId, string $locationId, array $attachmentUrls)
    {
        $params = [
            'multipart' => [
                [
                    'name' => 'conversationId',
                    'contents' => $conversationId,
                ],
            ],
            'locationId' => $locationId,
            'attachmentUrls' => $attachmentUrls,
        ];
        $payload = Payload::upload('conversations/messages/upload', $params);

        return $this->transporter->requestObject($payload)->data();
    }

    /**
     * {@inheritDoc}
     */
    public function updateStatus(string $messageId, $params = [])
    {
        $payload = Payload::put("conversations/messages/{$messageId}/status");

        return $this->transporter->requestObject($payload)->data();
    }

    /**
     * {@inheritDoc}
     */
    public function getRecording(string $locationId, string $messageId)
    {
        $payload = Payload::get("conversations/messages/{$messageId}/locations/{$locationId}/recording");

        return $this->transporter->requestObject($payload)->data();
    }

    /**
     * {@inheritDoc}
     */
    public function getTranscript(string $locationId, string $messageId)
    {
        $payload = Payload::get("conversations/locations/{$locationId}/messages/{$messageId}/transcription");

        return $this->transporter->requestObject($payload)->data();
    }

    /**
     * {@inheritDoc}
     */
    public function downloadTranscript(string $locationId, string $messageId)
    {
        $payload = Payload::get("conversations/locations/{$locationId}/messages/{$messageId}/transcription/download");

        return $this->transporter->requestObject($payload)->data();
    }
}
