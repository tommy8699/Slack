<?php

namespace AppUser\User\Models\old;

use October\Rain\Auth\Models\User as AuthUser;

class User extends AuthUser
{
    public $table = 'appuser_user_users';

    protected $fillable = [
        'email',
        'password',
        'name',
        'persist_code',
        'token'
    ];

    protected $hidden = [
        'password',
        'token',
        'persist_code'
    ];

    public $rules = [
        'email' => 'required|email|unique:appuser_user_users',
        'password' => 'required|min:6',
        'name' => 'required'
    ];

    protected $hashable = [
        'password'
    ];

    public function beforeCreate()
    {
        $this->token = bin2hex(random_bytes(15)); // 30-char token
        $this->persist_code = bin2hex(random_bytes(10)); // 20-char code
    }
}
