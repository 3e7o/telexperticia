<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DoctorUpdateRequest extends FormRequest
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
            'ci' => [
                'required', 
                'max:255', 
                'string',
                Rule::unique('doctors')->ignore($this->route('doctor'))
            ],
            'name' => ['required', 'max:255', 'string'],
            'first_surname' => ['required', 'max:255', 'string'],
            'last_surname' => ['required', 'max:255', 'string'],
            'email' => [
                'required', 
                'email',
                Rule::unique('doctors')->ignore($this->route('doctor'))
            ],
            'regional' => ['required', 'max:255', 'string'],
            'specialty_id' => ['required', 'exists:specialties,id'],
        ];
    }
}
