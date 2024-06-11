<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BroadcastController extends Controller
{
    public function index()
    {
        return view('broadcast');
    }

    public function start()
    {
        $user = auth()->user();

        if (!auth()->check() || (!auth()->user()->teacher && !auth()->user()->admin)) {
            return redirect()->route('home')->with('error', 'You do not have permission to start a broadcast.');
        }

    }
}
