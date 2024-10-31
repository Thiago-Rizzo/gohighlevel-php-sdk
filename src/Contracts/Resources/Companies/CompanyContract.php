<?php

declare(strict_types=1);

namespace GoHighLevelSDK\Contracts\Resources\Companies;

interface CompanyContract
{
    /**
     * Get Company
     *
     * @see https://highlevel.stoplight.io/docs/integrations/cc7b8a7892119-get-company
     */
    public function get(string $companyId);
}
