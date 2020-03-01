<?php

namespace App\Api\Services;

use App\Api\Models\V1Stuff;
use App\Api\Services\Contracts\JwtServiceInterface;

class JwtService implements JwtServiceInterface
{
    /** @var V1Stuff $stuff */
    private $stuff;

    /**
     * @param V1Stuff $stuff
     * @return string
     */
    public function getAccessToken(V1Stuff $stuff): string
    {
        $this->stuff = $stuff;

        $header = $this->getHeader();
        $payload = $this->getPayload(time() + 60 * 30);
        $signature =$this->getSignature($header, $payload);

        return $header . '.' . $payload . '.' . $signature;
    }

    /**
     * @param V1Stuff $stuff
     * @return string
     */
    public function getRefreshToken(V1Stuff $stuff): string
    {
        $this->stuff = $stuff;

        $header = $this->getHeader();
        $payload = $this->getPayload(time() + 60 * 60 * 24 * 60);
        $signature =$this->getSignature($header, $payload);

        return $header . '.' . $payload . '.' . $signature;
    }

    /**
     * @return string
     */
    private function getHeader(): string
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
    private function getPayload($lifetime): string
    {
        $payload = [
            'stuffId' => $this->stuff->id,
            'role' => $this->stuff->role,
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
    private function getSignature(string $header, string $payload)
    {
        $signature = hash_hmac('SHA256', $header . "." . $payload, config('app.secret_key'), true);

        return base64_encode($signature);
    }
}
