<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PatientStoreRequest extends FormRequest
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
            'ci' => ['required', 'max:255', 'string'],
            'name' => ['required', 'max:255', 'string'],
            'first_surname' => ['required', 'max:255', 'string'],
            'last_surname' => ['required', 'max:255', 'string'],
            'email' => ['required', 'email'],
            'force' => ['required', 'max:255', 'string'],
            'birthday' => ['required', 'date', 'date'],
            'gender' => ['required', 'in:Hombre,Mujer'],
            'address' => ['required', 'max:255', 'string'],
        ];
    }
}
