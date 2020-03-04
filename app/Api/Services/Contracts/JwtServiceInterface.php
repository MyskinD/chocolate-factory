<?php

namespace App\Api\Services\Contracts;

use App\Api\Dto\Contracts\DtoInterface;

interface JwtServiceInterface
{
    /**
     * @param DtoInterface $dto
     * @return string
     */
    public function getToken(DtoInterface $dto): string;
}
