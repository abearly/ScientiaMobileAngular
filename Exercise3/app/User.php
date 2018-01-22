<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\UserRepository;

class User extends Model
{
    protected $fillable = [
        'id',
        'username',
        'password',
        'name',
        'role',
        'token'
    ];

    protected $token;

    public function __construct($attributes)
    {
        parent::__construct($attributes);
    }
}
