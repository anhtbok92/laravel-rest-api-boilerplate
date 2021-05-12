<?php

namespace Modules\Api\Http\Controllers;

use Modules\Api\Http\Requests\ApiLoginRequest;
use Modules\Api\Http\Requests\UserAccountRegisterRequest;
use Modules\Api\Repositories\UserAccountRepository\UserAccountRepositoryInterface;

class UserAccountRegisterController extends BaseApiController
{

    protected $userAccountRepo;
    public function __construct(UserAccountRepositoryInterface $repository)
    {
        $this->userAccountRepo = $repository;
    }

    public function registerNewUser(UserAccountRegisterRequest $request)
    {
        if ($this->userAccountRepo->checkAccountExistByEmail($request->username)) {
            return $this->sendSuccessResponse(3, MSG_API_008);
        }

        if (!$this->userAccountRepo->registerNewAccount($request)) {
            return $this->sendErrorResponse(500, MSG_API_009);
        }

        $request['username'] = $request->username;

        $loginRequest = new ApiLoginRequest();
        $loginRequest['username'] = $request->username;
        $loginRequest['password'] = $request->password;
        if ($token = $this->userAccountRepo->authenticate($loginRequest)) {
            return $this->sendSuccessResponse(200, MSG_API_010);
        }

        return $this->sendSuccessResponse(1, MSG_API_011);
    }
}
