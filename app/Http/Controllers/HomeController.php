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
        $event = [];
        $medicalBoards = MedicalBoard::query()
            ->itIsAuthorized()
            ->select('medical_boards.*')
            ->get();
        foreach($medicalBoards as $medicalBoard){
            $events[] = \Calendar::event(
                $medicalBoard->code,
                true,
                new \DateTime(($medicalBoard->zoom)->start_time),
                new \DateTime(($medicalBoard->zoom)->start_time.' +1 day'),
                null,
                // Add color and link on event
                [
                    'locale' => 'es',
                    'color' => '#f05050',
                    'url' => "/medical-boards/$medicalBoard->id",

                ]
            );
        }
        $calendar = \Calendar::addEvents($events);
        return view('home', compact('calendar'));
    }
}
