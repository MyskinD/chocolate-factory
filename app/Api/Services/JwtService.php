<?php

namespace App\Api\Services;

use App\Api\Dto\Contracts\DtoInterface;
use App\Api\Services\Contracts\JwtServiceInterface;

class JwtService implements JwtServiceInterface
{
    /** @var DtoInterface */
    protected $dto;

    /**
     * @param DtoInterface $dto
     * @return string
     */
    public function getAccessToken(DtoInterface $dto): string
    {
        $this->dto = $dto;

        $header = $this->getHeader();
        $payload = $this->getPayload(config('app.access_token_lifetime'));
        $signature =$this->getSignature($header, $payload);

        return $header . '.' . $payload . '.' . $signature;
    }

    /**
     * @param DtoInterface $dto
     * @return string
     */
    public function getRefreshToken(DtoInterface $dto): string
    {
        $this->dto = $dto;

        $header = $this->getHeader();
        $payload = $this->getPayload(config('app.refresh_token_lifetime'));
        $signature =$this->getSignature($header, $payload);

        return $header . '.' . $payload . '.' . $signature;
    }

    /**
     * @return string
     */
    protected function getHeader(): string
    {
        $header = [
            'alg' => 'HS256',
            'typ' => 'JWT'
        ];
        $header = json_encode($header);

        return base64_encode($header);
    }

    /**
     * @param $lifetime
     * @return string
     */
    protected function getPayload(string $lifetime): string
    {
        $payload = [
            'id' => $this->dto->id,
            'role' => $this->dto->role,
            'lifetime' => $lifetime
        ];
        $payload = json_encode($payload);

        return  base64_encode($payload);
    }

    /**
     * @param string $header
     * @param string $payload
     * @return string
     */
    protected function getSignature(string $header, string $payload): string
    {
        $signature = hash_hmac('SHA256', $header . "." . $payload, config('app.secret_key'), true);

        return base64_encode($signature);
    }
}
