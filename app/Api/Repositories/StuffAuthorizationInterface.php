<?php

namespace App\Api\Repositories;

use App\Api\Models\StuffInterface;

interface StuffAuthorizationInterface
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
    public function setAuthorizationToken(Int $id, string $token): StuffInterface;
}
