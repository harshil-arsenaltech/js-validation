<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
        $validate_arrays = [
            'title'          =>  'required',
            'fullname'          =>  'required',
            'mobile_number'  =>  'required|integer',
            'email'         =>  'required|email|unique:posts,email,'
        ];
        if (in_array($this->id, $this->all())) {
            $validate_arrays['email'] = $validate_arrays['email'] . $this->id;
        }
        return $validate_arrays;
    }
}
