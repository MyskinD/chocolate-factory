<?php

namespace App\Api\Repositories;

use App\Api\Models\StuffInterface;
use App\Api\Models\V1Stuff;
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
     * @return StuffInterface
     */
    public function get(int $id): StuffInterface
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
     * @return StuffInterface
     */
    public function add(array $data): StuffInterface
    {
        $stuff = new V1Stuff();
        $stuff->first_name = $data['first_name'];
        $stuff->last_name = $data['last_name'];
        $stuff->email = $data['email'];
        $stuff->password = md5($data['password']);
        $stuff->role = (int) $data['role'];
        $stuff->save();

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
    public function remove(int $id)
    {
        // TODO: Implement remove() method.
    }
}
