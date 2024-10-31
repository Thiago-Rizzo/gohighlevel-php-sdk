<?php

declare(strict_types=1);

namespace MusheAbdulHakim\GoHighLevel\Contracts\Resources;

use MusheAbdulHakim\GoHighLevel\ValueObjects\Transporter\Response;

interface BusinessContract
{
    public function update(string $businessId, array $params): Response;

    public function delete(string $businessId): Response;

    public function get(string $businessId): Response;

    public function getByLocation(string $locationId): Response;

    public function create(string $name, string $locationId, array $params): Response;
}
