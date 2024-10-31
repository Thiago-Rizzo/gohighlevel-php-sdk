<?php

declare(strict_types=1);

namespace GoHighLevelSDK\Resources;

use GoHighLevelSDK\Contracts\Resources\CompanyContract;
use GoHighLevelSDK\ValueObjects\Transporter\Payload;
use GoHighLevelSDK\ValueObjects\Transporter\Response;

final class Company implements CompanyContract
{
    use Concerns\Transportable;

    public function get(string $companyId): Response
    {
        $payload = Payload::get("companies/{$companyId}");

        return $this->transporter->requestObject($payload);
    }
}
