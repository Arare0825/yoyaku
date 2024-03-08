<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MUser extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
            'hid',
            'facility_id',
            'user_id',
            'password',
            'user_type',

    ];

}
