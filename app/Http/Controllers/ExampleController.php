<?php

namespace App\Http\Controllers;

use App\Models\landing_config;
use Illuminate\Http\Request;

class ExampleController extends Controller
{
    public function index()
    {
        $data['landing'] = landing_config::get();

        return view('example', $data);
    }

    public function update(Request $request)
    {
        try {
            foreach ($request->all() as $key => $value) {
                if ($key !== '_token') {
                    $model[$key] = landing_config::where('name', $key)->first();
                    $model[$key]->value = $value;
                    $model[$key]->update();
                }
            }
            return redirect('/');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
