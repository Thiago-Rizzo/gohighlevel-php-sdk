<?php

declare(strict_types=1);

namespace GoHighLevelSDK\Contracts\Resources\Courses;

interface CourseContract
{
    /**
     * Import Courses
     *
     * @param  array<mixed>  $products
     * @return array<mixed>|string
     *
     * @see https://highlevel.stoplight.io/docs/integrations/7ca9bb420fe98-import-courses
     */
    public function import(string $locationId, string $userId, array $products);
}
