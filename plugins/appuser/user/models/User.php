<?php

namespace Appuser\User\Models;

use Model;

/**
 * User Model
 *
 * @link https://docs.octobercms.com/3.x/extend/system/models.html
 */
class User extends Model
{
    use \October\Rain\Database\Traits\Validation;

    /**
     * @var string table name
     */
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

    /**
     * @var array rules for validation
     */
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
        $this->token = bin2hex(random_bytes(30)); // 30-char token
        $this->persist_code = bin2hex(random_bytes(10)); // 20-char code
    }
}
