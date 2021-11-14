<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required|max:50|regex:/^[a-zA-Z\s]+$/',
            'email' => 'required|email',
            'address' => 'max:120|regex:/^[a-zA-Z0-9\s\.\,\-]+$/',
            'phone' => 'max:30|regex:/^\s*(?:\+?(\d{1,3}))?[-. (]*(\d{3})[-. )]*(\d{3})[-. ]*(\d{4})(?: *x(\d+))?\s*$/',
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
        'address.max' => 'The address must be at most 120 characters',
        'address.regex' => 'The address must contain only numbers, letters or symbols ("." , "-"  and  ","):  ',
        'phone.max' => 'The name must be at most 30 characters',
        'phone.regex' => 'The phone number must contain only numbers',
        'photo.uploaded' => 'The image maximum size is 1MB',
        'photo.image' => 'The type of the uploaded file should be an image'
    ];
}
}

