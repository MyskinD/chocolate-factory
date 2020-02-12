<?php

namespace App\Api\Repositories;

use App\Api\Repositories\v1\StuffRepository;
use \Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class StuffRepositoryCreator extends RepositoryCreator
{
    /**
     * @param string $vApi
     * @return RepositoryInterface
     */
    public function get(string $vApi): RepositoryInterface
    {
        switch ($vApi) {
            case 'v1' :

                return new StuffRepository();
                break;
            default :
                throw new BadRequestHttpException('Api version not specified');
                break;
        }
    }
}
