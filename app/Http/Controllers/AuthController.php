<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Validator;
use Hash;
use Session;
use App\Models\User;

class AuthController extends Controller
{
    public function showFormLogin()
    {
        if (Auth::check()) {
            //login success
            return redirect()->route('home');
        }
        return view('login');
    }

    public function login(Request $request)
    {
        $rules = [
            'email' => 'required|email',
            'password'  => 'required|string'
        ];
        
        $messages = [
            'email.required'    => 'wajib diisi',
            'email.email'       => 'ga valid',
            'password.required' => 'wajib diisi',
            'password.string'   => 'salah'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }   

        $data = [
            'email'     => $request->input('email'),
            'password'  => $request->input('password'),
        ];
        Auth::attempt($data);
        if (Auth::check()) {
            //login success
            return redirect()->route('home');
        } else {
            //fail
            Session::flash('error','email or password salah');
            return redirect()->route('login');
        }
    }

    public function showFormRegister()
    {
        return view('register');
    }
    
    public function register(Request $request)
    {
        $rules = [
            'name'      => 'required|min:3|max:35',
            'email'     => 'required|email|unique:users,email',
            'password'  => 'required|confirmed'
        ];
        $messages = [
            'name.required'     => 'nama lengkap diisi dong',
            'name.min'          => 'minimal 3 huruf',
            'name.max'          => 'maksimal 500 huruf ari betul mah',
            'email.required'    => 'wajib diisi gan',
            'email.email'       => 'email tidak valid',
            'email.unique'      => 'email sudah terdaftar',
            'password.required' => 'password wajib',
            'password.confirmed'=> 'password ga sama'
        ];
        
        $validator = validator::make ($request->all(), $rules, $messages);
        if ($validator-> fails()){
            return redirect()->back()->witherrors($validator)->withinput($request->all);
        }

        $user = new User;
        $user->name = ucwords(strtolower($request->name));
        $user->email = strtolower($request->email);
        $user->password = Hash::make($request->password);
        $user->email_verified_at = \Carbon\carbon::now();
        $simpan = $user->save();

        if($simpan){
            session::flash('success','Register berhasil, cuss login');
            return redirect()->route('login');
        } else {
            session::flash('errors',['' => 'regis gagal']);
            return redirect()->route('register');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
