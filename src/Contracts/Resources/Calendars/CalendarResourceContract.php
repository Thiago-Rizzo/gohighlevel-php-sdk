<?php

declare(strict_types=1);

namespace GoHighLevelSDK\Contracts\Resources\Calendars;

interface CalendarResourceContract
{
    /**
     * Get calendar resource by ID
     *
     *
     * @see https://highlevel.stoplight.io/docs/integrations/146912d6a9c38-get-calendar-resource
     */
    public function get(string $id, string $resourceType);

    /**
     * Update calendar resource by ID
     *
     *
     * @see https://highlevel.stoplight.io/docs/integrations/20987bed71eb0-update-calendar-resource
     */
    public function update(string $id, string $resourceType, array $params = []);

    /**
     * Delete calendar resource by ID
     *
     * @see https://highlevel.stoplight.io/docs/integrations/ca9afd52d4d0e-delete-calendar-resource
     */
    public function delete(string $id, string $resourceType);

    /**
     * List calendar resources by resource type and location ID
     *
     * @param  array  $params
     *
     * @see https://highlevel.stoplight.io/docs/integrations/e3a7d63a0134b-list-calendar-resources
     */
    public function list(string $resourceType, $params = []);

    /**
     * Create calendar resource by resource type
     *
     * @param  array  $params
     *
     * @see https://highlevel.stoplight.io/docs/integrations/cad3af068e0e0-create-calendar-resource
     */
    public function create(string $resourceType, $params = []);
}
