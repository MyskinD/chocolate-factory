<?php

namespace App\Api\Services;

use App\Api\Repositories\StuffRepositoryInterface;
use App\Api\Validations\StuffValidation;
use App\Models\Stuff;
use \Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class StuffService
{
    /** @var StuffRepositoryInterface  */
    protected $stuffRepository;

    /** @var StuffValidation  */
    protected $stuffValidation;

    /**
     * StuffService constructor.
     * @param StuffRepositoryInterface $stuffRepository
     * @param StuffValidation $stuffValidation
     */
    public function __construct(
        StuffRepositoryInterface $stuffRepository,
        StuffValidation $stuffValidation
    ) {
        $this->stuffRepository = $stuffRepository;
        $this->stuffValidation = $stuffValidation;
    }

    /**
     * @param array $data
     * @return Stuff
     */
    public function createStuff(array $data): Stuff
    {
        $this->stuffValidation->validateOnCreate($data);
        $newStuff = $this->stuffRepository->add($data);

        if (is_null($newStuff)) {
            throw new NotFoundHttpException('Stuff was not created');
        }

        return $newStuff;
    }
}
