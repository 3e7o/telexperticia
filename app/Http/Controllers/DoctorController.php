<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Specialty;
use Illuminate\Http\Request;
use App\Http\Requests\DoctorStoreRequest;
use App\Http\Requests\DoctorUpdateRequest;
use App\Models\Parameter;
use Illuminate\Support\Facades\Storage;

class DoctorController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Doctor::class);

        $doctors = Doctor::get();
        $this->activity_log("Vista de lista de medicos", "doctors.index");
        return view('app.doctors.index', compact('doctors'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Doctor::class);

        $specialties = Specialty::pluck('name', 'id');
        $regionals = Parameter::select('name')->where("group_id","=",7)->get();
        $this->activity_log("Formulario creear usuario medico", "doctors.create");
        return view('app.doctors.create', compact('specialties','regionals'));
    }

    /**
     * @param \App\Http\Requests\DoctorStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(DoctorStoreRequest $request)
    {
        $this->authorize('create', Doctor::class);

        $validated = $request->validated();

        $doctor = Doctor::create($validated);

        if ($request->hasFile('signature')){
            $url=Storage::disk('public')->put('images', $request->file("signature"));
            $doctor->signature =  "storage/".$url;
        }
        $doctor->save();
        $this->activity_log("Almacenar usuario medico", "doctors.store");
        return redirect()->route('doctors.index')->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Doctor $doctor
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Doctor $doctor)
    {
        $this->authorize('view', $doctor);
        $this->activity_log("Visualizar usuario medico", "doctors.show");
        return view('app.doctors.show', compact('doctor'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Doctor $doctor
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Doctor $doctor)
    {
        $this->authorize('update', $doctor);

        $specialties = Specialty::pluck('name', 'id');
        $regionals = Parameter::select('name')->where("group_id","=",7)->get();
        $this->activity_log("Editar usuario medico", "doctors.edit");
        return view('app.doctors.edit', compact('doctor', 'specialties', 'regionals'));
    }

    /**
     * @param \App\Http\Requests\DoctorUpdateRequest $request
     * @param \App\Models\Doctor $doctor
     * @return \Illuminate\Http\Response
     */
    public function update(DoctorUpdateRequest $request, Doctor $doctor)
    {
        $this->authorize('update', $doctor);

        $validated = $request->validated();

        $doctor->update($validated);

         if ($request->hasFile('signature')){
            $url=Storage::disk('public')->put('images', $request->file("signature"));
            $doctor->signature = "storage/".$url;
        }

        $doctor->save();
        $this->activity_log("Actualizar usuario medico", "doctors.update");
        return redirect()
            ->route('doctors.edit', $doctor)
            ->withSuccess(__('crud.common.saved'));
        }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Doctor $doctor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Doctor $doctor)
    {
        $this->authorize('delete', $doctor);

        $doctor->delete();

        return redirect()
            ->route('doctors.index')
            ->withSuccess(__('crud.common.removed'));
    }
    public function activity_log($log_details, $fn){
        $ac = new ActiveController();
        $ac->saveLogData(auth()->user()->id, $log_details, 'DoctorController', $fn);
    }
}
