<?php

namespace App\Api\Services;

use App\Api\Models\Contracts\StuffInterface;
use App\Api\Repositories\Contracts\RepositoryInterface;
use App\Api\Services\Contracts\StuffServiceInterface;
use App\Api\Validations\StuffValidation;
use \Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class V1StuffService implements StuffServiceInterface
{
    /** @var RepositoryInterface  */
    protected $stuffRepository;

    /** @var StuffValidation  */
    protected $stuffValidation;

    /**
     * StuffService constructor.
     * @param StuffValidation $stuffValidation
     * @param RepositoryInterface $stuffRepository
     */
    public function __construct(
        StuffValidation $stuffValidation,
        RepositoryInterface $stuffRepository
    ) {
        $this->stuffValidation = $stuffValidation;
        $this->stuffRepository = $stuffRepository;
    }

    /**
     * @param array $data
     * @return StuffInterface
     */
    public function create(array $data): StuffInterface
    {
        $this->stuffValidation->validateOnCreate($data);
        $data['password'] = md5($data['password']);
        $newStuff = $this->stuffRepository->add($data);

        if (is_null($newStuff)) {
            throw new NotFoundHttpException('Stuff was not created');
        }

        return $newStuff;
    }

    /**
     * @param int $id
     * @return StuffInterface
     */
    public function get(int $id): StuffInterface
    {
        $stuff = $this->stuffRepository->get($id);

        return $stuff;
    }
}
