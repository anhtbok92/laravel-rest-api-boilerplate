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
        return Auth::guard('api')->attempt(["mail_address" => $request->username, "password" => $request->password]);
    }

    public function getUserAccountByID($id)
    {
        return UserAccountModel::find($id);
    }

    public function checkAccountExistByEmail($email)
    {
        return UserAccountModel::where('mail_address', $email)->first();
    }

    public function registerNewAccount($request)
    {
        // dd($request->all());
        $account = new UserAccountModel();
        $account->mail_address = $request->email;
        $account->password = Hash::make($request->password);
        $account->family_name = $request->family_name;
        $account->first_name = $request->first_name;
        if (!$account->save()) {
            return false;
        }

        if (!$account->save()) {
            $account->delete();
            return false;
        }

        return true;

    }
}

