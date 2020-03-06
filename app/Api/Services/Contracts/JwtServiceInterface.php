<?php

namespace App\Api\Services\Contracts;

use App\Api\Dto\JwtDTO;

interface JwtServiceInterface
{
    /**
     * @param JwtDTO $dto
     * @return string
     */
    public function getToken(JwtDTO $dto): string;
}
