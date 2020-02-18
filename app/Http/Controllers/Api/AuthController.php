<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Api\Services\Contracts\AuthServiceInterface;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use \Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Exception;

class AuthController
{
    /** @var AuthServiceInterface  */
    protected $authService;

    /**
     * AuthController constructor.
     * @param AuthServiceInterface $authService
     */
    public function __construct(AuthServiceInterface $authService) {
        $this->authService = $authService;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $data = $request->input();

        try {
            $auth = $this->authService->login($data);

            return response()->json($auth, 200);
        } catch (BadRequestHttpException $exception) {

            return response()->json($exception->getMessage(), 400);
        } catch (NotFoundHttpException $exception) {

            return response()->json($exception->getMessage(), 404);
        } catch (Exception $exception) {

            return response()->json($exception->getMessage(), 500);
        }
    }
}
