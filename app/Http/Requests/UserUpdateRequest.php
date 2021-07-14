<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends FormRequest
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
            'name' => ['required', 'max:255', 'string'],
            'username' => [
                'required', 
                'max:255', 
                'string',
                
                Rule::unique('users')->ignore($this->route('user'))
            ],
            'email' => [
                'required', 
                'email',
                Rule::unique('users')->ignore($this->route('user'))
            ],
            'roles' => 'array',
            'password' => 'nullable'
        ];
    }
}
