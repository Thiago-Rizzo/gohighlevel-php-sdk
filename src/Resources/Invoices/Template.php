<?php

declare(strict_types=1);

namespace MusheAbdulHakim\GoHighLevel\Resources\Invoices;

use MusheAbdulHakim\GoHighLevel\Contracts\Resources\Invoices\TemplateContract;
use MusheAbdulHakim\GoHighLevel\Resources\Concerns\Transportable;
use MusheAbdulHakim\GoHighLevel\ValueObjects\Transporter\Payload;

final class Template implements TemplateContract
{
    use Transportable;

    public function create(array $params)
    {
        $payload = Payload::post('invoices/template/', $params);

        return $this->transporter->requestObject($payload)->data();
    }

    public function list(string $altId, string $altType, string $limit, string $offset, array $params = [])
    {
        $params['altId'] = $altId;
        $params['altType'] = $altType;
        $params['limit'] = $limit;
        $params['offset'] = $offset;
        $payload = Payload::get('invoices/template/', $params);

        return $this->transporter->requestObject($payload)->data();
    }

    public function get(string $templateId, string $altId, string $altType)
    {
        $params['altId'] = $altId;
        $params['altType'] = $altType;
        $payload = Payload::get("invoices/template/{$templateId}/");

        return $this->transporter->requestObject($payload)->data();
    }

    public function update(string $templateId, array $params = [])
    {
        $payload = Payload::put("invoices/template/{$templateId}/", $params);

        return $this->transporter->requestObject($payload)->data();
    }

    public function delete(string $templateId)
    {
        $payload = Payload::deleteFromUri("invoices/template/{$templateId}/");

        return $this->transporter->requestObject($payload)->data();
    }
}
