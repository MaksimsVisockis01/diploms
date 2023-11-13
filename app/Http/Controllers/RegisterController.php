<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

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
            'password' => ['required', 'string', 'min:7', 'max:30', 'confirmed'],
        ]);

        

        $user = User::query()->create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'uid' => $validated['uid'],
            'password' => Hash::make($validated['password']),
        ]);

        if ($user->admin) {
            Session::put('admin_id', $user->id);
        }else{
            Session::put('user_id', $user->id);
        }
        

        return redirect()->route('home');
    }
}