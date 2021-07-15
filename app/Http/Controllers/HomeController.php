<?php

namespace App\Http\Controllers;

use App\Models\MedicalBoard;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $this->authorize('view-any', MedicalBoard::class);
        $events = [];
        $medicalBoards = MedicalBoard::query()
            ->itIsAuthorized()
            ->groupBy('id')
            ->orderBy('medical_boards.id', 'DESC')
            ->get();
        foreach($medicalBoards as $medicalBoard){
            if((isset(($medicalBoard->zoom)->start_time)) and ((\Carbon\Carbon::parse(($medicalBoard->zoom)->start_time))) > \Carbon\Carbon::now() and $medicalBoard->doctorOwner->id != optional(auth()->user()->doctor)->id)
            {

                $events[] = \Calendar::event(
                    $medicalBoard->code,
                    false,
                    new \DateTime(($medicalBoard->zoom)->start_time),
                    new \DateTime(((\Carbon\Carbon::parse(($medicalBoard->zoom)->start_time))->addMinutes(($medicalBoard->zoom)->duration))->format('Y-m-d H:i:s')),
                    1,
                    // Add color and link on event
                    [
                        'color' => '#10B759',
                        'url' => "/reports/$medicalBoard->id/editar",

                    ]
                );

            }elseif((isset(($medicalBoard->zoom)->start_time)) and ((\Carbon\Carbon::parse(($medicalBoard->zoom)->start_time))) > \Carbon\Carbon::now()){
                $events[] = \Calendar::event(
                    $medicalBoard->code,
                    false,
                    new \DateTime(($medicalBoard->zoom)->start_time),
                    new \DateTime(((\Carbon\Carbon::parse(($medicalBoard->zoom)->start_time))->addMinutes(($medicalBoard->zoom)->duration))->format('Y-m-d H:i:s')),
                    2,
                    // Add color and link on event
                    [
                        'color' => '#10B759',
                        'url' => "/reports/$medicalBoard->id",

                    ]
                );
            }
         }
         foreach($medicalBoards as $medicalBoard){
            if((isset(($medicalBoard->zoom)->start_time)) and ((\Carbon\Carbon::parse(($medicalBoard->zoom)->start_time))) < \Carbon\Carbon::now() and $medicalBoard->doctorOwner->id === optional(auth()->user()->doctor)->id)
            {

                $events2[] = \Calendar::event(
                    $medicalBoard->code,
                    false,
                    new \DateTime(($medicalBoard->zoom)->start_time),
                    new \DateTime(((\Carbon\Carbon::parse(($medicalBoard->zoom)->start_time))->addMinutes(($medicalBoard->zoom)->duration))->format('Y-m-d H:i:s')),
                    1,
                    // Add color and link on event
                    [
                        'color' => '#FF3366',
                        'url' => "/medical-boards/$medicalBoard->id",

                    ]
                );

            }elseif((isset(($medicalBoard->zoom)->start_time)) and ((\Carbon\Carbon::parse(($medicalBoard->zoom)->start_time))) < \Carbon\Carbon::now()){
                $events2[] = \Calendar::event(
                    $medicalBoard->code,
                    false,
                    new \DateTime(($medicalBoard->zoom)->start_time),
                    new \DateTime(((\Carbon\Carbon::parse(($medicalBoard->zoom)->start_time))->addMinutes(($medicalBoard->zoom)->duration))->format('Y-m-d H:i:s')),
                    2,
                    // Add color and link on event
                    [
                        'color' => '#FF3366',
                        'url' => "/medical-boards/$medicalBoard->id/editar",

                    ]
                );
            }
         }
        $calendar = \Calendar::addEvents($events)->setOptions([
            'locale' => 'es',
            'firstDay' => 0,
            'displayEventTime' => true,
            'selectable' => true,
            'initialView' => 'dayGridMonth',
            'headerToolbar' => [
                'end' => 'today prev,next dayGridMonth timeGridWeek timeGridDay'
            ]
        ]);
        $calendar = \Calendar::addEvents($events2)->setOptions([
            'locale' => 'es',
            'firstDay' => 0,
            'displayEventTime' => true,
            'selectable' => true,
            'initialView' => 'dayGridMonth',
            'headerToolbar' => [
                'end' => 'today prev,next dayGridMonth timeGridWeek timeGridDay'
            ]
        ]);

        return view('home', compact('calendar'));
    }
    public function activity_log($log_details, $fn){
        $ac = new ActiveController();
        $ac->saveLogData(auth()->user()->id, $log_details, 'HomeController', $fn);
    }
}
