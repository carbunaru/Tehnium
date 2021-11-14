<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class createUserRequest extends FormRequest
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
            'name' => 'required|max:50|regex:/^[a-zA-Z\s]+$/',
            'email' => 'required|email|unique:users,email',
            'address' => 'max:120|regex:/^[a-zA-Z0-9\s\.\,\-]+$/',
            'phone' => 'max:30|regex:/^\s*(?:\+?(\d{1,3}))?[-. (]*(\d{3})[-. )]*(\d{3})[-. ]*(\d{4})(?: *x(\d+))?\s*$/',
            'role' => 'required',
            'password' => 'required|min:8|confirmed|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})/',
            'password_confirmation' => 'required',
            'photo' => 'image|max:1024'
            
            
        ];
    }
    public function messages()
{
    return [
        'name.required' => 'The name is required',
        'name.max' => 'The name must be at most 50 characters',
        'name.regex' => 'The name must contain uppercase and lowercase letters',
        'email.required' => 'The email is required',
        'email.email' => 'The email must be a valid email address',
        'email.unique' => 'The email address must be unique',
        'address.max' => 'The address must be at most 120 characters',
        'address.regex' => 'The address must contain only numbers, letters or symbols ("." , "-"  and  ","):  ',
        'phone.max' => 'The name must be at most 30 characters',
        'phone.regex' => 'The phone number must contain only numbers',
        'role.required' => 'The role is required',
        'password.required' => 'The password is required',
        'password.min' => 'The password must be at least 8 characters',
        'password.regex' => 'The password must contain at least 1 upper case letter, at least 1 lower case letter, at least 1 number and special character',
        'password_confirmation.required' => 'The password confirmed is required',
        'password.confirmed' => 'The passwords must match',
        'photo.uploaded' => 'The image maximum size is 1MB',
        'photo.image' => 'The type of the uploaded file should be an image'
    ];
}
}
