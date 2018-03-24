<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Auth;
class AuthCompany
{

    public function handle($request, Closure $next)
    {
        //dd(Auth::user());
        if (!empty(Auth::user()) && Auth::user()->IsCompany == 1) {
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->route('public.company.index');
            }
        }

        return $next($request);
    }
}
