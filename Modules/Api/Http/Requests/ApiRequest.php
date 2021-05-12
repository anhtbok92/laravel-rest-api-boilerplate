<?php

namespace Modules\Api\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Symfony\Component\Console\Output\NullOutput;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

class ApiRequest extends FormRequest
{
    protected function failedValidation(Validator $validator)
    {
        $errors = [];
        $errorMessages = [];
        foreach ($validator->errors()->messages() as $key => $value ) {
            $errorMessages[$key] = $value[0];
        }

        $errors['url'] = URL::current();
        $errors['method'] = Route::getCurrentRoute()->getActionName();
        $errors['client_requests'] = $this->all();
        $errors['errors'] = $errorMessages;
        Log::error("API_BAD_REQUEST: ");
        Log::error(print_r($errors, true));
        $response = new JsonResponse([
            'code' => 202,
            'message' => MSG_API_006,
            'error' => $errorMessages,
            'data' => new NullOutput()
        ],202);
        throw new ValidationException($validator, $response);
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
