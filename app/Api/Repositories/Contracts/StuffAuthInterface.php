<?php

namespace App\Api\Repositories\Contracts;

use App\Api\Models\Contracts\StuffInterface;

interface StuffAuthInterface
{
    /**
     * @param array $data
     * @return StuffInterface
     */
    public function getStuffByEmailAndPassword(array $data): StuffInterface;

    /**
     * @param Int $id
     * @param string $token
     * @return StuffInterface
     */
    public function saveToken(int $id, string $token): StuffInterface;
}
