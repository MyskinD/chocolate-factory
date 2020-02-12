<?php

namespace App\Http\Controllers\Api;

use App\Api\Services\StuffService;
use Illuminate\Http\Request;
use Exception;
use \Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use \Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class StuffController
{
    /** @var StuffService  */
    protected $stuffService;

    /**
     * StuffController constructor.
     * @param StuffService $stuffService
     */
    public function __construct(StuffService $stuffService)
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
        $contentType = $request->headers->get('content-type');
        $apiData = explode('+', last(explode('/', $contentType)));
        $vApi = array_shift($apiData);

        try {
            $newStuff = $this->stuffService->createStuff($data, $vApi);

            return response()->json($newStuff, 201);
        } catch (BadRequestHttpException $exception) {

            return response()->json($exception->getMessage(), 400);
        } catch (NotFoundHttpException $exception) {

            return response()->json($exception->getMessage(), 404);
        } catch(Exception $exception) {

            return response()->json($exception->getMessage(), 500);
        }
    }
}
