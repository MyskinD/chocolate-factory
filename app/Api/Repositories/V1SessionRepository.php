<?php

namespace App\Api\Repositories;

use App\Api\Models\V1Session;
use App\Api\Repositories\Contracts\SessionRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class V1SessionRepository implements SessionRepositoryInterface
{
    public function all()
    {
        // TODO: Implement all() method.
    }

    public function get(int $id)
    {
        // TODO: Implement get() method.
    }

    /**
     * @param array $data
     * @return Model
     */
    public function add(array $data): Model
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
    public function removeByStuffId(int $id): void
    {
        V1Session::query()
            ->where('stuff_id', $id)
            ->delete();
    }

    /**
     * @param string $jwt
     */
    public function removeByToken(string $jwt): void
    {
        V1Session::query()
            ->where('access_token', $jwt)
            ->delete();
    }

    /**
     * @param int $id
     * @return int
     */
    public function countByStuffId(int $id): int
    {
        $count = V1Session::query()
            ->where('stuff_id', $id)
            ->count();

        return $count;
    }

    /**
     * @param string $accessToken
     * @return mixed
     */
    public function getStuffByToken(string $accessToken)
    {
        $session = V1Session::query()
            ->where('access_token', $accessToken)
            ->first();

        if (is_null($session)) {
            throw new NotFoundHttpException('Session was not found');
        }

        return $session;
    }
}
