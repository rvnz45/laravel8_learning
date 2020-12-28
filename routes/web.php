<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ExampleController;
use App\Http\Controllers\HomeController;
use App\Models\landing_config;


Route::get('/', function () {
	$data = array();
    foreach (landing_config::all() as $setting){
        //dd($setting);
        $data[$setting->name] = $setting['value'];
    //$data['pembukaan'] = 'test';
    }
 //   dd(landing_config::all());
    return view('welcome')->with('landing_config', $data);
});
Route::get('login',[AuthController::class, 'showFormLogin'])->name('login');
Route::post('login',[AuthController::class,'login']);

route::group(['middleware' => 'auth'], function(){
    route::get('home',[HomeController::class,'getAllLanding'])->name('home');
    route::post('home',[HomeController::class,'saveLanding']);
    route::get('logout',[AuthController::class,'logout'])->name('logout');
});

route::get('example',[ExampleController::class,'index'])->name('example');
route::post('update-example',[ExampleController::class,'update'])->name('example-update');
