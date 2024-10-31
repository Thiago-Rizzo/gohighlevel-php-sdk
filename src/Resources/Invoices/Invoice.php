<?php

declare(strict_types=1);

namespace GoHighLevelSDK\Resources\Invoices;

use GoHighLevelSDK\Contracts\Resources\Invoices\InvoiceContract;
use GoHighLevelSDK\Contracts\Resources\Invoices\ScheduleContract;
use GoHighLevelSDK\Contracts\Resources\Invoices\TemplateContract;
use GoHighLevelSDK\Contracts\Resources\Invoices\Text2payContract;
use GoHighLevelSDK\Resources\Concerns\Transportable;
use GoHighLevelSDK\ValueObjects\Transporter\Payload;

final class Invoice implements InvoiceContract
{
    use Transportable;

    public function generateNumber(string $altId, string $altType)
    {
        $params['altId'] = $altId;
        $params['altType'] = $altType;
        $payload = Payload::get('invoices/generate-invoice-number', $params);

        return $this->transporter->requestObject($payload)->data();
    }

    /**
     * {@inheritDoc}
     */
    public function get(string $invoiceId, string $altId, string $altType, array $params = [])
    {
        $params['altId'] = $altId;
        $params['altType'] = $altType;
        $payload = Payload::put("invoices/{$invoiceId}/", $params);

        return $this->transporter->requestObject($payload)->data();
    }

    public function update(string $invoiceId, array $params)
    {
        $payload = Payload::put("invoices/{$invoiceId}", $params);

        return $this->transporter->requestObject($payload)->data();
    }

    public function delete(string $invoiceId, string $altId, string $altType)
    {
        $payload = Payload::deleteFromUri("invoices/{$invoiceId}?altId={$altId}&altType={$altType}");

        return $this->transporter->requestObject($payload)->data();
    }

    public function void(string $invoiceId, string $altId, string $altType)
    {
        $params['altId'] = $altId;
        $params['altType'] = $altType;
        $payload = Payload::post("invoices/{$invoiceId}/void/", $params);

        return $this->transporter->requestObject($payload)->data();
    }

    public function send(string $invoiceId, array $params)
    {
        $payload = Payload::post("invoices/{$invoiceId}/send/", $params);

        return $this->transporter->requestObject($payload)->data();
    }

    public function recordPayment(string $invoiceId, array $params)
    {
        $payload = Payload::post("invoices/{$invoiceId}/record-payment", $params);

        return $this->transporter->requestObject($payload)->data();

    }

    public function create(array $params)
    {

        $payload = Payload::post('invoices/', $params);

        return $this->transporter->requestObject($payload)->data();
    }

    public function list(string $altId, string $altType, string $limit, string $offset, array $params = [])
    {
        $params['altId'] = $altId;
        $params['altType'] = $altType;
        $params['limit'] = $limit;
        $params['offset'] = $offset;
        $payload = Payload::get('invoices/', $params);

        return $this->transporter->requestObject($payload)->data();
    }

    public function template(): TemplateContract
    {
        return new Template($this->transporter);
    }

    public function schedule(): ScheduleContract
    {
        return new Schedule($this->transporter);
    }

    public function text2pay(): Text2payContract
    {
        return new Text2pay($this->transporter);
    }
}
