<?php

namespace App\Api\Services\Contracts;

use App\Api\Models\V1Stuff;

interface JwtServiceInterface
{
    /**
     * @param V1Stuff $stuff
     * @return string
     */
    public function getAccessToken(V1Stuff $stuff): string;

    /**
     * @param V1Stuff $stuff
     * @return string
     */
    public function getRefreshToken(V1Stuff $stuff): string;
}
