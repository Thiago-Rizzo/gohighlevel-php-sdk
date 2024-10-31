<?php

declare(strict_types=1);

namespace MusheAbdulHakim\GoHighLevel\Resources\Companies;

use MusheAbdulHakim\GoHighLevel\Contracts\Resources\Companies\CompanyContract;
use MusheAbdulHakim\GoHighLevel\Resources\Concerns\Transportable;
use MusheAbdulHakim\GoHighLevel\ValueObjects\Transporter\Payload;

final class Company implements CompanyContract
{
    use Transportable;

    public function get(string $companyId)
    {
        $payload = Payload::get("companies/{$companyId}");

        return $this->transporter->requestObject($payload)->get('company');
    }
}
