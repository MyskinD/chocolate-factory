<?php

namespace App\Api\Services;

use App\Models\Api\v1\Stuff;

interface StuffServiceInterface
{
    /**
     * @param array $data
     * @return Stuff
     */
    public function create(array $data): Stuff;

    /**
     * @param int $id
     * @return mixed
     */
    public function get(int $id);
}
