<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
class LogoutController extends Controller
{
    public function index(){

        Session::forget('admin_id');
        Session::forget('user_id');

        auth()->logout();
        return redirect()->route('forum');
    }
}
