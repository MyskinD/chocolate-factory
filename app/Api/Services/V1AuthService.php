<?php

namespace App\Api\Services;

use App\Api\Dto\JwtDTO;
use App\Api\Repositories\Contracts\SessionRepositoryInterface;
use App\Api\Repositories\Contracts\StuffRepositoryInterface;
use App\Api\Services\Contracts\AuthServiceInterface;
use App\Api\Services\Contracts\JwtServiceInterface;
use App\Api\Validations\StuffValidation;

class V1AuthService implements AuthServiceInterface
{
    /** @var int */
    public const MAX_ACTIVE_SESSION = 5;

    /** @var StuffRepositoryInterface  */
    protected $stuffRepository;

    /** @var SessionRepositoryInterface  */
    protected $sessionRepository;

    /** @var StuffValidation  */
    protected $stuffValidation;

    /** @var JwtServiceInterface  */
    protected $jwtService;

    /**
     * V1AuthService constructor.
     * @param StuffValidation $stuffValidation
     * @param StuffRepositoryInterface $stuffRepository
     * @param SessionRepositoryInterface $sessionRepository
     * @param JwtServiceInterface $jwtService
     */
    public function __construct(
        StuffValidation $stuffValidation,
        StuffRepositoryInterface $stuffRepository,
        SessionRepositoryInterface $sessionRepository,
        JwtServiceInterface $jwtService
    ) {
        $this->stuffValidation = $stuffValidation;
        $this->stuffRepository = $stuffRepository;
        $this->sessionRepository = $sessionRepository;
        $this->jwtService = $jwtService;
    }

    /**
     * @param array $data
     * @return array
     */
    public function login(array $data): array
    {
        $this->stuffValidation->validationOnLogin($data);
        $data['password'] = md5($data['password']);
        $stuff = $this->stuffRepository->getStuffByEmailAndPassword($data['email'], $data['password']);

        $stuffDto = new JwtDTO();
        $stuffDto->id = $stuff->id;
        $stuffDto->role = $stuff->role;

        $stuffDto->lifetime = config('app.access_token_lifetime');
        $accessToken = $this->jwtService->getToken($stuffDto);

        $stuffDto->lifetime = config('app.refresh_token_lifetime');
        $refreshToken = $this->jwtService->getToken($stuffDto);

        if ($this->sessionRepository->countByStuffId($stuff->id) >= self::MAX_ACTIVE_SESSION) {
            $this->sessionRepository->removeByStuffId($stuff->id);
        }

        $this->sessionRepository->add([
            'stuffId' => $stuff->id,
            'accessToken' => $accessToken,
            'refreshToken' => $refreshToken
        ]);

        return [
            'stuff' => $stuff,
            'accessToken' => $accessToken,
            'refreshToken' => $refreshToken,
        ];
    }
}
