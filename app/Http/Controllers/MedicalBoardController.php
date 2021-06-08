<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Patient;
use App\Models\MedicalBoard;
use Illuminate\Http\Request;
use App\Http\Requests\MedicalBoardStoreRequest;
use App\Http\Requests\MedicalBoardUpdateRequest;
use App\Models\Report;
use App\Policies\MedicalBoardPolicy;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MedicalBoardController extends Controller
{
    protected $zoom_user;
    private $generalsetting;

    public function __construct()
    {
        $zoom = new \MacsiDigital\Zoom\Support\Entry;
        $this->zoom_user = new \MacsiDigital\Zoom\User($zoom);
        $this->generalsetting = \App\Models\GeneralSetting::first();
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->activity_log("Listar Juntas Medicas", "medical_boards.index");
        $this->authorize('view-any', MedicalBoard::class);

        $medicalBoards = MedicalBoard::query()
            ->itIsAuthorized()
            ->groupBy('id')
            ->orderBy('medical_boards.id', 'DESC')
            ->get();

            foreach($medicalBoards as $medicalBoard){
                $medicalBoardId = $medicalBoard->id;
                $approved = Collect(DB::table('doctor_medical_board')
                    ->where('medical_board_id', $medicalBoardId)
                    ->pluck('approved'));
                $total = $approved->count();
                $sum = $approved->sum();

                $status = $total === $sum ? 'Aprobado' : 'No aprobado';
                if($status =='Aprobado')
                {
                    $medicalBoard->update(['status'=>'Realizado']);
                }
                if((isset(($medicalBoard->zoom)->start_time)) and $medicalBoard->status == 'Programado' and ((\Carbon\Carbon::parse(($medicalBoard->zoom)->start_time))) < \Carbon\Carbon::now())
                {
                    $medicalBoard->update(['status'=>'Expirado']);
                }
             }


        return view(
            'app.medical_boards.index',
            compact('medicalBoards')
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
        $open_zoom = $request->open_zoom;

        $patients = Patient::select('id', 'user_id')->get()->pluck('fullName', 'id');

        $doctors = Doctor::select('id', 'user_id', 'specialty_id')->get()->pluck('fullName', 'id');

        $doctorsSelected = [];

        if($open_zoom=='1'){

        $zoom = $this->zoom_user->find($this->generalsetting->zoom_email);
        }
        $this->activity_log("Formulario Junta Medica", "medical_boards.create");
        return view('app.medical_boards.create', compact('patients', 'doctors', 'doctorsSelected'));
    }

    /**
     * @param \App\Http\Requests\MedicalBoardStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(MedicalBoardStoreRequest $request)
    {
        $this->authorize('store', MedicalBoard::class);

        $validated = $request->validated();

        $open_zoom = $request->open_zoom;

        $doctorsSelected = $request->doctors_id;

        $someDoctorIsNotAvailable = $this->validateDoctorsAvailable($validated, $doctorsSelected);
        if ($someDoctorIsNotAvailable['areNotAvailabe']) {
            return back()
                ->with(compact('doctorsSelected'))
                ->withInput()
                ->withError("El Doctor {$someDoctorIsNotAvailable['name']} no esta disponible para el horario de esta junta.");
        }

        $medicalBoard = MedicalBoard::create($validated);
        $medicalBoard->doctorsSupervisors()->sync($doctorsSelected);

        $zoom_data = $medicalBoard->zoom;
        if($open_zoom=='1'){
            $startTime = $medicalBoard->date;
            $date = Carbon::parse($startTime)->format('Y-m-d');
            $time = Carbon::parse($startTime)->format('H:i');
            $datetime = $date.'T'.$time.'Z';

            $zoom = $this->zoom_user->find($this->generalsetting->zoom_email);
            if(!$zoom_data){
                $meeting = $zoom->meetings()->create(array(
                    'topic'         => $request->name,
                    'start_time'    => $datetime,
                    'duration'      => $request->zoom_duration,
                    'timezone'      => env('APP_TIMEZONE')
                ));
                if($meeting){
                    $meetingId = $meeting->id;
                    $medicalBoard->zoom()->create(array(
                        'zoom_id'       => $meetingId,
                        'start_time'    => date('Y-m-d H:i', strtotime($medicalBoard->date)),
                        'duration'      => $request->zoom_duration,
                        'password'      => $meeting->password,
                        'timezone'      => $meeting->timezone,
                        "start_url"     => $meeting->start_url,
                        "join_url"      => $meeting->join_url,
                    ));
                }
            }
        }
        /// end zoom ///
        $this->activity_log("Almacenar Junta Medica", "medical_boards.store");
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

        $zoom_data = $medicalBoard->zoom;

        $doctorsSupervisors = $medicalBoard->doctorsSupervisors->map( function ($doctor) {
            return $doctor->fullName;
        })->implode(', ') . '.';
        $this->activity_log("Ver Junta Medica", "medical_boards.show");
        return view('app.medical_boards.show', compact('medicalBoard', 'doctorsSupervisors','zoom_data'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\MedicalBoard $medicalBoard
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(Request $request, MedicalBoard $medicalBoard)
    {
        $this->authorize('update', $medicalBoard);

        $zoom = $this->zoom_user->find($this->generalsetting->zoom_email);

        $zoom_data = $medicalBoard->zoom;

        $patients = Patient::select('id', 'user_id')->get()->pluck('fullName', 'id');

        $doctors = Doctor::select('id', 'user_id', 'specialty_id')->get()->pluck('fullName', 'id');

        $doctorsSelected = $medicalBoard->doctorsSupervisors->pluck('id')->toArray();
        $this->activity_log("Editar Junta Medica", "medical_boards.edit");
        return view(
            'app.medical_boards.edit',
            compact('medicalBoard', 'patients', 'doctors', 'doctorsSelected','zoom','zoom_data')
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

        $open_zoom = $request->open_zoom;

        $doctorsSelected = $request->doctors_id;

        $someDoctorIsNotAvailable = $this->validateDoctorsAvailable($validated, $doctorsSelected, $medicalBoard->id);

        if ($someDoctorIsNotAvailable['areNotAvailabe']) {
            return back()
                ->with(compact('doctorsSelected'))
                ->withInput()
                ->withError("El Doctor {$someDoctorIsNotAvailable['name']} no esta disponible para el horario de esta junta.");
        }
        $medicalBoard->update($validated);

        $medicalBoard->doctorsSupervisors()->sync($doctorsSelected);

                     /// zoom ///
                $zoom_data = $medicalBoard->zoom;
                if($open_zoom=='1'){
                    $startTime = $medicalBoard->date;
                    $date = Carbon::parse($startTime)->format('Y-m-d');
                    $time = Carbon::parse($startTime)->format('H:i:s');
                    $datetime = $date.'T'.$time.'Z';

                    $zoom = $this->zoom_user->find($this->generalsetting->zoom_email);
                    if($zoom_data){
                        $zoomMeeting = $zoom->meetings()->find($zoom_data->zoom_id);

                        $meeting = $zoomMeeting->update(array(
                            'topic'         => $request->name,
                            'start_time'    => $datetime,
                            'duration'      => $request->zoom_duration,
                            'timezone'      => env('APP_TIMEZONE'),
                        ));
                        if($zoomMeeting){
                            $medicalBoard->zoom()->update(array(
                                'start_time' => $meeting->start_time,
                                'duration'   => $request->zoom_duration,
                            ));
                        }
                    }else{
                        $meeting = $zoom->meetings()->create(array(
                            'topic'         => $request->name,
                            'start_time'    => $datetime,
                            'duration'      => $request->zoom_duration,
                            'timezone'      => env('APP_TIMEZONE'),
                        ));
                        if($meeting){
                            $meetingId = $meeting->id;
                            $medicalBoard->zoom()->create(array(
                                'zoom_id'       => $meetingId,
                                'start_time'    => date('Y-m-d H:i', strtotime($request->zoom_start_time)),
                                'duration'      => $request->zoom_duration,
                                'password'      => $meeting->password,
                                'timezone'      => $meeting->timezone,
                                "start_url"     => $meeting->start_url,
                                "join_url"      => $meeting->join_url,
                            ));
                        }
                    }
                }else{
                    if($zoom_data){
                        $medicalBoard->zoom()->delete();
                        //$zoomMeeting = $this->zoom_user->find($zoom_data->zoom_id);
                        $zoom = $this->zoom_user->find($this->generalsetting->zoom_email);
                        $zoomMeeting = $zoom->meetings()->find($zoom_data->zoom_id);
                        if($zoomMeeting){
                        $zoomMeeting->delete();
                        }
                    }
                }
        /// end zoom ///
        $this->activity_log("Actulizar Junta Medica", "medical_boards.update");
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

        $medicalBoard_id=$medicalBoard->id;
        $zoom_data = $medicalBoard->zoom;
        if($zoom_data){
                $medicalBoard->zoom()->delete();
                $zoom = $this->zoom_user->find($this->generalsetting->zoom_email);
                $zoomMeeting = $zoom->meetings()->find($zoom_data->zoom_id);
                if($zoomMeeting){
                   $zoomMeeting->delete();
                }
            }
        MedicalBoard::where('id', $medicalBoard_id)->delete();


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
    public function activity_log($log_details, $fn){
        $ac = new ActiveController();
        $ac->saveLogData(Auth::user()->id, $log_details, 'MedicalBoardController', $fn);
    }
}
