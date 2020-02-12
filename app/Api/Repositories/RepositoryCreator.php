<?php

namespace App\Api\Repositories;

abstract class RepositoryCreator
{
    abstract public function get(string $vApi): RepositoryInterface;
}