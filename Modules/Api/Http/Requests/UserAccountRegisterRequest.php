<?php

namespace Modules\Api\Http\Requests;

class UserAccountRegisterRequest extends ApiRequest
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
        return [
            'username.required' => str_replace('{0}', 'Username', MSG_API_007),
            'password.required' => str_replace('{0}', 'Password', MSG_API_007),
        ];
    }
}
