<?php

namespace App\Api\Services;

use App\Api\Repositories\StuffRepositoryInterface;
use App\Api\Services\Contracts\AuthServiceInterface;
use App\Api\Validations\StuffValidation;

class V1AuthService implements AuthServiceInterface
{
    /** @var StuffRepositoryInterface  */
    protected $stuffRepository;

    /** @var StuffValidation  */
    protected $stuffValidation;

    /**
     * StuffService constructor.
     * @param StuffValidation $stuffValidation
     * @param StuffRepositoryInterface $stuffRepository
     */
    public function __construct(
        StuffValidation $stuffValidation,
        StuffRepositoryInterface $stuffRepository
    ) {
        $this->stuffValidation = $stuffValidation;
        $this->stuffRepository = $stuffRepository;
    }

    /**
     * @param array $data
     * @return array
     */
    public function login(array $data): array
    {
        $this->stuffValidation->validationOnLogin($data);
        $stuff = $this->stuffRepository->getStuffByEmailAndPassword($data);

        $header = [
            'alg' => 'HS256',
            'typ' => 'JWT'
        ];
        $payload = [
            'stuffId' => $stuff->id,
            'role' => $stuff->role
        ];
        $secretKey = env('APP_KEY');
        $token = hash('sha256', json_encode($header)) . '.' .
                         hash('sha256', json_encode($payload)) . '.' .
                         hash('sha256', $secretKey);

        $stuff = $this->stuffRepository->setAuthorizationToken($stuff->id, $token);

        return [
            'stuff' => $stuff,
            'token' => $token
        ];
    }
}
