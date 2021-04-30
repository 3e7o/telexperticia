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
    public function index()
    {
        $this->authorize('view-any', User::class);
        $aprobado=0;
        $noaprobado=0;
        $medicalBoards=MedicalBoard::get();
        $patients=Patient::get()->count();
        $doctors=Doctor::get()->count();
        $jrealizadas=MedicalBoard::where('status', 'Realizado')->count();
        $jprogramado=MedicalBoard::where('status', 'Programado')->count();
        $jcancelado=MedicalBoard::where('status', 'Cancelado')->count();
        $jexpirado=MedicalBoard::where('status', 'Expirado')->count();
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
            ->setSubtitle('Total: '.$medicalBoard->count())
            ->setDataset([$jrealizadas, $jprogramado, $jcancelado, $jexpirado])
            ->setColors(['#7ee5e5', '#4d8af0','#f77eb9','#fbbc06'])
            ->setHeight(400)
            ->setWidth(330)
            ->setToolbar(true)
            ->setLabels(['Realizadas', 'Programadas', 'Canceladas', 'Expiradas']);


        return view('app.stats.index', compact('especialidades','chart', 'patients','doctors','jrealizadas','jprogramado','jcancelado','jexpirado','aprobado','noaprobado'));

    }

    public function download()
    {
        $this->authorize('view-any', User::class);
        $aprobado=0;
        $noaprobado=0;
        $medicalBoards=MedicalBoard::get();
        $patients=Patient::get()->count();
        $doctors=Doctor::get()->count();
        $jrealizadas=MedicalBoard::where('status', 'Realizado')->count();
        $jprogramado=MedicalBoard::where('status', 'Programado')->count();
        $jcancelado=MedicalBoard::where('status', 'Cancelado')->count();
        $jexpirado=MedicalBoard::where('status', 'Expirado')->count();
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
            ->setSubtitle('Total: '.$medicalBoard->count())
            ->setDataset([$jrealizadas, $jprogramado, $jcancelado, $jexpirado])
            ->setColors(['#7ee5e5', '#4d8af0','#f77eb9','#fbbc06'])
            ->setHeight(400)
            ->setWidth(330)
            ->setToolbar(true)
            ->setLabels(['Realizadas', 'Programadas', 'Canceladas', 'Expiradas']);
        $fileName = 'Reporte - '.'.pdf';
        return \PDF::loadView('reports.stat-pdf', compact('especialidades','chart', 'patients','doctors','jrealizadas','jprogramado','jcancelado','jexpirado','aprobado','noaprobado'))
            ->setPaper('a4')
            ->stream($fileName);
//            ->download($fileName);
    }

}
