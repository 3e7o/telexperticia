<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\GroupParameter;
use App\Models\Parameter;
use Illuminate\Http\Request;
use App\Http\Requests\PatientStoreRequest;
use App\Http\Requests\PatientUpdateRequest;
use App\Models\User;
use Illuminate\Support\Str;
class PatientController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Patient::class);

        $patients = Patient::get();
        //borrar
        foreach($patients as $patient){
            $username=$patient->birthday->format('ymd').Str::substr($patient->first_surname, 0, 1).Str::substr($patient->last_surname, 0, 1).Str::substr($patient->name, 0, 1);
            $patient->update(['mat_beneficiario'=>$username]);
            $user=User::find($patient->user_id);
            $user->update(['username'=>$username]);
        //borrar
        }

        return view('app.patients.index', compact('patients'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Patient::class);
        $genders = Parameter::select('name')->where("group_id","=",2)->get();
        $tipo_users = Parameter::select('name')->where("group_id","=",8)->get();
        return view('app.patients.create',compact('genders','tipo_users'));
    }

    /**
     * @param \App\Http\Requests\PatientStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PatientStoreRequest $request)
    {
        $this->authorize('create', Patient::class);

        $validated = $request->validated();

        $patient = Patient::create($validated);
        $username=$patient->birthday->format('ymd').Str::substr($patient->first_surname, 0, 1).Str::substr($patient->last_surname, 0, 1).Str::substr($patient->name, 0, 1);
        $patient->update(['mat_beneficiario'=>$username]);
        $user=User::find($patient->user_id);
        $user->update(['username'=>$username]);
        return redirect()->route('patients.edit', $patient)->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Patient $patient
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Patient $patient)
    {
        $this->authorize('view', $patient);

        return view('app.patients.show', compact('patient'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Patient $patient
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Patient $patient)
    {
        $this->authorize('update', $patient);
        $genders = Parameter::select('name')->where("group_id","=",2)->get();
        $tipo_users = Parameter::select('name')->where("group_id","=",8)->get();
        return view('app.patients.edit', compact('patient', 'genders','tipo_users'));
    }

    /**
     * @param \App\Http\Requests\PatientUpdateRequest $request
     * @param \App\Models\Patient $patient
     * @return \Illuminate\Http\Response
     */
    public function update(PatientUpdateRequest $request, Patient $patient)
    {
        $this->authorize('update', $patient);

        $validated = $request->validated();

        $patient->update($validated);

        return redirect()->route('patients.index')->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Patient $patient
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Patient $patient)
    {
        $this->authorize('delete', $patient);

        $patient->delete();

        return redirect()
            ->route('patients.index')
            ->withSuccess(__('crud.common.removed'));
    }
    public function activity_log($log_details, $fn){
        $ac = new ActiveController();
        $ac->saveLogData(auth()->user()->id, $log_details, 'PatientController', $fn);
    }
}
