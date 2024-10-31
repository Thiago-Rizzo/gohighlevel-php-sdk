<?php

declare(strict_types=1);

namespace GoHighLevelSDK\Resources\Courses;

use GoHighLevelSDK\Contracts\Resources\Courses\CourseContract;
use GoHighLevelSDK\Resources\Concerns\Transportable;
use GoHighLevelSDK\ValueObjects\Transporter\Payload;

final class Course implements CourseContract
{
    use Transportable;

    /**
     * {@inheritDoc}
     */
    public function import(string $locationId, string $userId, array $products)
    {
        $params['locationId'] = $locationId;
        $params['userId'] = $userId;
        $params['products'] = $products;
        $payload = Payload::create('courses/courses-exporter/public/import', $params);

        return $this->transporter->requestObject($payload)->data();
    }
}
