<?php

declare(strict_types=1);

namespace GoHighLevelSDK\Resources\Invoices;

use GoHighLevelSDK\Contracts\Resources\Invoices\TemplateContract;
use GoHighLevelSDK\Resources\Concerns\Transportable;
use GoHighLevelSDK\ValueObjects\Transporter\Payload;

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
