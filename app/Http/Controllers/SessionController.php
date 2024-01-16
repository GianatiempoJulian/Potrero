<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class SessionController extends Controller
{
    public function index()
    {
        return view('index');
    }
    
    public function register()
    {
        return view('user.register');
    }

    public function login()
    {
        return view('user.login');
    }

    public function login_verification(Request $request)
    {
      
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            return redirect()->intended(route('jugadores'));
        }   
        else{
            return back()->withErrors([
                'error_msg' => 'Email o contraseña incorrecta. Intente nuevamente.'
            ]);
        }     
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerate();
        return redirect('inicio');
    }

}
