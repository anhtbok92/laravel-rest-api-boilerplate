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
            'email' => ['required'],
            'password' => ['required'],
            'family_name' => ['required'],
            'first_name' => ['required'],
        ];
    }

    public function messages()
    {
        $password = 'password';

        return [
            'email.required' => str_replace('{0}', 'mail address', MSG_API_007),
            'password.required' => str_replace('{0}', $password, MSG_API_007),
            'family_name.required' => str_replace('{0}', 'family name', MSG_API_007),
            'first_name.required' => str_replace('{0}', 'first name', MSG_API_007),
        ];
    }
}
