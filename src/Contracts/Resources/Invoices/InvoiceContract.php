<?php

declare(strict_types=1);

namespace GoHighLevelSDK\Contracts\Resources\Invoices;

interface InvoiceContract
{
    /**
     * Get the next invoice number for the given location
     *
     *
     * @see https://highlevel.stoplight.io/docs/integrations/8e07202d2d38a-generate-invoice-number
     */
    public function generateNumber(string $altId, string $altType);

    /**
     * API to get invoice by invoice id
     *
     *
     * @see https://highlevel.stoplight.io/docs/integrations/09ff1bc76ef48-get-invoice
     */
    public function get(string $invoiceId, string $altId, string $altType, array $params = []);

    /**
     * API to update invoice by invoice id
     *
     *
     * @see https://highlevel.stoplight.io/docs/integrations/76f00a800fa6e-update-invoice
     */
    public function update(string $invoiceId, array $params);

    /**
     * Delete invoice
     *
     *
     * @see https://highlevel.stoplight.io/docs/integrations/af9fb9b428e74-delete-invoice
     */
    public function delete(string $invoiceId, string $altId, string $altType);

    /**
     * Void invoice
     *
     * @see https://highlevel.stoplight.io/docs/integrations/7b2e39e2399ba-void-invoice
     */
    public function void(string $invoiceId, string $altId, string $altType);

    /**
     * Send invoice

     *
     * @see https://highlevel.stoplight.io/docs/integrations/dbcb9c72c2f7a-send-invoice
     */
    public function send(string $invoiceId, array $params);

    /**
     * Record a manual payment for an invoice
     *
     *
     *
     *@see https://highlevel.stoplight.io/docs/integrations/a6854d15f651d-record-a-manual-payment-for-an-invoice
     */
    public function recordPayment(string $invoiceId, array $params);

    /**
     * Create Invoice
     *
     * @see https://highlevel.stoplight.io/docs/integrations/b2be804d8764c-create-Invoice
     */
    public function create(array $params);

    /**
     * List Invoices
     *
     * @see https://highlevel.stoplight.io/docs/integrations/3cdfb8c2dd8d4-list-invoices
     */
    public function list(string $altId, string $altType, string $limit, string $offset, array $params = []);

    /**
     * Invoice Templates
     */
    public function template(): TemplateContract;

    /**
     * Invoices Schedule
     */
    public function schedule(): ScheduleContract;

    /**
     * Invoices Text2Pay
     */
    public function text2pay(): Text2payContract;
}
