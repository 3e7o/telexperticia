<?php

namespace App\Http\Controllers;

use App\Models\Active;
use Illuminate\Http\Request;

class ActiveController extends Controller
{
    public function saveLogData($user_id, $log_details, $cn, $fn){
        
        $active_log = new Active();
        $ip = $this->getIp();
        $active_log->user_id = $user_id;
        $active_log->log_details = $log_details;
        $active_log->controller_name = $cn;
        $active_log->function_name = $fn;
        $active_log->ip_address = $ip;
        $active_log->save();
    }

    public function getActiveLog(){
        $this->authorize('getActiveLog', ActiveController::class);

        $activityList = Active::with('users')->get();
        //dd($activityList);
        //$this->activity_log("Vista de Registro de Actividad", "getActiveLog");
        return view('app.active_logs.index', compact('activityList'));
    }


    public function activity_log($log_details, $fn){
        $ac = new ActiveController();
        $ac->saveLogData(auth()->user()->id, $log_details, 'ActiveController', $fn);
    }

    public function getIp(){
        foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key){
            if (array_key_exists($key, $_SERVER) === true){
                foreach (explode(',', $_SERVER[$key]) as $ip){
                    $ip = trim($ip); // just to be safe
                    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false){
                        return $ip;
                    }
                }
            }
        }
        return request()->ip(); // it will return server ip when no client ip found
    }
}
