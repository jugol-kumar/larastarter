<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function general(){
        return view('backend.settings.general');
    }

    public  function generalUpdate(Request $request){
        return $request;
    }
}
