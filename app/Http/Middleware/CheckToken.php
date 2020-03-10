<?php

namespace App\Http\Middleware;

use App\Api\Repositories\Contracts\SessionRepositoryInterface;
use \Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Closure;

class CheckToken
{
    /** @var SessionRepositoryInterface  */
    protected $sessionRepository;

    /**
     * CheckToken constructor.
     * @param SessionRepositoryInterface $sessionRepository
     */
    public function __construct(SessionRepositoryInterface $sessionRepository)
    {
        $this->sessionRepository = $sessionRepository;
    }

    /**
     * @param $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $token = $request->headers->get('Authorization');

        try {
            $this->sessionRepository->getStuffIdByToken($token);

            return $next($request);
        } catch(NotFoundHttpException $exception) {
            return response()->json($exception->getMessage(), 404);
        }
    }
}
