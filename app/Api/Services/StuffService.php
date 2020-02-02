<?php

namespace App\Api\Services;

use App\Api\Repositories\StuffRepositoryInterface;
use App\Api\Validations\StuffValidation;

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
     */
    public function createStuff(array $data)
    {
        $this->stuffValidation->validateOnCreate($data);
        $this->stuffRepository->add($data);

    }
}
