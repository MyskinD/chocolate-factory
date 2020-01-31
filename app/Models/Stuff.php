<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stuff extends Model
{
    protected $table = 'stuffs';

    protected $fillable = [
        'first_name',
        'last_name',
        'password',
        'email',
        'created_at',
        'updated_at'
    ];
}
