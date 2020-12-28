<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\landing_config;

class HomeController extends Controller
{
    public function getAllLanding()
    {
        $landingpage = landing_config::all();
        //dd($landingpage);
        return view('home', compact("landingpage"));
    }

    public function saveLanding(Request $request)
    {
        $apdet = new landing_config();
        $apdet->value = $request->value;
        $apdet->update();
        
        if($apdet){
            session::flash('success','Data berhasil disimpan');
            return redirect('/home');
        } else {
            session::flash('errors',['' => 'Gagal :(']);
            return redirect('/home');
        }
    }
}

