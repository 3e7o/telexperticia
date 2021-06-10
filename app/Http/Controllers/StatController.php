<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\MedicalBoard;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\Request;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Illuminate\Support\Facades\DB;

class StatController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', User::class);
        $data = [];
        $filter_start_date = "";
        $filter_end_date = "";
        $data["error"] = "";
        $aprobado=0;
        $noaprobado=0;
        $esp=[];
        $reg=[];
        $num=[];
        if($request->isMethod('patch')){
            $filter_start_date = $request->start_date;
            $filter_end_date = $request->end_date;        
            $medicalBoards=MedicalBoard::where('date', '>=', $filter_start_date)->where('date', '<', $filter_end_date);
            $patients=Patient::get()->count();
            $doctors=Doctor::get()->count();
            $jrealizadas=MedicalBoard::where('status', 'Realizado')->where('date', '>=', $filter_start_date)->where('date', '<', $filter_end_date)->count();
            $jprogramado=MedicalBoard::where('status', 'Programado')->where('date', '>=', $filter_start_date)->where('date', '<', $filter_end_date)->count();
            $jcancelado=MedicalBoard::where('status', 'Cancelado')->where('date', '>=', $filter_start_date)->where('date', '<', $filter_end_date)->count();
            $jexpirado=MedicalBoard::where('status', 'Reprogramar')->where('date', '>=', $filter_start_date)->where('date', '<', $filter_end_date)->count();
            foreach($medicalBoards as $medicalBoard)
            {
                $medicalBoardId = $medicalBoard->id;
                $approved = Collect(DB::table('doctor_medical_board')
                    ->where('medical_board_id', $medicalBoardId)
                    //->where('date', '>=', $filter_start_date)->where('date', '<', $filter_end_date)
                    ->pluck('approved'));
                $total = $approved->count();
                $sum = $approved->sum();
                $total === $sum ? $aprobado++ : $noaprobado++;
            }
            $especialistas= DB::table('medical_boards')->where('date', '>=', $filter_start_date)->where('date', '<', $filter_end_date)->pluck('doctor_id');
            foreach($especialistas as $especilista)
            {
                $especilidad=Doctor::find($especilista);
                $esp[]=$especilidad->specialty->name;
            }
    
            $especialidades=array_count_values($esp);
    
            $chart = (new LarapexChart)->donutChart()
                ->setSubtitle('Total: '.$medicalBoards->count())
                ->setDataset([$jrealizadas, $jprogramado, $jcancelado, $jexpirado])
                ->setColors(['#7ee5e5', '#4d8af0','#f77eb9','#fbbc06'])
                ->setHeight(400)
                ->setWidth(330)
                ->setToolbar(true)
                ->setLabels(['Realizadas', 'Programadas', 'Canceladas', 'Reprogramar']);
                $doctor_pacientes=DB::table('medical_boards')->where('date', '>=', $filter_start_date)->where('date', '<', $filter_end_date)
                ->join('doctors', 'doctors.id', '=', 'medical_boards.doctor_id')
                ->join('patients', 'patients.id', '=', 'medical_boards.patient_id')
                ->join('specialties', 'specialties.id', '=', 'doctors.specialty_id')
                ->select('medical_boards.date','doctors.first_surname','doctors.last_surname', 'doctors.regional', 'specialties.name', 'patients.user_id', 'patients.mat_beneficiario', 'medical_boards.status')
                ->get();

                $pacientes_juntas=DB::table('medical_boards')->where('date', '>=', $filter_start_date)->where('date', '<', $filter_end_date)
                ->join('patients', 'patients.id', '=', 'medical_boards.patient_id')
                ->select('patients.name','patients.first_surname','patients.last_surname', 'patients.mat_beneficiario',  'medical_boards.date')
                ->get();

                $regionales=Doctor::get();
                foreach($regionales as $doctor)
                {
                $reg[]=$doctor->regional;
                }

                $regionales=array_count_values($reg);

                $pacientes_numeros= DB::table('medical_boards')->where('date', '>=', $filter_start_date)->where('date', '<', $filter_end_date)->pluck('patient_id');
                foreach($pacientes_numeros as $paciente_numero)
                {
                $numero_paciente=Patient::find($paciente_numero);
                $num[]=$numero_paciente->mat_beneficiario;
                }

                $paciente_conts=array_count_values($num);

                $data["filter_start_date"] = $filter_start_date;
                $data["filter_end_date"] = $filter_end_date;
                return view('app.stats.index', compact('paciente_conts','pacientes_juntas','regionales','especialidades','chart', 'patients','doctors','jrealizadas','jprogramado','jcancelado','jexpirado','aprobado','noaprobado','doctor_pacientes'),$data);
        }
        $medicalBoards=MedicalBoard::get();
        $patients=Patient::get()->count();
        $doctors=Doctor::get()->count();
        $jrealizadas=MedicalBoard::where('status', 'Realizado')->count();
        $jprogramado=MedicalBoard::where('status', 'Programado')->count();
        $jcancelado=MedicalBoard::where('status', 'Cancelado')->count();
        $jexpirado=MedicalBoard::where('status', 'Reprogramar')->count();
        foreach($medicalBoards as $medicalBoard)
        {
            $medicalBoardId = $medicalBoard->id;
            $approved = Collect(DB::table('doctor_medical_board')
                ->where('medical_board_id', $medicalBoardId)
                ->pluck('approved'));
            $total = $approved->count();
            $sum = $approved->sum();
            $total === $sum ? $aprobado++ : $noaprobado++;
        }
        $especialistas= DB::table('medical_boards')->pluck('doctor_id');
        foreach($especialistas as $especilista)
        {
            $especilidad=Doctor::find($especilista);
            $esp[]=$especilidad->specialty->name;
        }

        $especialidades=array_count_values($esp);
       
        $chart = (new LarapexChart)->donutChart()
            ->setSubtitle('Total: '.$medicalBoards->count())
            ->setDataset([$jrealizadas, $jprogramado, $jcancelado, $jexpirado])
            ->setColors(['#7ee5e5', '#4d8af0','#f77eb9','#fbbc06'])
            ->setHeight(400)
            ->setWidth(330)
            ->setToolbar(true)
            ->setLabels(['Realizadas', 'Programadas', 'Canceladas', 'Reprogramar']);

        $doctor_pacientes=DB::table('medical_boards')
                                ->join('doctors', 'doctors.id', '=', 'medical_boards.doctor_id')
                                ->join('patients', 'patients.id', '=', 'medical_boards.patient_id')
                                ->join('specialties', 'specialties.id', '=', 'doctors.specialty_id')
                                ->select('medical_boards.date','doctors.first_surname','doctors.last_surname', 'doctors.regional', 'specialties.name', 'patients.user_id', 'patients.mat_beneficiario', 'medical_boards.status')
                                ->get();
        
        $pacientes_juntas=DB::table('medical_boards')
        ->join('patients', 'patients.id', '=', 'medical_boards.patient_id')
        ->select('patients.name','patients.first_surname','patients.last_surname', 'patients.mat_beneficiario',  'medical_boards.date')
        ->get();

        $regionales=Doctor::get();
        foreach($regionales as $doctor)
        {
            $reg[]=$doctor->regional;
        }

        $regionales=array_count_values($reg);

        $pacientes_numeros= DB::table('medical_boards')->pluck('patient_id');
        foreach($pacientes_numeros as $paciente_numero)
        {
            $numero_paciente=Patient::find($paciente_numero);
            $num[]=$numero_paciente->mat_beneficiario;
        }

        $paciente_conts=array_count_values($num);

        $data["filter_start_date"] = $filter_start_date;
        $data["filter_end_date"] = $filter_end_date;
        return view('app.stats.index', compact('paciente_conts','pacientes_juntas','regionales','especialidades','chart', 'patients','doctors','jrealizadas','jprogramado','jcancelado','jexpirado','aprobado','noaprobado','doctor_pacientes'),$data);

    }

    public function download(Request $request)
    {
        $this->authorize('view-any', User::class);
        $data = [];
        $filter_start_date = "";
        $filter_end_date = "";
        $data["error"] = "";
        $aprobado=0;
        $noaprobado=0;
        $esp=[];
        if($request->isMethod('patch')){
            $filter_start_date = $request->start_date;
            $filter_end_date = $request->end_date;        
            $medicalBoards=MedicalBoard::where('date', '>=', $filter_start_date)->where('date', '<', $filter_end_date);
            $patients=Patient::get()->count();
            $doctors=Doctor::get()->count();
            $jrealizadas=MedicalBoard::where('status', 'Realizado')->where('date', '>=', $filter_start_date)->where('date', '<', $filter_end_date)->count();
            $jprogramado=MedicalBoard::where('status', 'Programado')->where('date', '>=', $filter_start_date)->where('date', '<', $filter_end_date)->count();
            $jcancelado=MedicalBoard::where('status', 'Cancelado')->where('date', '>=', $filter_start_date)->where('date', '<', $filter_end_date)->count();
            $jexpirado=MedicalBoard::where('status', 'Reprogramar')->where('date', '>=', $filter_start_date)->where('date', '<', $filter_end_date)->count();
            foreach($medicalBoards as $medicalBoard)
            {
                $medicalBoardId = $medicalBoard->id;
                $approved = Collect(DB::table('doctor_medical_board')
                    ->where('medical_board_id', $medicalBoardId)
                    //->where('date', '>=', $filter_start_date)->where('date', '<', $filter_end_date)
                    ->pluck('approved'));
                $total = $approved->count();
                $sum = $approved->sum();
                $total === $sum ? $aprobado++ : $noaprobado++;
            }
            $especialistas= DB::table('doctor_medical_board')->pluck('doctor_id');
            foreach($especialistas as $especilista)
            {
                $especilidad=Doctor::find($especilista);
                $esp[]=$especilidad->specialty->name;
            }
    
            $especialidades=array_count_values($esp);
    
            $chart = (new LarapexChart)->donutChart()
                ->setSubtitle('Total: '.$medicalBoards->count())
                ->setDataset([$jrealizadas, $jprogramado, $jcancelado, $jexpirado])
                ->setColors(['#7ee5e5', '#4d8af0','#f77eb9','#fbbc06'])
                ->setHeight(400)
                ->setWidth(330)
                ->setToolbar(true)
                ->setLabels(['Realizadas', 'Programadas', 'Canceladas', 'Reprogramar']);
            $data["filter_start_date"] = $filter_start_date;
            $data["filter_end_date"] = $filter_end_date;
            return \PDF::loadView('reports.stat-pdf', compact('especialidades','chart', 'patients','doctors','jrealizadas','jprogramado','jcancelado','jexpirado','aprobado','noaprobado'))
            ->setPaper('a4')
            ->stream($fileName);
        }
        $medicalBoards=MedicalBoard::get();
        $patients=Patient::get()->count();
        $doctors=Doctor::get()->count();
        $jrealizadas=MedicalBoard::where('status', 'Realizado')->count();
        $jprogramado=MedicalBoard::where('status', 'Programado')->count();
        $jcancelado=MedicalBoard::where('status', 'Cancelado')->count();
        $jexpirado=MedicalBoard::where('status', 'Reprogramar')->count();
        foreach($medicalBoards as $medicalBoard)
        {
            $medicalBoardId = $medicalBoard->id;
            $approved = Collect(DB::table('doctor_medical_board')
                ->where('medical_board_id', $medicalBoardId)
                ->pluck('approved'));
            $total = $approved->count();
            $sum = $approved->sum();
            $total === $sum ? $aprobado++ : $noaprobado++;
        }
        $especialistas= DB::table('doctor_medical_board')->pluck('doctor_id');
        foreach($especialistas as $especilista)
        {
            $especilidad=Doctor::find($especilista);
            $esp[]=$especilidad->specialty->name;
        }

        $especialidades=array_count_values($esp);

        $chart = (new LarapexChart)->donutChart()
            ->setSubtitle('Total: '.$medicalBoards->count())
            ->setDataset([$jrealizadas, $jprogramado, $jcancelado, $jexpirado])
            ->setColors(['#7ee5e5', '#4d8af0','#f77eb9','#fbbc06'])
            ->setHeight(400)
            ->setWidth(330)
            ->setToolbar(true)
            ->setLabels(['Realizadas', 'Programadas', 'Canceladas', 'Reprogramar']);

        $data["filter_start_date"] = $filter_start_date;
        $data["filter_end_date"] = $filter_end_date;
        $fileName = 'Reporte - '.'.pdf';
        return \PDF::loadView('reports.stat-pdf', compact('especialidades','chart', 'patients','doctors','jrealizadas','jprogramado','jcancelado','jexpirado','aprobado','noaprobado'))
            ->setPaper('a4')
            ->stream($fileName);
//            ->download($fileName);
    }

}
