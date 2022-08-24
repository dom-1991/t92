<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmailRequest extends FormRequest
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
            'email' => 'required|unique:newsletter|email',
            'title' => 'required|max:50',
            'content' => 'required|max:300',
        ];
    }

    public function messages(){
        return [
            'email' => 'The :attribute field must be an email',
            'required' => 'The :attribute field is required',
            'unique:newsletter' => 'The :attribute field must be unique',
            'max:50' => 'The :attribute maximum is 50 character',
            'max:300' => 'The :attribute maximum is 300 character'
        ];
    }
}
