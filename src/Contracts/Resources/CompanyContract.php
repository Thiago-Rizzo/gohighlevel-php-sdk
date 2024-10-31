<?php

declare(strict_types=1);

namespace GoHighLevelSDK\Contracts\Resources;

interface CompanyContract
{
    public function get(string $companyId);
}
