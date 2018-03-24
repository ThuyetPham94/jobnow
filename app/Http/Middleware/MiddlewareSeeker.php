<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Auth;
class MiddlewareSeeker
{

    public function handle($request, Closure $next)
    {
        //dd(Auth::user());
        if (empty(Auth::user())) {
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->route('public.home')->with('popup','true');
            }
        }else{
            if(Auth::user()->IsCompany != 0){
                if ($request->ajax()) {
                    return response('Unauthorized.', 401);
                } else {
                    return redirect()->route('public.home');
                }
            }
        }

        return $next($request);
    }
}
