<?php

namespace App\Api\Repositories;

use App\Models\Api\v1\Stuff;

interface StuffRepositoryInterface
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
    public function add(array $data): Stuff;

    /**
     * @param int $id
     * @param array $data
     * @return mixed
     */
    public function save(int $id, array $data);

    /**
     * @param int $id
     * @return mixed
     */
    public function remove(int $id);
}
