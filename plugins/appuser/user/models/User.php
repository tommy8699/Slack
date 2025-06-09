<?php

namespace Appuser\User\Models;

use Illuminate\Support\Facades\Hash;
use October\Rain\Database\Model;
use Illuminate\Support\Str;

/**
 * User Model
 *
 * @link https://docs.octobercms.com/3.x/extend/system/models.html
 */
class User extends Model
{
    use \October\Rain\Database\Traits\Hashable;

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
        $plainToken = Str::random(60);
        $this->token = Hash::make($plainToken); // 30-char token
    }
}
