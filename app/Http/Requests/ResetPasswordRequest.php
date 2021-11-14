<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ResetPasswordRequest extends FormRequest
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
            'password_old' => 'required|min:8',
            'password_new' => 'required|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})/',
            'password_confirmation' => 'required|same:password_new'
        ];
    }

    public function messages()
    {

        return [
       
        'password_old.required' => 'The password is required',
        'password_new.required' => 'The password is required',
        'password_old.min' => 'The password must be at least 8 characters',
        'password_new.min' => 'The password must be at least 8 characters',
        'password_old.regex' => 'The password must contain at least 1 upper case letter, at least 1 lower case letter, at least 1 number and special character',
        //'password_new.regex' => 'The password must contain at least 1 upper case letter, at least 1 lower case letter, at least 1 number and special character',
        'password_confirmation.required' => 'The password confirmed is required',
        'password_confirmation.same' => 'The passwords must match'
        
    ];
}
}
