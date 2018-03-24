<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Auth;
class AuthAdmin
{

    public function handle($request, Closure $next)
    {
        if (!empty(Auth::user()) && Auth::user()->IsCompany > 1) {
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->route('admin.home');
            }
        }

        return $next($request);
    }
}
