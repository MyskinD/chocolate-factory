<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Api\Services\Contracts\AuthServiceInterface;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use \Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AuthController
{
    /**
     * @param Request $request
     * @param AuthServiceInterface $authService
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request, AuthServiceInterface $authService)
    {
        $data = $request->input();

        try {
            $auth = $authService->login($data);

            return response()->json($auth, 200);
        } catch (BadRequestHttpException $exception) {
            return response()->json($exception->getMessage(), 400);
        } catch (NotFoundHttpException $exception) {
            return response()->json($exception->getMessage(), 404);
        }
    }
}
