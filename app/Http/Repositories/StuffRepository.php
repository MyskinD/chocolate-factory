<?php

namespace App\Http\Repositories;

use Illuminate\Support\Facades\DB;
use NotFoundHttpException;

class StuffRepository implements StuffRepositoryInterface
{
    public function all()
    {
        // TODO: Implement all() method.
    }

    /**
     * @param int $id
     * @return \Illuminate\Support\Collection|mixed
     */
    public function get(int $id)
    {
        $stuff = DB::table('stuffs')
            ->select(
                'id',
                'first_name',
                'last_name',
                'email',
                'password'
            )
            ->where('id', $id)
            ->get();

        if (is_null($stuff)) {

            throw new NotFoundHttpException('Stuff was not found');
        }

        return $stuff;
    }

    public function add(array $data)
    {
        // TODO: Implement add() method.
    }

    public function save(int $id, array $data)
    {
        // TODO: Implement save() method.
    }

    public function remove(int $id)
    {
        // TODO: Implement remove() method.
    }
}