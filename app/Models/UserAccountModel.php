<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Tymon\JWTAuth\Contracts\JWTSubject;

class UserAccountModel extends Authenticatable implements JWTSubject
{
    use HasFactory;

    protected $table = 'user_accounts';
    protected $primaryKey= 'id';

    public function getJWTIdentifier() {
        return $this->getKey();
    }

    public function getJWTCustomClaims() {
        return [];
    }

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function getBasicUserInfo() {
        return [
            'username' => $this->username
        ];
    }
}
