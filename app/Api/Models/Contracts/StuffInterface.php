<?php

namespace App\Api\Models\Contracts;

interface StuffInterface
{
    const GUEST    = 0;
    const WORKER   = 1;
    const MANAGER  = 2;
    const DIRECTOR = 3;
}
