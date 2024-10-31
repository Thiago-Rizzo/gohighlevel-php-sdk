<?php

declare(strict_types=1);

namespace MusheAbdulHakim\GoHighLevel\Resources\Concerns;

use MusheAbdulHakim\GoHighLevel\Contracts\TransporterContract;

trait Transportable
{
    private TransporterContract $transporter;

    public function __construct(TransporterContract $transporter)
    {
        $this->transporter = $transporter;
    }
}
