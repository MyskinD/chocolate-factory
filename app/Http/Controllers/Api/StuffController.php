<?php

namespace App\Http\Controllers\Api;

use App\Api\Services\StuffService;
use Illuminate\Http\Request;
use Exception;

class StuffController
{
    protected $stuffService;

    public function __construct(StuffService $stuffService)
    {
        $this->stuffService = $stuffService;
    }

    public function create(Request $request)
    {
        $data = $request->input();

        try {
            $stuff = $this->stuffService->createStuff($data);
        } catch(Exception $exception) {

        }
    }
}