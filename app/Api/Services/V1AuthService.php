<?php

namespace App\Api\Services;

use App\Api\Dto\StuffDTO;
use App\Api\Models\V1Session;
use App\Api\Repositories\Contracts\RepositoryInterface;
use App\Api\Repositories\V1SessionRepository;
use App\Api\Services\Contracts\AuthServiceInterface;
use App\Api\Services\Contracts\JwtServiceInterface;
use App\Api\Validations\StuffValidation;

class V1AuthService implements AuthServiceInterface
{
    /** @var RepositoryInterface */
    protected $stuffRepository;

    /** @var V1SessionRepository */
    protected $sessionRepository;

    /** @var StuffValidation  */
    protected $stuffValidation;

    /** @var JwtServiceInterface  */
    protected $jwtService;

    /**
     * V1AuthService constructor.
     * @param StuffValidation $stuffValidation
     * @param RepositoryInterface $stuffRepository
     * @param V1SessionRepository $sessionRepository
     * @param JwtServiceInterface $jwtService
     */
    public function __construct(
        StuffValidation $stuffValidation,
        RepositoryInterface $stuffRepository,
        V1SessionRepository $sessionRepository,
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
        $stuff = $this->stuffRepository->getStuffByEmailAndPassword($data);

        $stuffDto = new StuffDTO();
        $stuffDto->id = $stuff->id;
        $stuffDto->role = $stuff->role;

        $accessToken = $this->jwtService->getAccessToken($stuffDto);
        $refreshToken = $this->jwtService->getRefreshToken($stuffDto);

        if (count($this->sessionRepository->allById($stuff->id)) >= V1Session::SESSION_COUNT) {
            $this->sessionRepository->remove($stuff->id);
        }

        $this->sessionRepository->add([
            'stuffId' => $stuff->id,
            'accessToken' => $accessToken,
            'refreshToken' => $refreshToken
        ]);

        return [
            'stuff' => $stuff,
            'access_token' => $accessToken,
            'refresh_token' => $refreshToken,
        ];
    }
}
