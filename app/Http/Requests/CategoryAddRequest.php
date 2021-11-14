<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryAddRequest extends FormRequest
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
            'title' => 'required|max:50|regex:/^[a-zA-Z0-9\s\.\,\-\:\;\(\)\!\?]+$/',
            'subtitle' => 'required|max:255|regex:/^[a-zA-Z0-9\s\.\,\-\:\;\(\)\!\?]+$/',
            'slug' => 'required|max:255',
            'excerpt' => 'max:6000',
            'view' => 'required|numeric|min:0',

            'meta_title' => 'max:255||regex:/^[a-zA-Z0-9\s\.\,\-\:\;\(\)\!\?]+$/',
            'meta_description' => 'max:255|regex:/^[a-zA-Z0-9\s\.\,\-\:\;\(\)\!\?]+$/',
            'meta_keywords' => 'max:255|regex:/^[a-zA-Z0-9\s\.\,\-\:\;\(\)\!\?]+$/',
            
            'photo' => 'max:1024'
            
        ];
    }

    public function messages()
{
    return [
        'title.required' => 'The title is required',
        'title.max' => 'The title must be at most 50 characters',
        'title.regex' => 'The title must contain only numbers, letters or symbols ("." , "-" , "," , ":" , ";" , "(" , ")" , "!" and "?")',
        'subtitle.required' => 'The subtitle is required',
        'subtitle.max' => 'The subtitle must be at most 255 characters',
        'subtitle.regex' => 'The subtitle must contain only numbers, letters or symbols ("." , "-" , "," , ":" , ";" , "(" , ")" , "!" and "?")',
        'slug.max' => 'The slug must be at most 255 characters',
        'slug.required' => 'The slug is required',
        'excerpt.max' => 'The excerpt must be at most 6000 characters',
        'excerpt.regex' => 'The excerpt must contain only numbers, letters or symbols ("." , "-" , "," , ":" , ";" , "(" , ")" , "!" and "?")',
        'meta_title.max' => 'The meta title must be at most 255 characters',
        'meta_description.max' => 'The meta description must be at most 255 characters',
        'meta_keywords.max' => 'The meta keywords must be at most 255 characters',
        'meta_title.regex' => 'The meta title must contain only numbers, letters or symbols ("." , "-" , "," , ":" , ";" , "(" , ")" , "!" and "?")',
        'meta_description.regex' => 'The meta description must contain only numbers, letters or symbols ("." , "-" , "," , ":" , ";" , "(" , ")" , "!" and "?")',
        'meta_keywords.regex' => 'The meta keywords must contain only numbers, letters or symbols ("." , "-" , "," , ":" , ";" , "(" , ")" , "!" and "?")',
        'view.required' => 'The number of views is required',
        'view.min' => 'The number of views must be greater than or equal to 0',
        'view.numeric' => 'It is necessary to fill in a number',
    ];
}
}
