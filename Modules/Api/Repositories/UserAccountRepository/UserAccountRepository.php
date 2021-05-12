<?php

namespace Modules\Api\Repositories\UserAccountRepository;

use App\Models\UserAccountModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use JWTAuth;

class UserAccountRepository implements UserAccountRepositoryInterface
{
    protected $model;

    public function __construct(UserAccountModel $model)
    {
        $this->model = $model;
    }

    public function authenticate($request)
    {
        return Auth::guard('api')->attempt(["username" => $request->username, "password" => $request->password]);
    }

    public function getUserAccountByID($id)
    {
        return UserAccountModel::find($id);
    }

    public function checkAccountExistByEmail($username)
    {
        return UserAccountModel::where('username', $username)->first();
    }

    public function registerNewAccount($request)
    {
        $account = new UserAccountModel();
        $account->username = $request->username;
        $account->password = Hash::make($request->password);
        if (!$account->save()) {
            return false;
        }

        if (!$account->save()) {
            $account->delete();
            return false;
        }

        return true;

    }

    public function getLoginResponseData($token)
    {
        $userInfo = auth('api')->user()->getBasicUserInfo();
        return [
            'access_token' => $token,
            'user' => $userInfo
        ];
    }
}

