<?php

namespace App\Http\Controllers;

use App\Services\StuffService;
use Illuminate\Http\Request;


class StuffController extends Controller
{
    protected $stuffService;

    public function __construct(StuffService $stuffService)
    {
        $this->stuffService = $stuffService;
    }

    public function index()
    {
        //
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        try {
            $stuff = $this->stuffService->getStuff($id);

            echo'<pre>';
            print_r($stuff);
            echo'</pre>';
            die;

        } catch(NotFoundHttpException $exception) {

        }
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
