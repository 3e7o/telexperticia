<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReportUpdateRequest extends FormRequest
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
            'medical_board_id' => ['required', 'exists:medical_boards,id'],
            'record' => ['required', 'max:255', 'string'],
            'evaluation' => ['required', 'max:255', 'string'],
            'diagnosis' => ['required', 'max:255', 'string'],
            'recommendations' => ['required', 'max:255', 'string'],
        ];
    }
}
