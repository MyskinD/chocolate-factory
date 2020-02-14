<?php

namespace App\Api\Repositories;

use App\Api\Models\StuffInterface;
use App\Api\Models\V1Stuff;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class V1StuffRepository implements StuffRepositoryInterface
{
    /** @var DB  */
    protected $db;

    /**
     * V1StuffRepository constructor.
     * @param DB $db
     */
    public function __construct(DB $db)
    {
        $this->db = $db;
    }

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
    public function get(int $id)
    {
        $stuff = $this->db::table(V1Stuff::$tableName)
            ->where('id', $id)
            ->get();

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
        $stuff->role = $data['role'];
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
