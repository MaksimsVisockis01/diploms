<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CanBroadcast
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        if ($user && ($user->isAdmin() || $user->isTeacher())) {
            return $next($request);
        }

        return redirect()->route('home')->with('error', 'You do not have permission to start a broadcast.');
    }
}

