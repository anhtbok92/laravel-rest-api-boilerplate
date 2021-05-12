<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class MaxCharRule implements Rule
{
    private $attributeName;
    private $maxLength;
    private $message;

    public function __construct($attributeName, $maxLength, $message = null)
    {
        $this->attributeName = $attributeName;
        $this->maxLength = $maxLength;
        $this->message = !empty($message) ? $message : MSG_API_014;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return mb_strwidth($value) <= $this->maxLength;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return str_replace(['{0}', '{1}', '{2}'], [$this->attributeName, $this->maxLength, $this->maxLength / 2 ], $this->message);
    }
}
