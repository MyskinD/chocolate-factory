<?php

namespace App\Api\Repositories;

use Illuminate\Support\Facades\DB;

class StuffRepository implements StuffRepositoryInterface
{
    protected $db;

    public function __construct(DB $db)
    {
        $this->db = $db;
    }

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
     */
    public function add(array $data):void
    {
        $this->db::table('stuffs')->insert([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => $data['password']
        ]);
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