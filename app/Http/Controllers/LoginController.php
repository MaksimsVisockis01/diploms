<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index(){
        return view('login.index');
    }
    public function store(Request $request){
        
        $uid = $request->input('uid');
        $pwd = $request->input('pwd');

        //dd($request);

        
    }
}
