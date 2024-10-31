<?php

declare(strict_types=1);

namespace GoHighLevelSDK\Resources\Companies;

use GoHighLevelSDK\Contracts\Resources\Companies\CompanyContract;
use GoHighLevelSDK\Resources\Concerns\Transportable;
use GoHighLevelSDK\ValueObjects\Transporter\Payload;

final class Company implements CompanyContract
{
    use Transportable;

    public function get(string $companyId)
    {
        $payload = Payload::get("companies/{$companyId}");

        return $this->transporter->requestObject($payload)->get('company');
    }
}
