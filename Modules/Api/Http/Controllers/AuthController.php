<?php

namespace Modules\Api\Http\Controllers;

use Illuminate\Http\Request;
use JWTAuth;
use Modules\Api\Http\Requests\ApiLoginRequest;
use Modules\Api\Repositories\UserAccountRepository\UserAccountRepositoryInterface;

class AuthController extends BaseApiController
{
    public $repository;

    public function __construct(UserAccountRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function login(ApiLoginRequest $request)
    {
        $token = $this->repository->authenticate($request);
        if ($token) {
            return $this->sendSuccessResponse(200, MSG_API_012, $this->repository->getLoginResponseData($token));
        }

        return $this->sendSuccessResponse(1, MSG_API_011);
    }

    public function logout()
    {
        auth('api')->logout();
        return $this->sendSuccessResponse(200, MSG_API_013);
    }
}
