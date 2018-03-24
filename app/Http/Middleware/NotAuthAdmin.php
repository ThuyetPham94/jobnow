<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Auth;
class NotAuthAdmin
{

    public function handle($request, Closure $next)
    {
        //dd(Auth::user());
        if (empty(Auth::user())) {
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->route('admin.auth.postLogin');
            }
        }else{
            if(Auth::user()->IsCompany <= 1){
                if ($request->ajax()) {
                    return response('Unauthorized.', 401);
                } else {
                    return redirect()->route('admin.auth.postLogin');
                }
            }
        }

        return $next($request);
    }
}
