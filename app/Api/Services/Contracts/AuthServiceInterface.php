<?php

namespace App\Api\Services\Contracts;

interface AuthServiceInterface
{
    /**
     * @param array $data
     * @return array
     */
    public function login(array $data): array;
}
