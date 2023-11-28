<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function index(){
        return view('login.index');
    }
    public function store(Request $request){
        
        $credentials = $request->only('uid', 'password');
    
        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->admin) {
                Session::put('admin_id', $user->id);
            }else{
                Session::put('user_id', $user->id);
            }

            return redirect()->route('/');
        }
        
        return back()->withErrors(['uid' => 'wrond username', 'password' => 'wrond password']);
    }
}
