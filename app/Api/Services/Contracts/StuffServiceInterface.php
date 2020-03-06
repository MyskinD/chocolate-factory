<?php

namespace App\Api\Services\Contracts;

use Illuminate\Database\Eloquent\Model;

interface StuffServiceInterface
{
    /**
     * @param array $data
     * @return Model
     */
    public function create(array $data): Model;

    /**
     * @param int $id
     * @return Model
     */
    public function get(int $id): Model;
}
