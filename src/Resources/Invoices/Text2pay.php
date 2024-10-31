<?php

declare(strict_types=1);

namespace GoHighLevelSDK\Resources\Invoices;

use GoHighLevelSDK\Contracts\Resources\Invoices\Text2payContract;
use GoHighLevelSDK\Resources\Concerns\Transportable;
use GoHighLevelSDK\ValueObjects\Transporter\Payload;

final class Text2pay implements Text2payContract
{
    use Transportable;

    public function create(array $params)
    {
        $payload = Payload::post('invoices/text2pay/', $params);

        return $this->transporter->requestObject($payload)->data();
    }

    public function update(string $id, array $params)
    {
        $payload = Payload::post("invoices/text2pay/{$id}/", $params);

        return $this->transporter->requestObject($payload)->data();
    }
}
