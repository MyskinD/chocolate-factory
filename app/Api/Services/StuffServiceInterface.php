<?php

namespace App\Api\Services;

use App\Api\Models\StuffInterface;

interface StuffServiceInterface
{
    /**
     * @param array $data
     * @return StuffInterface
     */
    public function create(array $data): StuffInterface;

    /**
     * @param int $id
     * @return StuffInterface
     */
    public function get(int $id): StuffInterface;
}
