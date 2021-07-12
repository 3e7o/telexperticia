<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class MedicalBoardStoreRequest extends FormRequest
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
            'date' => 'required|after_or_equal:today',
            'patient_id' => ['required', 'exists:patients,id'],
            'doctor_id' => ['required', 'exists:doctors,id'],
            'doctors_id' => ['required'],
            'status' => ['required', 'in:Programado,Confirmado,Cancelado,Reprogramar'],
            'open_zoom' => ['required', 'in:1,0'],
        ];
    }
}
