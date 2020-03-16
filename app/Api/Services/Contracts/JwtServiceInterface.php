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
     * @param int $lifetime
     * @return bool
     */
    public function isTokenExpired(int $lifetime): bool;

    /**
     * @param string $accessToken
     * @return bool
     */
    public function isTokenValid(string $accessToken): bool;
}
