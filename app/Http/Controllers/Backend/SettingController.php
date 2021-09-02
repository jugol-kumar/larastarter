<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use msztorc\LaravelEnv\Env;

class SettingController extends Controller
{
    public function general(){
        return view('backend.settings.general');
    }
    public  function generalUpdate(Request $request){
        $this->validate($request, [
           'site_title'  => 'required|min:2|max:255',
            'site_description' => 'nullable|min:2|max:255',
            'site_address' => 'nullable|min:2|max:255',
        ]);

        Setting::updateOrCreate(['name' => 'site_title'], ['value' => $request->get('site_title')]);

        $env = new Env();
        $env->setValue('APP_NAME', $request->site_title);

        Setting::updateOrCreate(['name' => 'site_description'], ['value' => $request->get('site_description')]);
        Setting::updateOrCreate(['name' => 'site_address'], ['value' => $request->get('site_address')]);

         notify()->success("Setting Changed...!");
         return redirect()->back();
    }

    public function appearance(Request $request){
        return view('backend.settings.apprarance');
    }
    public function appearanceUpdate(Request $request){

        $this->validate($request, [
           'site_logo' => 'nullable|image',
           'site_favicon' => 'nullable|image'
        ]);

        if ($request->hasFile('site_logo')){
            $this->deleteLogoFile(setting('site_logo'));
            Setting::updateOrCreate(
                ['name' => 'site_logo'],
                [
                    'value' => Storage::disk('public')->putFile('site_logo', $request->file('site_logo'))
                ]
            );
        }


        if ($request->hasFile('site_favicon')){
            $this->deleteLogoFile(setting('site_favicon'));
            Setting::updateOrCreate(
                ['name' => 'site_favicon'],
                [
                    'value' => Storage::disk('public')->putFile('site_favicon', $request->file('site_favicon'))
                ]
            );
        }

        notify()->success("Setting Changed...!");
        return redirect()->back();

    }

    private function deleteLogoFile($path){
        Storage::disk('public')->delete($path);
    }


    public function mail(){
        return view('backend.settings.mail');
    }
    public  function mailUpdate(Request $request){
        $this->validate($request, [
            'site_title'  => 'required|min:2|max:255',
            'site_description' => 'nullable|min:2|max:255',
            'site_address' => 'nullable|min:2|max:255',
        ]);

        Setting::updateOrCreate(['name' => 'site_title'], ['value' => $request->get('site_title')]);

        $env = new Env();
        $env->setValue('APP_NAME', $request->site_title);

        Setting::updateOrCreate(['name' => 'site_description'], ['value' => $request->get('site_description')]);
        Setting::updateOrCreate(['name' => 'site_address'], ['value' => $request->get('site_address')]);

        notify()->success("Setting Changed...!");
        return redirect()->back();
    }




}
