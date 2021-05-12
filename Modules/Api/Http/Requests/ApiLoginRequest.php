<?php

namespace Modules\Api\Http\Requests;

class ApiLoginRequest extends ApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'username' => ['required'],
            'password' => ['required'],
        ];
    }

    public function messages()
    {
        $username = 'username';
        $password = 'password';
        return [
            'username.required' => str_replace('{0}', $username, MSG_API_007),
            'password.required' => str_replace('{0}', $password, MSG_API_007)
        ];
    }
}
