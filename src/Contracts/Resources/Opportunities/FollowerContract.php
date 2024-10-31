<?php

declare(strict_types=1);

namespace GoHighLevelSDK\Contracts\Resources\Opportunities;

interface FollowerContract
{
    /**
     * Add Followers
     *
     * @param  array  $followers
     * @return array|string
     *
     * @see https://highlevel.stoplight.io/docs/integrations/a4853ad9d0a48-add-followers
     */
    public function add(string $id, array $followers);

    /**
     * Delete Followers
     *
     * @return array|string
     *
     * @see https://highlevel.stoplight.io/docs/integrations/0412c261ca64b-remove-followers
     */
    public function remove(string $id);

    /**
     * Delete Followers
     *
     * @return array|string
     *
     * @see https://highlevel.stoplight.io/docs/integrations/0412c261ca64b-remove-followers
     */
    public function delete(string $id);
}
