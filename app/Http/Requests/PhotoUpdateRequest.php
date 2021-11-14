<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PhotoUpdateRequest extends FormRequest
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
            'title' => 'nullable|max:250',
            'description' => 'nullable|max:250',
            'position' => 'integer',
            'photo' => 'nullable|max:1024'
        ];
    }

    public function messages()
    {
        return [
            'title.max' => 'The title must be at most 250 characters!',
            'description.max' => 'The description must be at most 250 characters!',
            'position' => 'The position of the image must be an integer!',
            'photo.max' => 'The image cannot be larger than 1MB!'
        ];
    }
}
