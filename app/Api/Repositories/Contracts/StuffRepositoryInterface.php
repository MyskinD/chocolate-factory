<?php

namespace App\Api\Repositories\Contracts;

use Illuminate\Database\Eloquent\Model;

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
    public function add(array $data);

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
    public function remove(int $id): void;

    /**
     * @param string $email
     * @param string $password
     * @return mixed
     */
    public function getStuffByEmailAndPassword(string $email, string $password);
}
