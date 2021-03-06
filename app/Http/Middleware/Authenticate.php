<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if ($request->is('user')) {
            return route('user.login');
        } else if ($request->is('admin')) {
            return route('admin.login');
        } else if ($request->is('poli')) {
            return route('poli.login');
        } else if ($request->is('doctor')) {
            return route('doctor.login');
        }
    }
}
