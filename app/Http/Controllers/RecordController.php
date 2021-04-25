<?php

namespace App\Http\Controllers;

use App\Http\Requests\RecordStoreRequest;
use App\Http\Requests\RecordUpdateRequest;
use App\Models\Doctor;
use App\Models\Parameter;
use App\Models\Patient;
use App\Models\Record;
use Illuminate\Http\Request;

class RecordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', RecordController::class);

        $patients = Patient::select('id', 'name', 'first_surname')->get()->pluck('fullName', 'id');

        $doctors = Doctor::select('id', 'name', 'first_surname', 'specialty_id')->get()->pluck('fullName', 'id');

        $allergies = Parameter::select('id','name')->where("group_id","=",5)->get();

        $vaccines = Parameter::select('id','name')->where("group_id","=",3)->get();

        $operations = Parameter::select('id','name')->where("group_id","=",4)->get();

        $blood_types = Parameter::select('id','name')->where("group_id","=",1)->get();

        return view('app.records.create', compact('patients', 'doctors', 'allergies', 'vaccines', 'operations', 'blood_types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RecordStoreRequest $request)
    {
        $this->authorize('create', Record::class);

        $validated = $request->validated();

        $allergiesSelected = $request->allergies;
        $vaccinesSelected = $request->vaccines;
        $operationsSelected = $request->operations;

        $record = Record::create($validated);
        $record->recordAllergies()->sync($allergiesSelected);
        $record->recordVaccines()->sync($vaccinesSelected);
        $record->recordOperations()->sync($operationsSelected);

        return redirect()->route('records.edit', $record)->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Record $record)
    {
        $this->authorize('view', $record);

        $selectedAllergies = $record->recordAllergies;
        $selectedVaccines = $record->recordVaccines;
        $selectedOperations = $record->recordOperations;

        return view('app.records.show', compact('record', 'doctorsSupervisors'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Record $record
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(Request $request, Record $record)
    {
        $patients = Patient::select('id', 'name', 'first_surname')->get()->pluck('fullName', 'id');

        $doctors = Doctor::select('id', 'name', 'first_surname', 'specialty_id')->get()->pluck('fullName', 'id');

        $allergies = Parameter::select('id','name')->where("group_id","=",5)->get();

        $vaccines = Parameter::select('id','name')->where("group_id","=",3)->get();

        $operations = Parameter::select('id','name')->where("group_id","=",4)->get();

        $blood_types = Parameter::select('id','name')->where("group_id","=",1)->get();

        $selectedAllergies = $record->recordAllergies->pluck('id')->toArray();
        $selectedVaccines = $record->recordVaccines->pluck('id')->toArray();
        $selectedOperations = $record->recordOperations->pluck('id')->toArray();

        return view('app.records.edit', compact('record', 'patients', 'doctors', 'allergies', 'vaccines', 'operations', 'blood_types', 'selectedAllergies','selectedVaccines','selectedOperations'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RecordUpdateRequest $request, Record $record)
    {
        $this->authorize('update', $record);

        $validated = $request->validated();

        $allergiesSelected = Parameter::find($request->allergies) ;
        $vaccinesSelected = Parameter::find($request->vaccines);
        $operationsSelected = $request->operations;

        $record->update($validated);

        $record->recordAllergies()->sync($allergiesSelected);
        $record->recordVaccines()->sync($vaccinesSelected);
        $record->recordOperations()->sync($operationsSelected);

        return redirect()->route('records.edit', $record)->withSuccess(__('crud.common.saved'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
