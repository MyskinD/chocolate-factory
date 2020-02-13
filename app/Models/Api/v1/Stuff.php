<?php

namespace App\Models\Api\v1;

use Illuminate\Database\Eloquent\Model;

class Stuff extends Model
{
    const GUEST    = 0;
    const WORKER   = 1;
    const MANAGER  = 2;
    const DIRECTOR = 3;

    /** @var string  */
    protected $table = 'stuffs';

    /** @var string  */
    public static $tableName = 'stuffs';

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
