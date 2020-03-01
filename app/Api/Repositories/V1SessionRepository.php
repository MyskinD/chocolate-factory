<?php

namespace App\Api\Repositories;

use App\Api\Models\V1Session;
use App\Api\Repositories\Contracts\RepositoryInterface;

class V1SessionRepository implements RepositoryInterface
{
    public function all()
    {
        // TODO: Implement all() method.
    }

    /**
     * @param int $id
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function allById(int $id)
    {
        $sessions = V1Session::query()
            ->where('stuff_id', $id)
            ->get();

        return $sessions;
    }

    public function get(int $id)
    {
        // TODO: Implement get() method.
    }

    /**
     * @param array $data
     * @return V1Session|mixed
     */
    public function add(array $data)
    {
        $session = new V1Session();
        $session->stuff_id = $data['stuffId'];
        $session->access_token = $data['accessToken'];
        $session->refresh_token = $data['refreshToken'];
        $session->save();

        return $session;
    }

    public function save(int $id, array $data)
    {
        // TODO: Implement save() method.
    }

    /**
     * @param int $id
     */
    public function remove(int $id): void
    {
        V1Session::query()
            ->where('stuff_id', $id)
            ->delete();
    }
}
