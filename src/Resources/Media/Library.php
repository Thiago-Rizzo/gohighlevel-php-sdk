<?php

declare(strict_types=1);

namespace MusheAbdulHakim\GoHighLevel\Resources\Media;

use MusheAbdulHakim\GoHighLevel\Contracts\Resources\Media\LibraryContract;
use MusheAbdulHakim\GoHighLevel\Resources\Concerns\Transportable;
use MusheAbdulHakim\GoHighLevel\ValueObjects\Transporter\Payload;

final class Library implements LibraryContract
{
    use Transportable;

    public function delete(string $id, string $altId, string $altType)
    {
        $payload = Payload::deleteFromUri("medias/{$id}?altType={$altType}&altId={$altId}");

        return $this->transporter->requestObject($payload)->data();
    }

    public function upload(array $params)
    {
        $payload = Payload::post('medias/upload-file', $params);

        return $this->transporter->requestObject($payload)->data();
    }

    public function list(string $altId, string $altType, string $sortBy, string $sortOrder, array $params = [])
    {
        $params['altId'] = $altId;
        $params['altType'] = $altType;
        $params['sortBy'] = $sortBy;
        $params['sortOrder'] = $sortOrder;
        $payload = Payload::get('medias/files', $params);

        return $this->transporter->requestObject($payload)->data();
    }
}
