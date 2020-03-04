<?php

namespace App\Api\Services\Contracts;

use App\Api\Models\Contracts\ModelInterface;

interface StuffServiceInterface
{
    /**
     * @param array $data
     * @return ModelInterface
     */
    public function create(array $data): ModelInterface;

    /**
     * @param int $id
     * @return ModelInterface
     */
    public function get(int $id): ModelInterface;
}
