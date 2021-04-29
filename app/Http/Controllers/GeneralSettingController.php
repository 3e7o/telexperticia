<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GeneralSetting;
use App\Traits\EnvironmentScope;

class GeneralSettingController extends Controller
{
    use EnvironmentScope;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function general()
    {
        $this->authorize(GeneralSetting::class);
        $generalsetting = GeneralSetting::first();
        return view("app.zoom.general_config", compact("generalsetting"));
    }

    public function zoom()
    {
        $this->authorize(GeneralSetting::class);
        $generalsetting = GeneralSetting::first();
        return view("app.zoom.zoom_config", compact("generalsetting"));
    }

    public function update_zoom(Request $request, $id)
    {
        $this->authorize('update_zoom', GeneralSetting::class);
        $generalsetting = GeneralSetting::find($id);
        $generalsetting->api_key = $request->api_key;
        $generalsetting->api_secret = $request->api_secret;
        $generalsetting->zoom_email = $request->zoom_email;

        $this->setEnv('ZOOM_CLIENT_KEY', "$request->api_key");
        $this->setEnv('ZOOM_CLIENT_SECRET', "$request->api_secret");
        $this->setEnv('APP_TIMEZONE', "$request->timezone");

        if($generalsetting->save()){
            $this->activity_log("API Zoom Actualizada", "zoom.zoom_config");
            return redirect()->route('zoom')->with('success','Ajustes fueron actualizados');
        }
        else{
            return back()->withErrors(['Existio un error!'])->withInput();
        }
    }
    public function activity_log($log_details, $fn){
        $ac = new ActiveController();
        $ac->saveLogData(auth()->user()->id, $log_details, 'GeneralSettingController', $fn);
    }
}
