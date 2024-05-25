<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class TeacherOrAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if (!$user || (!$user->teacher && !$user->admin)) {
            return response()->make(
                "<script>
                    alert('You are not a teacher or an admin.');
                    window.history.back();
                </script>",
                403
            );
        }

        return $next($request);
    }
}
