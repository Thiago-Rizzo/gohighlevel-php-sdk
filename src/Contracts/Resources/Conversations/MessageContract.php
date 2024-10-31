<?php

declare(strict_types=1);

namespace GoHighLevelSDK\Contracts\Resources\Conversations;

interface MessageContract
{
    /**
     * Get message by message id
     *
     *@see https://highlevel.stoplight.io/docs/integrations/a503551cadede-get-message-by-message-id
     */
    public function get(string $id);

    /**
     * Get messages by conversation id
     *
     * @param  string  $conversationId  Conversation ID as string
     * @param  array  $queryParams
     *
     * @see https://highlevel.stoplight.io/docs/integrations/ab21134dad173-get-messages-by-conversation-id
     */
    public function byConversation(string $conversationId, $queryParams = []);

    /**
     * Post the necessary fields for the API to send a new message.
     *
     * @param  string  $type  Allowed values: SMS,Email,WhatsApp,GMB,IG,FB,Custom,Live_Chat
     * @param  array  $params
     *
     * @see https://highlevel.stoplight.io/docs/integrations/5853cb0a54971-send-a-new-message
     */
    public function send(string $type, string $contactId, $params = []);

    /**
     * Post the necessary fields for the API to add a new inbound message.
     *
     * @see https://highlevel.stoplight.io/docs/integrations/3c9036411fcc3-add-an-inbound-message
     */
    public function inbound(string $type, string $conversationId, string $conversationProviderId, array $params = []);

    /**
     * Add an external outbound call
     *
     * @param  array<mixed>  $params
     * @return array<mixed>|string
     *
     * @see https://highlevel.stoplight.io/docs/integrations/d032812b4e850-add-an-external-outbound-call
     */
    public function outbound(string $type, string $conversationId, string $conversationProviderId, array $params = []);

    /**
     * Post the messageId for the API to delete a scheduled message.
     *
     * @see https://highlevel.stoplight.io/docs/integrations/f7e0bc96bf0a4-cancel-a-scheduled-message
     */
    public function cancel(string $messageId);

    /**
     * Post the necessary fields for the API to upload files. The files need to be a buffer with the key "fileAttachment".
     *
     * @see https://highlevel.stoplight.io/docs/integrations/cd0f7973ec1b6-upload-file-attachments
     */
    public function upload(string $conversationId, string $locationId, array $attachmentUrls);

    /**
     * Post the necessary fields for the API to update message status.
     *
     * @see https://highlevel.stoplight.io/docs/integrations/4518573836035-update-message-status
     */
    public function updateStatus(string $messageId, $params = []);

    /**
     * Get the recording for a message by passing the message id
     *
     * @see https://highlevel.stoplight.io/docs/integrations/72f801089fbac-get-recording-by-message-id
     */
    public function getRecording(string $locationId, string $messageId);

    /**
     * Get transcription by Message ID
     *
     * @return array<mixed>|string
     *
     * @see https://highlevel.stoplight.io/docs/integrations/9f8e2c1696a55-get-transcription-by-message-id
     */
    public function getTranscript(string $locationId, string $messageId);

    /**
     * Download transcription by Message ID
     *
     * @return array<mixed>|string
     *
     * @see https://highlevel.stoplight.io/docs/integrations/2dfde1b5257fe-download-transcription-by-message-id
     */
    public function downloadTranscript(string $locationId, string $messageId);
}
