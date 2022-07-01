<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'  =>      "required",
            'email' =>      "required",
            'password'  =>  "required",
            'type'      =>  "required"
        ];
    }

    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required'             => 'Name is required!',
            'email.required'            => 'Email is required!',
            'password.required'         => 'Password is required!',
            'type.required'             => 'Type is required!',
        ];
    }
}
