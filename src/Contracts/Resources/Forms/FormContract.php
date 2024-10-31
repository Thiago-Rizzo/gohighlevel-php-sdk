<?php

declare(strict_types=1);

namespace GoHighLevelSDK\Contracts\Resources\Forms;

/**
 * Forms Api
 *
 * @see https://highlevel.stoplight.io/docs/integrations/0af2368376eb2-forms-api
 */
interface FormContract
{
    /**
     * Get Forms Submissions
     *
     * @param  array<mixed>  $params
     * @return array<mixed>|string
     *
     * @see https://highlevel.stoplight.io/docs/integrations/a6114bd7685d1-get-forms-submissions
     */
    public function submissions(string $locationId, array $params = []);

    /**
     * Upload files to custom fields
     *
     * @param  array<mixed>  $params
     * @return array<mixed>|string
     *
     * @see https://highlevel.stoplight.io/docs/integrations/p74kog0xqugo8-upload-files-to-custom-fields
     */
    public function uploadToCustomFields(string $locationId, string $contactId, array $params = []);

    /**
     * Get Forms
     *
     * @param  array<mixed>  $params
     * @return array<mixed>|string
     *
     * @see https://highlevel.stoplight.io/docs/integrations/49e29c1716c61-get-forms
     */
    public function list(string $locationId, array $params = []);
}
