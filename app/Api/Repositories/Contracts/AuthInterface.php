<?php

namespace App\Api\Repositories\Contracts;

use App\Api\Models\Contracts\StuffInterface;

interface AuthInterface
{
    /**
     * @param array $data
     * @return StuffInterface
     */
    public function getStuffByEmailAndPassword(array $data): StuffInterface;
}
