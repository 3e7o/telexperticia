<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Patient;
use App\Models\MedicalBoard;
use Illuminate\Http\Request;
use App\Http\Requests\MedicalBoardStoreRequest;
use App\Http\Requests\MedicalBoardUpdateRequest;

class MedicalBoardController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', MedicalBoard::class);

        $search = $request->get('search', '');

        $medicalBoards = MedicalBoard::query()
            ->itIsAuthorized()
            ->groupBy('id')
            ->orderBy('medical_boards.id', 'DESC')
            ->select('medical_boards.*')
            ->paginate(0);

        $medicalBoards = MedicalBoard::search($search)
           ->latest()
           ->paginate(0);


        return view(
            'app.medical_boards.index',
            compact('medicalBoards', 'search')
        );
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create(Request $request)
    {
        $this->authorize('create', MedicalBoard::class);

        $patients = Patient::select('id', 'name', 'first_surname')->get()->pluck('fullName', 'id');

        $doctors = Doctor::select('id', 'name', 'first_surname', 'specialty_id')->get()->pluck('fullName', 'id');

        $doctorsSelected = [];

        return view('app.medical_boards.create', compact('patients', 'doctors', 'doctorsSelected'));
    }

    /**
     * @param \App\Http\Requests\MedicalBoardStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(MedicalBoardStoreRequest $request)
    {
        $this->authorize('create', MedicalBoard::class);

        $validated = $request->validated();

        $doctorsSelected = explode(',', $validated['doctors_id'][0]);

        $someDoctorIsNotAvailable = $this->validateDoctorsAvailable($validated, $doctorsSelected);
        if ($someDoctorIsNotAvailable['areNotAvailabe']) {
            return back()
                ->with(compact('doctorsSelected'))
                ->withInput()
                ->withError("El Doctor {$someDoctorIsNotAvailable['name']} no esta disponible para el horario de esta junta.");
        }

        $medicalBoard = MedicalBoard::create($validated);
        $medicalBoard->doctorsSupervisors()->sync($doctorsSelected);

        return redirect()
            ->route('medical-boards.edit', $medicalBoard)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\MedicalBoard $medicalBoard
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, MedicalBoard $medicalBoard)
    {
        $this->authorize('view', $medicalBoard);

        $doctorsSupervisors = $medicalBoard->doctorsSupervisors->map( function ($doctor) {
            return $doctor->fullName;
        })->implode(', ') . '.';

        return view('app.medical_boards.show', compact('medicalBoard', 'doctorsSupervisors'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\MedicalBoard $medicalBoard
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(Request $request, MedicalBoard $medicalBoard)
    {
        $this->authorize('update', $medicalBoard);

        $patients = Patient::select('id', 'name', 'first_surname')->get()->pluck('fullName', 'id');

        $doctors = Doctor::select('id', 'name', 'first_surname', 'specialty_id')->get()->pluck('fullName', 'id');

        $doctorsSelected = $medicalBoard->doctorsSupervisors->pluck('id')->toArray();

        return view(
            'app.medical_boards.edit',
            compact('medicalBoard', 'patients', 'doctors', 'doctorsSelected')
        );
    }

    /**
     * @param \App\Http\Requests\MedicalBoardUpdateRequest $request
     * @param \App\Models\MedicalBoard $medicalBoard
     * @return \Illuminate\Http\Response
     */
    public function update(
        MedicalBoardUpdateRequest $request,
        MedicalBoard $medicalBoard
    ) {
        $this->authorize('update', $medicalBoard);

        $validated = $request->validated();

        $doctorsSelected = explode(',', $validated['doctors_id'][0]);

        $someDoctorIsNotAvailable = $this->validateDoctorsAvailable($validated, $doctorsSelected, $medicalBoard->id);

        if ($someDoctorIsNotAvailable['areNotAvailabe']) {
            return back()
                ->with(compact('doctorsSelected'))
                ->withInput()
                ->withError("El Doctor {$someDoctorIsNotAvailable['name']} no esta disponible para el horario de esta junta.");
        }

        $medicalBoard->update($validated);

        $medicalBoard->doctorsSupervisors()->sync($doctorsSelected);

        return redirect()
            ->route('medical-boards.edit', $medicalBoard)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\MedicalBoard $medicalBoard
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, MedicalBoard $medicalBoard)
    {
        $this->authorize('delete', $medicalBoard);

        $medicalBoard->delete();

        return redirect()
            ->route('medical-boards.index')
            ->withSuccess(__('crud.common.removed'));
    }
    protected function validateDoctorsAvailable($validated, $doctorsSelected, $medicalBoardId = null)
    {
        $doctors_id = array_merge([$validated['doctor_id']], $doctorsSelected);

        $date = $validated['date'];

        return MedicalBoard::areDoctorsAvailable($doctors_id, $date, $medicalBoardId);
    }
}
