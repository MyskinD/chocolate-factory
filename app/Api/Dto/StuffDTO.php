<?php

namespace App\Api\Dto;

use App\Api\Dto\Contracts\DtoInterface;

class StuffDTO implements DtoInterface
{
    /** @var int */
    public $id;

    /** @var string */
    public $role;
}
