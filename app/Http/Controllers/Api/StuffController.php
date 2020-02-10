<?php

namespace App\Http\Controllers\Api;

use App\Api\Services\StuffService;
use Illuminate\Http\Request;
use Exception;

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

        try {
            $newStuff = $this->stuffService->createStuff($data);

            return response()->json($newStuff, 201);
        } catch(Exception $exception) {

            return response()->json($exception->getMessage(), 400);
        }
    }
}
