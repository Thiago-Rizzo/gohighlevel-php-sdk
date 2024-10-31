<?php

declare(strict_types=1);

namespace GoHighLevelSDK\Resources\Concerns;

use GoHighLevelSDK\Contracts\TransporterContract;

trait Transportable
{
    private TransporterContract $transporter;

    public function __construct(TransporterContract $transporter)
    {
        $this->transporter = $transporter;
    }
}
