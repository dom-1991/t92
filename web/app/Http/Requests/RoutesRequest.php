<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoutesRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name_frontend' => 'required|unique:routes|max:50',
            'name_backend' => 'required|unique:routes|max:50',
            'title' => 'required|max:50'
        ];
    }
}
