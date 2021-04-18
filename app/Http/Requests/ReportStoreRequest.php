<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReportStoreRequest extends FormRequest
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
            'record' => ['required', 'string'],
            'evaluation' => ['required', 'string'],
            'diagnosis' => ['required', 'string'],
            'recommendations' => ['required', 'string'],
        ];
    }
}
