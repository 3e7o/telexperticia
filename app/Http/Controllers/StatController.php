<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\MedicalBoard;
use App\Models\Patient;
use App\Models\Report;
use App\Models\User;
use Illuminate\Http\Request;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Barryvdh\DomPDF\PDF;
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
            $medicalBoards=MedicalBoard::where('date', '>=', $filter_start_date)->where('date', '<', $filter_end_date)->get();
            $patients=Patient::get()->count();
            $doctors=Doctor::get()->count();
            $jrealizadas=MedicalBoard::where('status', 'Confirmado')->where('date', '>=', $filter_start_date)->where('date', '<', $filter_end_date)->count();
            $juntas_realizadas=MedicalBoard::join('doctors', 'doctors.id', '=', 'medical_boards.doctor_id')->where('date', '>=', $filter_start_date)->where('date', '<', $filter_end_date)->where('status', 'Confirmado')->get();
            $jprogramado=MedicalBoard::where('status', 'Programado')->where('date', '>=', $filter_start_date)->where('date', '<', $filter_end_date)->count();
            $juntas_programado=MedicalBoard::join('doctors', 'doctors.id', '=', 'medical_boards.doctor_id')->where('date', '>=', $filter_start_date)->where('date', '<', $filter_end_date)->where('status', 'Programado')->get();
            $jcancelado=MedicalBoard::where('status', 'Cancelado')->where('date', '>=', $filter_start_date)->where('date', '<', $filter_end_date)->count();
            $juntas_cancelado=MedicalBoard::join('doctors', 'doctors.id', '=', 'medical_boards.doctor_id')->where('date', '>=', $filter_start_date)->where('date', '<', $filter_end_date)->where('status', 'Cancelado')->get();
            $jexpirado=MedicalBoard::where('status', 'Reprogramar')->where('date', '>=', $filter_start_date)->where('date', '<', $filter_end_date)->count();
            $juntas_expirado=MedicalBoard::join('doctors', 'doctors.id', '=', 'medical_boards.doctor_id')->where('date', '>=', $filter_start_date)->where('date', '<', $filter_end_date)->where('status', 'Reprogramar')->get();
            foreach($medicalBoards as $medicalBoard)
            {
                $medicalBoardId = $medicalBoard->id;
                $approved = Collect(DB::table('doctor_medical_board')
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
    
            $chart_especialidad = app()->chartjs
            ->name('barChartEsp')
            ->type('bar')
            ->size(['width' => 400, 'height' => 200])
            ->labels(array_keys($especialidades))
            ->datasets([
                [
                    "label" => "",
                    'backgroundColor' => ['#7ACFF5', '#FFDD80', '#E09BCD', '#7889FE', '#82C0E9', '#FF6384','#2980B9','#16A085','#F1948A','#BB8FCE','#E59866','#73C6B6','#8C3949','#39635B','#9CADB1','#B1009C'],
                    'data' => array_values($especialidades)
                ]
            ])
            ->optionsRaw([
                'legend' => [
                    'display' => true,
                    'labels' => false
                ],
                'scales' => [
                    'xAxes' => [
                        [
                            'stacked' => true,
                            'gridLines' => [
                                'display' => true
                            ]
                        ]
                    ]
                ]
            ]);
    
            $chart_total = (new LarapexChart)
                ->setTitle('Total: '.$medicalBoards->count())
                //->setSubtitle('Total: '.$medicalBoards->count())
                ->setDataset([$jrealizadas, $jprogramado, $jcancelado, $jexpirado])
                ->setWidth(400)
                ->setToolbar(true)
                ->setLabels(['Realizadas', 'Programadas', 'Canceladas', 'Reprogramar']);
    
    
            //Doctores y pacientes atendidos
            $doctor_pacientes=DB::table('medical_boards')
                                    ->join('doctors', 'doctors.id', '=', 'medical_boards.doctor_id')
                                    ->join('patients', 'patients.id', '=', 'medical_boards.patient_id')
                                    ->join('specialties', 'specialties.id', '=', 'doctors.specialty_id')
                                    ->where('date', '>=', $filter_start_date)->where('date', '<', $filter_end_date)
                                    ->select('medical_boards.date','doctors.id','doctors.first_surname','doctors.last_surname', 'doctors.regional', 'specialties.name', 'patients.user_id', 'patients.mat_beneficiario', 'medical_boards.status')
                                    ->get();
    
            foreach($doctor_pacientes as $doctor_paciente)
            {
                $numero_junta=Doctor::find($doctor_paciente->id);
                $numero[]=$numero_junta->fullName;
            }
    
            $medico_numero=array_count_values($numero);
            
            $pacientes_juntas=DB::table('medical_boards')
            ->join('patients', 'patients.id', '=', 'medical_boards.patient_id')
            ->where('date', '>=', $filter_start_date)->where('date', '<', $filter_end_date)
            ->select('patients.name','patients.first_surname','patients.last_surname', 'patients.mat_beneficiario',  'medical_boards.date','patients.gender')
            ->get();
            foreach($pacientes_juntas as $genero)
            {
                $generos[]=$genero->gender;
            }
    
            $gender=array_count_values($generos);
            $chart_gender = (new LarapexChart)->pieChart()
                ->setTitle('Total Pacientes: '.$pacientes_juntas->count())
                ->setDataset(array_values($gender))
                ->setWidth(300)
                ->setToolbar(true)
                ->setLabels(array_keys($gender));
    
            $regionales=$doctor_pacientes;
            foreach($regionales as $doctor)
            {
                $reg[]=$doctor->regional;
            }
    
            $regionales=array_count_values($reg);
            $chart_reg = app()->chartjs
            ->name('barChartTest')
            ->type('bar')
            ->size(['width' => 400, 'height' => 200])
            ->labels(array_keys($regionales))
            ->datasets([
                [
                    "label" => "",
                    'backgroundColor' => ['#7ACFF5', '#FFDD80', '#E09BCD', '#7889FE', '#82C0E9', '#FF6384','#2980B9','#16A085','#F1948A','#BB8FCE','#E59866','#73C6B6','#8C3949','#39635B','#9CADB1','#B1009C'],
                    'data' => array_values($regionales)
                ]
            ])
            ->optionsRaw([
                'legend' => [
                    'display' => true,
                    'labels' => false
                ],
                'scales' => [
                    'xAxes' => [
                        [
                            'stacked' => true,
                            'gridLines' => [
                                'display' => true
                            ]
                        ]
                    ]
                ]
            ]);
    
            $pacientes_numeros= DB::table('medical_boards')->where('date', '>=', $filter_start_date)->where('date', '<', $filter_end_date)->pluck('patient_id');
            foreach($pacientes_numeros as $paciente_numero)
            {
                $numero_paciente=Patient::find($paciente_numero);
                $num[]=$numero_paciente->mat_beneficiario;
            }
    
            $paciente_conts=array_count_values($num);
    
            $reports = Report::join('medical_boards', 'medical_boards.id', '=', 'reports.medical_board_id')
            ->join('doctors', 'doctors.id', '=', 'medical_boards.doctor_id')
            ->groupBy('reports.medical_board_id')
            ->orderBy('reports.medical_board_id', 'DESC')
            ->where('date', '>=', $filter_start_date)->where('date', '<', $filter_end_date)
            ->get();
    
            $data["filter_start_date"] = $filter_start_date;
            $data["filter_end_date"] = $filter_end_date;
            return view('app.stats.index', compact(
                'paciente_conts',
                'chart_gender',
                'medico_numero',
                'pacientes_juntas',
                'regionales',
                'especialidades',
                'chart_total',
                'chart_reg',
                'chart_especialidad',
                'patients',
                'doctors',
                'jrealizadas',
                'jprogramado',
                'jcancelado',
                'jexpirado',
                'aprobado',
                'noaprobado',
                'doctor_pacientes',
                'juntas_realizadas',
                'juntas_programado',
                'juntas_cancelado',
                'juntas_expirado',
                'reports'
            ),$data);
        }
        $medicalBoards=MedicalBoard::get();
        $patients=Patient::get()->count();
        $doctors=Doctor::get()->count();
        $jrealizadas=MedicalBoard::where('status', 'Confirmado')->count();
        $juntas_realizadas=MedicalBoard::join('doctors', 'doctors.id', '=', 'medical_boards.doctor_id')->where('status', 'Confirmado')->get();
        $jprogramado=MedicalBoard::where('status', 'Programado')->count();
        $juntas_programado=MedicalBoard::join('doctors', 'doctors.id', '=', 'medical_boards.doctor_id')->where('status', 'Programado')->get();
        $jcancelado=MedicalBoard::where('status', 'Cancelado')->count();
        $juntas_cancelado=MedicalBoard::join('doctors', 'doctors.id', '=', 'medical_boards.doctor_id')->where('status', 'Cancelado')->get();
        $jexpirado=MedicalBoard::where('status', 'Reprogramar')->count();
        $juntas_expirado=MedicalBoard::join('doctors', 'doctors.id', '=', 'medical_boards.doctor_id')->where('status', 'Reprogramar')->get();
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

        $chart_especialidad = app()->chartjs
        ->name('barChartEsp')
        ->type('bar')
        ->size(['width' => 400, 'height' => 200])
        ->labels(array_keys($especialidades))
        ->datasets([
            [
                "label" => "",
                'backgroundColor' => ['#7ACFF5', '#FFDD80', '#E09BCD', '#7889FE', '#82C0E9', '#FF6384','#2980B9','#16A085','#F1948A','#BB8FCE','#E59866','#73C6B6','#8C3949','#39635B','#9CADB1','#B1009C'],
                'data' => array_values($especialidades)
            ]
        ])
        ->optionsRaw([
            'legend' => [
                'display' => true,
                'labels' => false
            ],
            'scales' => [
                'xAxes' => [
                    [
                        'stacked' => true,
                        'gridLines' => [
                            'display' => true
                        ]
                    ]
                ]
            ]
        ]);

        $chart_total = (new LarapexChart)
            ->setTitle('Total: '.$medicalBoards->count())
            //->setSubtitle('Total: '.$medicalBoards->count())
            ->setDataset([$jrealizadas, $jprogramado, $jcancelado, $jexpirado])
            ->setWidth(400)
            ->setToolbar(true)
            ->setLabels(['Realizadas', 'Programadas', 'Canceladas', 'Reprogramar']);


        //Doctores y pacientes atendidos
        $doctor_pacientes=DB::table('medical_boards')
                                ->join('doctors', 'doctors.id', '=', 'medical_boards.doctor_id')
                                ->join('patients', 'patients.id', '=', 'medical_boards.patient_id')
                                ->join('specialties', 'specialties.id', '=', 'doctors.specialty_id')
                                ->select('medical_boards.date','doctors.id','doctors.first_surname','doctors.last_surname', 'doctors.regional', 'specialties.name', 'patients.user_id', 'patients.mat_beneficiario', 'medical_boards.status')
                                ->get();

        foreach($doctor_pacientes as $doctor_paciente)
        {
            $numero_junta=Doctor::find($doctor_paciente->id);
            $numero[]=$numero_junta->fullName;
        }

        $medico_numero=array_count_values($numero);
        
        $pacientes_juntas=DB::table('medical_boards')
        ->join('patients', 'patients.id', '=', 'medical_boards.patient_id')
        ->select('patients.name','patients.first_surname','patients.last_surname', 'patients.mat_beneficiario',  'medical_boards.date','patients.gender')
        ->get();
        foreach($pacientes_juntas as $genero)
        {
            $generos[]=$genero->gender;
        }

        $gender=array_count_values($generos);
        $chart_gender = (new LarapexChart)->pieChart()
            ->setTitle('Total Pacientes: '.$pacientes_juntas->count())
            ->setDataset(array_values($gender))
            ->setWidth(300)
            ->setToolbar(true)
            ->setLabels(array_keys($gender));

        $regionales=$doctor_pacientes;
        foreach($regionales as $doctor)
        {
            $reg[]=$doctor->regional;
        }

        $regionales=array_count_values($reg);
        $chart_reg = app()->chartjs
        ->name('barChartTest')
        ->type('bar')
        ->size(['width' => 400, 'height' => 200])
        ->labels(array_keys($regionales))
        ->datasets([
            [
                "label" => "",
                'backgroundColor' => ['#7ACFF5', '#FFDD80', '#E09BCD', '#7889FE', '#82C0E9', '#FF6384','#2980B9','#16A085','#F1948A','#BB8FCE','#E59866','#73C6B6','#8C3949','#39635B','#9CADB1','#B1009C'],
                'data' => array_values($regionales)
            ]
        ])
        ->optionsRaw([
            'legend' => [
                'display' => true,
                'labels' => false
            ],
            'scales' => [
                'xAxes' => [
                    [
                        'stacked' => true,
                        'gridLines' => [
                            'display' => true
                        ]
                    ]
                ]
            ]
        ]);

        $pacientes_numeros= DB::table('medical_boards')->pluck('patient_id');
        foreach($pacientes_numeros as $paciente_numero)
        {
            $numero_paciente=Patient::find($paciente_numero);
            $num[]=$numero_paciente->mat_beneficiario;
        }

        $paciente_conts=array_count_values($num);

        $reports = Report::join('medical_boards', 'medical_boards.id', '=', 'reports.medical_board_id')
        ->join('doctors', 'doctors.id', '=', 'medical_boards.doctor_id')
        ->groupBy('reports.medical_board_id')
        ->orderBy('reports.medical_board_id', 'DESC')
        ->get();

        $data["filter_start_date"] = $filter_start_date;
        $data["filter_end_date"] = $filter_end_date;
        return view('app.stats.index', compact(
            'paciente_conts',
            'chart_gender',
            'medico_numero',
            'pacientes_juntas',
            'regionales',
            'especialidades',
            'chart_total',
            'chart_reg',
            'chart_especialidad',
            'patients',
            'doctors',
            'jrealizadas',
            'jprogramado',
            'jcancelado',
            'jexpirado',
            'aprobado',
            'noaprobado',
            'doctor_pacientes',
            'juntas_realizadas',
            'juntas_programado',
            'juntas_cancelado',
            'juntas_expirado',
            'reports'
        ),$data);

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
        $reg=[];
        $num=[];
        if(empty($request->start_date) && empty($request->end_date)){
            $medicalBoards=MedicalBoard::get();
            $patients=Patient::get()->count();
            $doctors=Doctor::get()->count();
            $jrealizadas=MedicalBoard::where('status', 'Confirmado')->count();
            $juntas_realizadas=MedicalBoard::join('doctors', 'doctors.id', '=', 'medical_boards.doctor_id')->where('status', 'Confirmado')->get();
            $jprogramado=MedicalBoard::where('status', 'Programado')->count();
            $juntas_programado=MedicalBoard::join('doctors', 'doctors.id', '=', 'medical_boards.doctor_id')->where('status', 'Programado')->get();
            $jcancelado=MedicalBoard::where('status', 'Cancelado')->count();
            $juntas_cancelado=MedicalBoard::join('doctors', 'doctors.id', '=', 'medical_boards.doctor_id')->where('status', 'Cancelado')->get();
            $jexpirado=MedicalBoard::where('status', 'Reprogramar')->count();
            $juntas_expirado=MedicalBoard::join('doctors', 'doctors.id', '=', 'medical_boards.doctor_id')->where('status', 'Reprogramar')->get();
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
            $esp_keys=implode("','", (array_keys($especialidades)));
            $esp_val=implode(",", (array_values($especialidades)));
    
            $chart_especialidad = app()->chartjs
            ->name('barChartEsp')
            ->type('bar')
            ->size(['width' => 400, 'height' => 200])
            ->labels(array_keys($especialidades))
            ->datasets([
                [
                    "label" => "",
                    'backgroundColor' => ['#7ACFF5', '#FFDD80', '#E09BCD', '#7889FE', '#82C0E9', '#FF6384','#2980B9','#16A085','#F1948A','#BB8FCE','#E59866','#73C6B6','#8C3949','#39635B','#9CADB1','#B1009C'],
                    'data' => array_values($especialidades)
                ]
            ])
            ->optionsRaw([
                'legend' => [
                    'display' => true,
                    'labels' => false
                ],
                'scales' => [
                    'xAxes' => [
                        [
                            'stacked' => true,
                            'gridLines' => [
                                'display' => true
                            ]
                        ]
                    ]
                ]
            ]);
    
            $chart_total = (new LarapexChart)
                ->setTitle('Total: '.$medicalBoards->count())
                //->setSubtitle('Total: '.$medicalBoards->count())
                ->setDataset([$jrealizadas, $jprogramado, $jcancelado, $jexpirado])
                ->setWidth(400)
                ->setToolbar(true)
                ->setLabels(['Realizadas', 'Programadas', 'Canceladas', 'Reprogramar']);
    
    
            //Doctores y pacientes atendidos
            $doctor_pacientes=DB::table('medical_boards')
                                    ->join('doctors', 'doctors.id', '=', 'medical_boards.doctor_id')
                                    ->join('patients', 'patients.id', '=', 'medical_boards.patient_id')
                                    ->join('specialties', 'specialties.id', '=', 'doctors.specialty_id')
                                    ->select('medical_boards.date','doctors.id','doctors.first_surname','doctors.last_surname', 'doctors.regional', 'specialties.name', 'patients.user_id', 'patients.mat_beneficiario', 'medical_boards.status')
                                    ->get();
    
            foreach($doctor_pacientes as $doctor_paciente)
            {
                $numero_junta=Doctor::find($doctor_paciente->id);
                $numero[]=$numero_junta->fullName;
            }
    
            $medico_numero=array_count_values($numero);
            
            $pacientes_juntas=DB::table('medical_boards')
            ->join('patients', 'patients.id', '=', 'medical_boards.patient_id')
            ->select('patients.name','patients.first_surname','patients.last_surname', 'patients.mat_beneficiario',  'medical_boards.date','patients.gender')
            ->get();
            foreach($pacientes_juntas as $genero)
            {
                $generos[]=$genero->gender;
            }
    
            $gender=array_count_values($generos);
            $gen_keys=implode("','", (array_keys($gender)));
            $gen_val=implode(",", (array_values($gender)));
            $chart_gender = (new LarapexChart)->pieChart()
                ->setTitle('Total Pacientes: '.$pacientes_juntas->count())
                ->setDataset(array_values($gender))
                ->setWidth(300)
                ->setToolbar(true)
                ->setLabels(array_keys($gender));
    
            $regionales=$doctor_pacientes;
            foreach($regionales as $doctor)
            {
                $reg[]=$doctor->regional;
            }
    
            $regionales=array_count_values($reg);
            $reg_keys=implode("','", (array_keys($regionales)));
            $reg_val=implode(",", (array_values($regionales)));
            
            $chart_reg = app()->chartjs
            ->name('barChartTest')
            ->type('bar')
            ->size(['width' => 400, 'height' => 200])
            ->labels(array_keys($regionales))
            ->datasets([
                [
                    "label" => "",
                    'backgroundColor' => ['#7ACFF5', '#FFDD80', '#E09BCD', '#7889FE', '#82C0E9', '#FF6384','#2980B9','#16A085','#F1948A','#BB8FCE','#E59866','#73C6B6','#8C3949','#39635B','#9CADB1','#B1009C'],
                    'data' => (array_values($regionales))
                ]
            ])
            ->optionsRaw([
                'legend' => [
                    'display' => true,
                    'labels' => false
                ],
                'scales' => [
                    'xAxes' => [
                        [
                            'stacked' => true,
                            'gridLines' => [
                                'display' => true
                            ]
                        ]
                    ]
                ]
            ]);
    
            $pacientes_numeros= DB::table('medical_boards')->pluck('patient_id');
            foreach($pacientes_numeros as $paciente_numero)
            {
                $numero_paciente=Patient::find($paciente_numero);
                $num[]=$numero_paciente->mat_beneficiario;
            }
    
            $paciente_conts=array_count_values($num);
    
            $reports = Report::join('medical_boards', 'medical_boards.id', '=', 'reports.medical_board_id')
            ->join('doctors', 'doctors.id', '=', 'medical_boards.doctor_id')
            ->groupBy('reports.medical_board_id')
            ->orderBy('reports.medical_board_id', 'DESC')
            ->get();
    
            $data["filter_start_date"] = $filter_start_date;
            $data["filter_end_date"] = $filter_end_date;
                $fileName = 'Reporte - '.'.pdf';
                
                return \PDF::loadView('reports.stat-pdf', compact(
                    'paciente_conts',
                    'chart_gender',
                    'medico_numero',
                    'pacientes_juntas',
                    'reg_keys',
                    'reg_val',
                    'esp_keys',
                    'esp_val',
                    'gen_keys',
                    'gen_val',
                    'regionales',
                    'especialidades',
                    'chart_total',
                    'chart_reg',
                    'chart_especialidad',
                    'patients',
                    'doctors',
                    'jrealizadas',
                    'jprogramado',
                    'jcancelado',
                    'jexpirado',
                    'aprobado',
                    'noaprobado',
                    'doctor_pacientes',
                    'juntas_realizadas',
                    'juntas_programado',
                    'juntas_cancelado',
                    'juntas_expirado',
                    'reports',
                    'data'
                ),$data)
                    ->setPaper('a4')
                    ->stream($fileName);
        //            ->download($fileName);
            
        }else{
            if($request->filter_start_date > $request->filter_end_date){
                return redirect()->back();
            }
            $filter_start_date = $request->start_date;
            $filter_end_date = $request->end_date; 
            $medicalBoards=MedicalBoard::where('date', '>=', $filter_start_date)->where('date', '<', $filter_end_date)->get();
            $patients=Patient::get()->count();
            $doctors=Doctor::get()->count();
            $jrealizadas=MedicalBoard::where('date', '>=', $filter_start_date)->where('date', '<', $filter_end_date)->where('status', 'Confirmado')->count();
            $juntas_realizadas=MedicalBoard::join('doctors', 'doctors.id', '=', 'medical_boards.doctor_id')->where('date', '>=', $filter_start_date)->where('date', '<', $filter_end_date)->where('status', 'Confirmado')->get();
            $jprogramado=MedicalBoard::where('status', 'Programado')->where('date', '>=', $filter_start_date)->where('date', '<', $filter_end_date)->count();
            $juntas_programado=MedicalBoard::join('doctors', 'doctors.id', '=', 'medical_boards.doctor_id')->where('date', '>=', $filter_start_date)->where('date', '<', $filter_end_date)->where('status', 'Programado')->get();
            $jcancelado=MedicalBoard::where('status', 'Cancelado')->where('date', '>=', $filter_start_date)->where('date', '<', $filter_end_date)->count();
            $juntas_cancelado=MedicalBoard::join('doctors', 'doctors.id', '=', 'medical_boards.doctor_id')->where('date', '>=', $filter_start_date)->where('date', '<', $filter_end_date)->where('status', 'Cancelado')->get();
            $jexpirado=MedicalBoard::where('status', 'Reprogramar')->where('date', '>=', $filter_start_date)->where('date', '<', $filter_end_date)->count();
            $juntas_expirado=MedicalBoard::join('doctors', 'doctors.id', '=', 'medical_boards.doctor_id')->where('date', '>=', $filter_start_date)->where('date', '<', $filter_end_date)->where('status', 'Reprogramar')->get();
            foreach($medicalBoards as $medicalBoard)
            {
                $medicalBoardId = $medicalBoard->id;
                $approved = Collect(DB::table('doctor_medical_board')
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
            $esp_keys=implode("','", (array_keys($especialidades)));
            $esp_val=implode(",", (array_values($especialidades)));
    
            $chart_especialidad = app()->chartjs
            ->name('barChartEsp')
            ->type('bar')
            ->size(['width' => 400, 'height' => 200])
            ->labels(array_keys($especialidades))
            ->datasets([
                [
                    "label" => "",
                    'backgroundColor' => ['#7ACFF5', '#FFDD80', '#E09BCD', '#7889FE', '#82C0E9', '#FF6384','#2980B9','#16A085','#F1948A','#BB8FCE','#E59866','#73C6B6','#8C3949','#39635B','#9CADB1','#B1009C'],
                    'data' => array_values($especialidades)
                ]
            ])
            ->optionsRaw([
                'legend' => [
                    'display' => true,
                    'labels' => false
                ],
                'scales' => [
                    'xAxes' => [
                        [
                            'stacked' => true,
                            'gridLines' => [
                                'display' => true
                            ]
                        ]
                    ]
                ]
            ]);
    
            $chart_total = (new LarapexChart)
                ->setTitle('Total: '.$medicalBoards->count())
                //->setSubtitle('Total: '.$medicalBoards->count())
                ->setDataset([$jrealizadas, $jprogramado, $jcancelado, $jexpirado])
                ->setWidth(400)
                ->setToolbar(true)
                ->setLabels(['Realizadas', 'Programadas', 'Canceladas', 'Reprogramar']);
    
    
            //Doctores y pacientes atendidos
            $doctor_pacientes=DB::table('medical_boards')
                                    ->join('doctors', 'doctors.id', '=', 'medical_boards.doctor_id')
                                    ->join('patients', 'patients.id', '=', 'medical_boards.patient_id')
                                    ->join('specialties', 'specialties.id', '=', 'doctors.specialty_id')
                                    ->where('date', '>=', $filter_start_date)->where('date', '<', $filter_end_date)
                                    ->select('medical_boards.date','doctors.id','doctors.first_surname','doctors.last_surname', 'doctors.regional', 'specialties.name', 'patients.user_id', 'patients.mat_beneficiario', 'medical_boards.status')
                                    ->get();
    
            foreach($doctor_pacientes as $doctor_paciente)
            {
                $numero_junta=Doctor::find($doctor_paciente->id);
                $numero[]=$numero_junta->fullName;
            }
    
            $medico_numero=array_count_values($numero);
            
            $pacientes_juntas=DB::table('medical_boards')
            ->join('patients', 'patients.id', '=', 'medical_boards.patient_id')
            ->where('date', '>=', $filter_start_date)->where('date', '<', $filter_end_date)
            ->select('patients.name','patients.first_surname','patients.last_surname', 'patients.mat_beneficiario',  'medical_boards.date','patients.gender')
            ->get();
            foreach($pacientes_juntas as $genero)
            {
                $generos[]=$genero->gender;
            }
    
            $gender=array_count_values($generos);
            $gen_keys=implode("','", (array_keys($gender)));
            $gen_val=implode(",", (array_values($gender)));
            $chart_gender = (new LarapexChart)->pieChart()
                ->setTitle('Total Pacientes: '.$pacientes_juntas->count())
                ->setDataset(array_values($gender))
                ->setWidth(300)
                ->setToolbar(true)
                ->setLabels(array_keys($gender));
    
            $regionales=$doctor_pacientes;
            foreach($regionales as $doctor)
            {
                $reg[]=$doctor->regional;
            }
    
            $regionales=array_count_values($reg);
            $reg_keys=implode("','", (array_keys($regionales)));
            $reg_val=implode(",", (array_values($regionales)));
            
            $chart_reg = app()->chartjs
            ->name('barChartTest')
            ->type('bar')
            ->size(['width' => 400, 'height' => 200])
            ->labels(array_keys($regionales))
            ->datasets([
                [
                    "label" => "",
                    'backgroundColor' => ['#7ACFF5', '#FFDD80', '#E09BCD', '#7889FE', '#82C0E9', '#FF6384','#2980B9','#16A085','#F1948A','#BB8FCE','#E59866','#73C6B6','#8C3949','#39635B','#9CADB1','#B1009C'],
                    'data' => (array_values($regionales))
                ]
            ])
            ->optionsRaw([
                'legend' => [
                    'display' => true,
                    'labels' => false
                ],
                'scales' => [
                    'xAxes' => [
                        [
                            'stacked' => true,
                            'gridLines' => [
                                'display' => true
                            ]
                        ]
                    ]
                ]
            ]);
    
            $pacientes_numeros= DB::table('medical_boards')->where('date', '>=', $filter_start_date)->where('date', '<', $filter_end_date)->pluck('patient_id');
            foreach($pacientes_numeros as $paciente_numero)
            {
                $numero_paciente=Patient::find($paciente_numero);
                $num[]=$numero_paciente->mat_beneficiario;
            }
    
            $paciente_conts=array_count_values($num);
    
            $reports = Report::join('medical_boards', 'medical_boards.id', '=', 'reports.medical_board_id')
            ->join('doctors', 'doctors.id', '=', 'medical_boards.doctor_id')
            ->groupBy('reports.medical_board_id')
            ->orderBy('reports.medical_board_id', 'DESC')
            ->where('date', '>=', $filter_start_date)->where('date', '<', $filter_end_date)
            ->get();
    
            $data["filter_start_date"] = $filter_start_date;
            $data["filter_end_date"] = $filter_end_date;
                $fileName = 'Reporte - '.'.pdf';
                
                return \PDF::loadView('reports.stat-pdf', compact(
                    'paciente_conts',
                    'chart_gender',
                    'medico_numero',
                    'pacientes_juntas',
                    'reg_keys',
                    'reg_val',
                    'esp_keys',
                    'esp_val',
                    'gen_keys',
                    'gen_val',
                    'regionales',
                    'especialidades',
                    'chart_total',
                    'chart_reg',
                    'chart_especialidad',
                    'patients',
                    'doctors',
                    'jrealizadas',
                    'jprogramado',
                    'jcancelado',
                    'jexpirado',
                    'aprobado',
                    'noaprobado',
                    'doctor_pacientes',
                    'juntas_realizadas',
                    'juntas_programado',
                    'juntas_cancelado',
                    'juntas_expirado',
                    'reports',
                    'data'
                ),$data)
                    ->setPaper('a4')
                    ->stream($fileName);
        //            ->download($fileName);

        }
        
    }

}
