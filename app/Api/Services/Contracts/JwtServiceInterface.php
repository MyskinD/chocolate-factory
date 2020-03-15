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

    /**
     * @param string $accessToken
     * @return mixed
     */
    public function decodingPayload(string $accessToken);

    /**
     * @param string $lifetime
     * @return bool
     */
    public function checkTokenLifetime(string $lifetime): bool;
}
