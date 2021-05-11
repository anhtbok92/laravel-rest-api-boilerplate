<?php

namespace Modules\Api\Http\Controllers;

use Illuminate\Routing\Controller;
use Symfony\Component\Console\Output\NullOutput;

class BaseApiController extends Controller
{
    public function sendSuccessResponse($code, $message, $data = null)
    {
        return response()->json([
            'code' => $code,
            'message' => $message,
            'error' => new NullOutput(),
            'data' => $data == null ? new NullOutput() : $data
        ], 200);
    }

    public function sendErrorResponse($code = 500, $message = MSG_API_006)
    {
        return response()->json([
            'code' => $code,
            'message' => $message,
            'error' => new NullOutput(),
            'data' => new NullOutput()
        ], 500);
    }
}
