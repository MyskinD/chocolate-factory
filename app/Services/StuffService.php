<?php

namespace App\Services;


use App\Http\Repositories\StuffRepository;

class StuffService
{
    /** @var StuffRepository  */
    protected $stuffRepository;

    /**
     * StuffService constructor.
     * @param StuffRepository $stuffRepository
     */
    public function __construct(StuffRepository $stuffRepository)
    {
        $this->stuffRepository = $stuffRepository;
    }

    public function createStuff()
    {

    }

    /**
     * @param int $id
     * @return \Illuminate\Support\Collection|mixed
     */
    public function getStuff(int $id)
    {
        $stuff = $this->stuffRepository->get($id);

        return $stuff;
    }
}