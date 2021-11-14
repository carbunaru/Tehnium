<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MessageRequest extends FormRequest
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
            'title' => "required|max:120|regex:/^[a-zA-Z0-9\s\.\,\-\:\;\(\)\!\?\'\&]+$/",
            'content' => 'required|max:10000'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'The title is required',
            'title.max' => 'The title must be at most 120 characters',
            'title.regex' => 'The title must contain only numbers, letters or symbols ("." , "-" , "," , ":" , ";" , "(" , ")" , "!", "&" and "?")',
            'content.required' => 'The comment is required',
            'content.max' => 'The excerpt must be at most 10000 characters'
        ];
    }
}
