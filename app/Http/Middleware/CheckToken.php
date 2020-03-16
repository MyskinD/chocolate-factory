<?php

namespace App\Http\Middleware;

use App\Api\Repositories\Contracts\SessionRepositoryInterface;
use App\Api\Services\Contracts\AuthServiceInterface;
use App\Api\Services\Contracts\JwtServiceInterface;
use \Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Closure;

class CheckToken
{
    /** @var SessionRepositoryInterface  */
    protected $sessionRepository;

    /** @var JwtServiceInterface  */
    protected $jwtService;

    /**
     * CheckToken constructor.
     * @param SessionRepositoryInterface $sessionRepository
     * @param JwtServiceInterface $jwtService
     */
    public function __construct(
        SessionRepositoryInterface $sessionRepository,
        JwtServiceInterface $jwtService
    ) {
        $this->sessionRepository = $sessionRepository;
        $this->jwtService = $jwtService;
    }

    /**
     * @param $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $jwt = $request->headers->get('Authorization');

        try {
            if (!$jwt) {
                throw new NotFoundHttpException('Session was not found');
            }

            if (!$this->jwtService->isTokenValid($jwt)) {
                throw new NotFoundHttpException('Token is not valid');
            }

            $session = $this->sessionRepository->getStuffByToken($jwt);
            $accessToken = $session->access_token;
            $payload = $this->jwtService->decodingPayload($accessToken);

            if (!$this->jwtService->isTokenExpired((int) $payload->lifetime)) {
                $this->sessionRepository->removeByToken($jwt);

                throw new NotFoundHttpException('Token is not expired');
            }

            return $next($request);
        } catch(NotFoundHttpException $exception) {
            return response()->json($exception->getMessage(), 401);
        }
    }
}
