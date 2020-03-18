<?php

namespace App\Api\Services;

use App\Api\Repositories\Contracts\StuffRepositoryInterface;
use App\Api\Services\Contracts\StuffServiceInterface;
use App\Api\Validations\StuffValidation;
use Illuminate\Database\Eloquent\Model;

class V1StuffService implements StuffServiceInterface
{
    /** @var StuffRepositoryInterface  */
    protected $stuffRepository;

    /** @var StuffValidation  */
    protected $stuffValidation;

    /**
     * V1StuffService constructor.
     * @param StuffValidation $stuffValidation
     * @param StuffRepositoryInterface $stuffRepository
     */
    public function __construct(
        StuffValidation $stuffValidation,
        StuffRepositoryInterface $stuffRepository
    ) {
        $this->stuffValidation = $stuffValidation;
        $this->stuffRepository = $stuffRepository;
    }

    /**
     * @param array $data
     * @return Model
     */
    public function create(array $data): Model
    {
        $this->stuffValidation->validateOnCreate($data);
        $data['password'] = md5($data['password']);
        $newStuff = $this->stuffRepository->add($data);

        return $newStuff;
    }

    /**
     * @param int $id
     * @return Model
     */
    public function get(int $id): Model
    {
        $stuff = $this->stuffRepository->get($id);

        return $stuff;
    }
}
