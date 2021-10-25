<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $guard)
    {
        switch ($guard) {
            case 'user':
                if (Auth::guard($guard)->check()) {
                    return redirect()->route('user.home');
                }
                break;
            case 'admin':
                if (Auth::guard($guard)->check()) {
                    return redirect()->route('admin.home');
                }
                break;
            case 'doctor':
                if (Auth::guard($guard)->check()) {
                    return redirect()->route('doctor.home');
                }
                break;
        }

        return $next($request);
    }
}
