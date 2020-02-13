<?php

namespace App\Api\Services;

use App\Api\Repositories\StuffRepositoryInterface;
use App\Api\Validations\StuffValidation;
use App\Models\Api\v1\Stuff;
use \Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class V1StuffService implements StuffServiceInterface
{
    /** @var StuffRepositoryInterface  */
    protected $stuffRepository;

    /** @var StuffValidation  */
    protected $stuffValidation;

    /**
     * StuffService constructor.
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
     * @return Stuff
     */
    public function create(array $data): Stuff
    {
        $this->stuffValidation->validateOnCreate($data);
        $newStuff = $this->stuffRepository->add($data);

        if (is_null($newStuff)) {
            throw new NotFoundHttpException('Stuff was not created');
        }

        return $newStuff;
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function get(int $id)
    {
        $stuff = $this->stuffRepository->get($id);

        return $stuff;
    }
}
