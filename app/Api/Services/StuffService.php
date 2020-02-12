<?php

namespace App\Api\Services;

use App\Api\Repositories\RepositoryInterface;
use App\Api\Repositories\StuffRepositoryCreator;
use App\Api\Validations\StuffValidation;
use App\Models\Api\v1\Stuff;
use \Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class StuffService
{
    /** @var RepositoryInterface  */
    protected $stuffRepository;

    /** @var StuffValidation  */
    protected $stuffValidation;

    /**
     * StuffService constructor.
     * @param StuffValidation $stuffValidation
     */
    public function __construct(StuffValidation $stuffValidation) {
        $this->stuffValidation = $stuffValidation;
    }

    /**
     * @param array $data
     * @param string $vApi
     * @return Stuff
     */
    public function createStuff(array $data, string $vApi): Stuff
    {
        $this->stuffRepository = (new StuffRepositoryCreator())->get($vApi);
        $this->stuffValidation->validateOnCreate($data);
        $newStuff = $this->stuffRepository->add($data);

        if (is_null($newStuff)) {
            throw new NotFoundHttpException('Stuff was not created');
        }

        return $newStuff;
    }
}
