<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminLoginRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * @return \string[][]
     */
    public function rules()
    {
        return [
            "email" => ["required", "email", "string"],
            "password" => ["required"],
        ];
    }

    /**
     * @return string[]
     */
    public function messages()
    {
        return [
            "email.required" => "The Email field is required.",
            "email.email" => "Please enter a valid email address.",
            "password.required" => "The Password field is required.",
        ];
    }
}
