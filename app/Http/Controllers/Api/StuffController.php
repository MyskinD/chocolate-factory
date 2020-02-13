<?php

namespace App\Http\Controllers\Api;

use App\Api\Services\StuffServiceInterface;
use Illuminate\Http\Request;
use Exception;
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
        } catch (NotFoundHttpException $exception) {

            return response()->json($exception->getMessage(), 404);
        } catch(Exception $exception) {

            return response()->json($exception->getMessage(), 500);
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

            return response()->json($stuff, 201);
        } catch (NotFoundHttpException $exception) {

            return response()->json($exception->getMessage(), 404);
        } catch(Exception $exception) {

            return response()->json($exception->getMessage(), 500);
        }
    }
}
