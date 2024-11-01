<?php

declare(strict_types=1);

namespace GoHighLevelSDK\Resources\Funnels;

use GoHighLevelSDK\Contracts\Resources\Funnels\RedirectContract;
use GoHighLevelSDK\Resources\Concerns\Transportable;
use GoHighLevelSDK\ValueObjects\Transporter\Payload;

final class Redirect implements RedirectContract
{
    use Transportable;

    public function create(array $params)
    {
        $paylaod = Payload::post('funnels/lookup/redirect', $params);

        return $this->transporter->requestObject($paylaod)->data();
    }

    public function update(string $id, array $params)
    {
        $payload = Payload::patch("funnels/lookup/redirect/{$id}", $params);

        return $this->transporter->requestObject($payload)->data();
    }

    public function list(string $locationId, int $limit, int $offset)
    {
        $params['locationId'] = $locationId;
        $params['limit'] = $limit;
        $params['offset'] = $offset;
        $payload = Payload::get('funnels/lookup/redirect/list', $params);

        return $this->transporter->requestObject($payload)->data();
    }

    public function delete(string $id, string $locationId)
    {
        $payload = Payload::deleteFromUri("funnels/lookup/redirect/{$id}?locationId={$locationId}");

        return $this->transporter->requestObject($payload)->data();
    }
}
