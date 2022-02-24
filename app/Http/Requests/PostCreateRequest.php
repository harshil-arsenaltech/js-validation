<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostCreateRequest extends FormRequest
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
            "name" => 'required',
            "introduction" => 'required',
            "location" => 'required',
            "Cost" => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Please Enter Name',
            'introduction.required' => 'Please Enter Introduction',
            'location.required' => 'Please Enter Location',
            'Cost.required' => 'Please Enter Cost',
        ];
    }
}
