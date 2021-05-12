<?php

namespace Modules\Api\Repositories\UserAccountRepository;

use App\Models\UserAccountModel;

interface UserAccountRepositoryInterface
{
    public function authenticate($request);

    public function getUserAccountByID($id);

    public function checkAccountExistByEmail($email);

    public function registerNewAccount($request);

    public function getLoginResponseData($token);
}
