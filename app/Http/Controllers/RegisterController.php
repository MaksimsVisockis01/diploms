<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index(){
        return view('register.index');
    }

    public function store(Request $request){
        
        $name = $request->input('name');
        $email = $request->input('email');
        $uid = $request->input('uid');
        $pwd = $request->input('pwd');
        $pwdrepeat = $request->input('pwdrepeat');

        //dd($request);

        
    }
}
