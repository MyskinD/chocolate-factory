<?php

namespace App\Api\Repositories;

use App\Models\Stuff;

class StuffRepository implements StuffRepositoryInterface
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
     * @return mixed|void
     */
    public function get(int $id)
    {
        // TODO: Implement get() method.
    }

    /**
     * @param array $data
     * @return Stuff
     */
    public function add(array $data): Stuff
    {
        $stuff = new Stuff();
        $stuff->first_name = $data['first_name'];
        $stuff->last_name = $data['last_name'];
        $stuff->email = $data['email'];
        $stuff->password = md5($data['password']);
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
