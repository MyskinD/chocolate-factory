<?php

namespace App\Api\Models;

use Illuminate\Database\Eloquent\Model;

class V1Stuff extends Model
{
    const GUEST    = 0;
    const WORKER   = 1;
    const MANAGER  = 2;
    const DIRECTOR = 3;

    /** @var string  */
    protected $table = 'stuffs';

    /** @var array  */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'created_at',
        'updated_at',
        'role'
    ];

    /** @var array  */
    protected $hidden = [
        'password'
    ];
}
