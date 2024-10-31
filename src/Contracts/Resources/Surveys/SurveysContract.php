<?php

declare(strict_types=1);

namespace GoHighLevelSDK\Contracts\Resources\Surveys;

interface SurveysContract
{
    /**
     * Get Surveys Submissions
     *
     * @see https://highlevel.stoplight.io/docs/integrations/288c25c7e319a-get-surveys-submissions
     */
    public function submissions(string $locationId, array $params = []);

    /**
     * Get Surveys
     *
     * @see https://highlevel.stoplight.io/docs/integrations/1e9fdbe3f2013-get-surveys
     */
    public function list(string $locationId, array $params = []);
}
