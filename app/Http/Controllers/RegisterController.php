<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Hash;

class RegisterController extends Controller
{
    public function index(){
        return view('register.index');
    }

    public function store(Request $request){

        $validated = $request->validate([
            'name'=> ['required', 'string','max:20'],
            'email'=> ['required', 'string','max:30', 'email', 'unique:users'],
            'uid'=> ['required', 'string','max:30', 'unique:users'],
            'password'=> ['required', 'string','min:7','max:30', 'confirmed'],
        ]);

        $user = new User;

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->uid = $validated['uid'];
        $user->password = Hash::make($validated['password']);
        $user->save();

        // return redirect()->route('/');

        // Вместо этого, возвращаем null или void
    }
}