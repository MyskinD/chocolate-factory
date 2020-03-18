<?php

namespace App\Api\Models;

use Illuminate\Database\Eloquent\Model;

class V1Session extends Model
{
    /** @var string  */
    protected $table = 'sessions';

    /** @var array  */
    protected $fillable = [
        'stuff_id',
        'access_token',
        'refresh_token',
        'created_at',
        'updated_at'
    ];
}
