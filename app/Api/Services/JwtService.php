<?php

namespace App\Api\Services;

use App\Api\Dto\JwtDTO;
use App\Api\Services\Contracts\JwtServiceInterface;

class JwtService implements JwtServiceInterface
{
    /** @var int  */
    const PAYLOAD = 1;

    /**
     * @param JwtDTO $dto
     * @return string
     */
    public function getToken(JwtDTO $dto): string
    {
        $header = $this->getHeader();
        $payload = $this->getPayload($dto);
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
     * @param JwtDTO $dto
     * @return string
     */
    protected function getPayload(JwtDTO $dto): string
    {
        $payload = [
            'id' => $dto->id,
            'role' => $dto->role,
            'lifetime' => $dto->lifetime
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

    /**
     * @param string $accessToken
     * @return mixed
     */
    public function decodingPayload(string $accessToken)
    {
        $payload = base64_decode(explode('.', $accessToken)[self::PAYLOAD]);

        return  json_decode($payload);
    }


    /**
     * @param string $lifetime
     * @return bool
     */
    public function checkTokenLifetime(string $lifetime): bool
    {
        if ((int) $lifetime < time()) {
            return false;
        }

        return true;
    }
}
