<?php

declare(strict_types=1);

namespace GoHighLevelSDK\Resources\Contacts;

use GoHighLevelSDK\Contracts\Resources\Contacts\AppointmentContract;
use GoHighLevelSDK\Contracts\Resources\Contacts\CampaignContract;
use GoHighLevelSDK\Contracts\Resources\Contacts\ContactContract;
use GoHighLevelSDK\Contracts\Resources\Contacts\FollowerContract;
use GoHighLevelSDK\Contracts\Resources\Contacts\NoteContract;
use GoHighLevelSDK\Contracts\Resources\Contacts\SearchContract;
use GoHighLevelSDK\Contracts\Resources\Contacts\TagContract;
use GoHighLevelSDK\Contracts\Resources\Contacts\TaskContract;
use GoHighLevelSDK\Contracts\Resources\Contacts\WorkflowContract;
use GoHighLevelSDK\Resources\Concerns\Transportable;
use GoHighLevelSDK\ValueObjects\Transporter\Payload;
use GoHighLevelSDK\ValueObjects\Transporter\Response;

final class Contact implements ContactContract
{
    use Transportable;

    /**
     * Get Contact by contactId
     *
     * @see https://highlevel.stoplight.io/docs/integrations/00c5ff21f0030-get-contact
     */
    public function get(string $contactId)
    {
        $payload = Payload::get("contacts/{$contactId}");

        return $this->transporter->requestObject($payload)->get('contact');
    }

    /**
     * Update a Contact
     *
     * @see https://highlevel.stoplight.io/docs/integrations/9ce5a739d4fb9-update-contact
     */
    public function update(string $contactId, array $params)
    {
        $payload = Payload::put("contacts/{$contactId}", $params);

        return $this->transporter->requestObject($payload)->data();
    }

    /**
     * Delete a Contact
     *
     * @see https://highlevel.stoplight.io/docs/integrations/28ab84e9522b6-delete-contact
     */
    public function delete(string $contactId): Response
    {
        $payload = Payload::delete('contacts/', $contactId);

        return $this->transporter->requestObject($payload);
    }

    /**
     * Upsert a contact
     *
     * @see https://highlevel.stoplight.io/docs/integrations/f71bbdd88f028-upsert-contact
     */
    public function upsert(array $params): Response
    {
        $payload = Payload::create('contacts/upsert', $params);

        return $this->transporter->requestObject($payload);
    }

    /**
     * Get Contacts By BusinessId
     *
     * @see https://highlevel.stoplight.io/docs/integrations/8efc6d5a99417-get-contacts-by-business-id
     */
    public function byBusiness(string $businessId)
    {
        $payload = Payload::get('contacts/business/businessId', [
            'locationId' => $businessId,
        ]);

        return $this->transporter->requestObject($payload)->get('contacts');
    }

    /**
     * Create Contact
     *
     * @see https://highlevel.stoplight.io/docs/integrations/4c8362223c17b-create-contact
     */
    public function create(array $params)
    {
        $payload = Payload::create('contacts/', $params);

        return $this->transporter->requestObject($payload)->data();
    }

    /**
     * Get Contacts
     *
     * @see https://highlevel.stoplight.io/docs/integrations/ab55933a57f6f-get-contacts
     */
    public function list(string $locationId)
    {
        $payload = Payload::get('contacts/', [
            'locationId' => $locationId,
        ]);

        return $this->transporter
            ->requestObject($payload)
            ->get('contacts');
    }

    /**
     * Contact Tasks
     */
    public function tasks(): TaskContract
    {
        return new Task($this->transporter);
    }

    /**
     * Contact Appointments
     */
    public function appointments(): AppointmentContract
    {
        return new Appointment($this->transporter);
    }

    /**
     * Contact Tags
     */
    public function tags(): TagContract
    {
        return new Tag($this->transporter);
    }

    /**
     * Contact Notes
     */
    public function notes(): NoteContract
    {
        return new Note($this->transporter);
    }

    /**
     * Contact Campaign
     */
    public function campaign(): CampaignContract
    {
        return new Campaign($this->transporter);
    }

    /**
     * Contact Workflow
     */
    public function workflow(): WorkflowContract
    {
        return new Workflow($this->transporter);
    }

    /**
     * Add/Remove Contacts From Business
     */
    public function bulk(string $locationId, array $ids, string $businessId): array
    {
        return (new Bulk($this->transporter))->addOrRemove($locationId, $ids, $businessId);
    }

    /**
     * Search Contacts
     */
    public function search(): SearchContract
    {
        return new Search($this->transporter);
    }

    /**
     * Contact Followers
     */
    public function followers(): FollowerContract
    {
        return new Follower($this->transporter);
    }
}
