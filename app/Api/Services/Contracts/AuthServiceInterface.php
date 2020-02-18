<?php

namespace App\Api\Services\Contracts;

interface AuthServiceInterface
{
    /**
     * @param array $data
     * @return mixed
     */
    public function login(array $data);
}
