<?php

namespace App\Http\Controllers;

use App\Models\Active;
use Illuminate\Http\Request;

class ActiveController extends Controller
{
    public function saveLogData($user_id, $log_details, $cn, $fn){

        $active_log = new Active();
        $active_log->user_id = $user_id;
        $active_log->log_details = $log_details;
        $active_log->controller_name = $cn;
        $active_log->function_name = $fn;
        $active_log->save();
    }

    public function getActiveLog(){
        $this->authorize('getActiveLog', ActiveController::class);
        $activityList = Active::with('users')->Where('user_id', auth()->user()->id)->orderBy('id','desc')->get();
        //dd($activityList);
        //$this->activity_log("Vista de Registro de Actividad", "getActiveLog");
        return view('app.active_logs.index')->with('activityList', $activityList);
    }


    public function activity_log($log_details, $fn){
        $ac = new ActiveController();
        $ac->saveLogData(auth()->user()->id, $log_details, 'ActiveController', $fn);
    }
}
