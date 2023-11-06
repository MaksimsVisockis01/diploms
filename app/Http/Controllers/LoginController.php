<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index(){
        return view('login.index');
    }
    public function store(Request $request){
        
        $credentials = $request->only('uid', 'password');
    
        if (auth()->attempt($credentials)) {
            return redirect()->intended('user');
        }
        
        return back()->withErrors(['uid' => 'wrond username', 'password' => 'wrond password']);

        
    }
}
