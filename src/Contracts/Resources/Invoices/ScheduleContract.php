<?php

declare(strict_types=1);

namespace GoHighLevelSDK\Contracts\Resources\Invoices;

interface ScheduleContract
{
    /**
     * Create Invoice Schedule
     *
     * @see https://highlevel.stoplight.io/docs/integrations/aa147661cf568-create-invoice-schedule
     */
    public function create(array $params);

    /**
     * List Schedules
     *
     * @see https://highlevel.stoplight.io/docs/integrations/7619335efb7fe-list-schedules
     */
    public function list(string $altId, string $altType, string $limit, string $offset, array $params = []);

    /**
     * Get a schedule
     *
     * @see https://highlevel.stoplight.io/docs/integrations/ada2739ce720d-get-an-schedule
     */
    public function get(string $scheduleId, string $altId, string $altType);

    /**
     * Update schedule
     *
     * @see https://highlevel.stoplight.io/docs/integrations/44c1dd3a54f54-update-schedule
     */
    public function update(string $scheduleId, string $altId, string $altType, array $params = []);

    /**
     * Delete Schedule
     *
     * @see https://highlevel.stoplight.io/docs/integrations/69c0d2ec4f403-delete-schedule
     */
    public function delete(string $scheduleId, string $altId, string $altType);

    /**
     * Schedule an invoice
     *
     *
     * @see https://highlevel.stoplight.io/docs/integrations/af847027b0f7b-schedule-an-schedule-invoice
     */
    public function invoice(string $scheduleId, string $altId, string $altType, array $params);

    /**
     * Manage Auto payment for an schedule invoice
     *
     * @see https://highlevel.stoplight.io/docs/integrations/34c4f33a09750-manage-auto-payment-for-an-schedule-invoice
     */
    public function autoPayment(string $scheduleId, string $altId, string $altType, array $params);

    /**
     * Cancel a scheduled invoice
     *
     * @see https://highlevel.stoplight.io/docs/integrations/dd5fcadbd3cfc-cancel-an-scheduled-invoice
     */
    public function cancel(string $scheduleId, string $altId, string $altType);
}
