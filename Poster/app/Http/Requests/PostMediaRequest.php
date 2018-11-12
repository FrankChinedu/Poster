<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostMediaRequest extends FormRequest
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
            'file' => 'required|mimes:jpeg,png,jpg,bmp,gif,svg,mp4|max:10000'
        ];  
    }

    public function messages()
    {
        return [
            'file.required' => 'Text is required!',
            'file.mimes' => 'Must be type of video or picture!',
        ];
    }
}
