<?php

namespace App\Api\Models;

use Illuminate\Database\Eloquent\Model;

class V1Stuff extends Model implements StuffInterface
{
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
        'role',
        'token'
    ];

    /** @var array  */
    protected $hidden = [
        'password'
    ];
}
