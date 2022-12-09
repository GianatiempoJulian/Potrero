<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function create()
    {
        return view('user.create');
    }

    public function store()
    {

        $request = request()->validate([
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'string']
        ], [
            'first_name.required' => 'El campo nombre es obligatorio.',
            'last_name.required' => 'El campo apellido es obligatorio.',
            'email.required' => 'El campo email es obligatorio.',
            'email.unique' => 'El email ya esta en uso.',
            'password.required' => 'El campo contraseña es obligatorio.',
        ]);

        $user = User::create([
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'email' => $request['email'],
            'password' => $request['password'],
            'teams_own' => 0
        ]);

        Auth::login($user);

        return redirect('/jugadores');
    }

    public function edit()
    {
        return view('user.edit');
    }


    public function update(Request $request)
    {
        $request = request()->all();

        $user = User::where('id', auth()->user()->id)->first();

      
        if ($request['password'] == NULL) {
            $request['password'] = $user->password;
        } 

       
        if (User::where('email', $request['email'])->first() == NULL || $request['email'] == $user->email) {
            $user->first_name = $request['first_name'];
            $user->last_name = $request['last_name'];
            $user->email = $request['email'];
            $user->password = $request['password'];
            $user->update();
            return redirect('/jugadores');
        }
        else{
            return back()->withErrors([
                'error_msg' => 'Email ya en uso, intente con otro distinto.'
            ]);
        } 
    }
}
