<?php

declare(strict_types=1);

namespace GoHighLevelSDK\Contracts;

use GoHighLevelSDK\Contracts\Resources\BusinessContract;
use GoHighLevelSDK\Contracts\Resources\CompanyContract;

interface ClientContract
{
    public function businesses(): BusinessContract;

    public function companies(): CompanyContract;
}
