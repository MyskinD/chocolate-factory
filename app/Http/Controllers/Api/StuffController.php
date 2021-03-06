<?php

namespace App\Http\Controllers\Api;

use App\Api\Services\Contracts\StuffServiceInterface;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use \Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class StuffController
{
    /** @var StuffServiceInterface  */
    protected $stuffService;

    /**
     * StuffController constructor.
     * @param StuffServiceInterface $stuffService
     */
    public function __construct(StuffServiceInterface $stuffService)
    {
        $this->stuffService = $stuffService;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {
        $data = $request->input();

        try {
            $newStuff = $this->stuffService->create($data);

            return response()->json($newStuff, 201);
        } catch (BadRequestHttpException $exception) {
            return response()->json($exception->getMessage(), 400);
        } catch (NotFoundHttpException $exception) {
            return response()->json($exception->getMessage(), 404);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function view(Request $request)
    {
        $id = $request->id;

        try {
            $stuff = $this->stuffService->get($id);

            return response()->json($stuff, 200);
        } catch (NotFoundHttpException $exception) {
            return response()->json($exception->getMessage(), 404);
        }
    }
}
