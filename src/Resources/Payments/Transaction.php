<?php

namespace GoHighLevelSDK\Resources\Payments;

use GoHighLevelSDK\Contracts\Resources\Payments\TransactionContract;
use GoHighLevelSDK\Resources\Concerns\Transportable;
use GoHighLevelSDK\ValueObjects\Transporter\Payload;

class Transaction implements TransactionContract
{
    use Transportable;

    /**
     * {@inheritDoc}
     */
    public function list(string $altId, string $altType, array $params = [])
    {
        $params['altId'] = $altId;
        $params['altType'] = $altType;
        $payload = Payload::get('payments/transactions', $params);

        return $this->transporter->requestObject($payload)->data();
    }

    /**
     * {@inheritDoc}
     */
    public function get(string $transactionId, string $altId, string $altType, array $params = [])
    {
        $payload = Payload::get("payments/transactions/{$transactionId}", $params);

        return $this->transporter->requestObject($payload)->data();
    }
}
