<?php

namespace App\Models\Api\v1;

use Illuminate\Database\Eloquent\Model;

class Stuff extends Model
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
    ];

    /** @var array  */
    protected $hidden = [
        'password'
    ];
}
