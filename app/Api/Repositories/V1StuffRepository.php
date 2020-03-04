<?php

namespace App\Api\Repositories;

use App\Api\Models\V1Stuff;
use App\Api\Repositories\Contracts\StuffRepositoryInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class V1StuffRepository implements StuffRepositoryInterface
{
    /**
     * @return mixed|void
     */
    public function all()
    {
        // TODO: Implement all() method.
    }

    /**
     * @param int $id
     * @return V1Stuff|mixed
     */
    public function get(int $id)
    {
        $stuff = V1Stuff::query()
            ->where('id', $id)
            ->first();

        if (is_null($stuff)) {

            throw new NotFoundHttpException('Stuff was not found');
        }

        return $stuff;
    }

    /**
     * @param array $data
     * @return V1Stuff|mixed
     */
    public function add(array $data)
    {
        $stuff = new V1Stuff();
        $stuff->first_name = $data['first_name'];
        $stuff->last_name = $data['last_name'];
        $stuff->email = $data['email'];
        $stuff->password = $data['password'];
        $stuff->role = (int) $data['role'];
        $stuff->save();

        if (is_null($stuff)) {

            throw new NotFoundHttpException('Stuff was not created');
        }

        return $stuff;
    }

    /**
     * @param int $id
     * @param array $data
     * @return mixed|void
     */
    public function save(int $id, array $data)
    {
        // TODO: Implement save() method.
    }

    /**
     * @param int $id
     * @return mixed|void
     */
    public function remove(int $id): void
    {
        // TODO: Implement remove() method.
    }

    /**
     * @param array $data
     * @return V1Stuff|mixed
     */
    public function getStuffByEmailAndPassword(array $data)
    {
        $stuff = V1Stuff::query()
            ->where('email', $data['email'])
            ->where('password', $data['password'])
            ->first();

        if (is_null($stuff)) {

            throw new NotFoundHttpException('Stuff was not found');
        }

        return $stuff;
    }
}
