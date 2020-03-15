<?php

namespace App\Api\Repositories\Contracts;

use Illuminate\Database\Eloquent\Model;

interface SessionRepositoryInterface
{
    /**
     * @return mixed
     */
    public function all();

    /**
     * @param int $id
     * @return mixed
     */
    public function get(int $id);

    /**
     * @param array $data
     * @return mixed
     */
    public function add(array $data): Model;

    /**
     * @param int $id
     * @param array $data
     * @return mixed
     */
    public function save(int $id, array $data);

    /**
     * @param int $id
     */
    public function removeByStuffId(int $id): void;

    /**
     * @param string $jwt
     */
    public function removeByJwt(string $jwt): void;

    /**
     * @param int $id
     * @return int
     */
    public function countByStuffId(int $id): int;

    /**
     * @param string|null $jwt
     * @return mixed
     */
    public function getStuffByToken(string $jwt = null);
}
