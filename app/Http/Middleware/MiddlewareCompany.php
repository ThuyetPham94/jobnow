<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Auth;
use App\Models\CompanyProfile;
class MiddlewareCompany
{

    public function handle($request, Closure $next)
    {
        //dd();die();
        if (empty(Auth::user())) {
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                //if(request()->is('ManageCompany/job/create')){
                    return redirect()->route('public.company.getLogin')->with('type','find');
                // }else if(request()->is('ManageCompany/job/postJob')){
                //     return redirect()->route('public.company.getLogin')->with('type','post');
                // }
            }
        }else{
            if(Auth::user()->IsCompany != 1){
                if ($request->ajax()) {
                    return response('Unauthorized.', 401);
                } else {
                    
                    return redirect()->route('public.home');
                }
            }else{
                $data = CompanyProfile::where('CompanyID', Auth::user()->id)->first();
                if($data->IsPremium == 1){
                    return $next($request);
                }else{
                    //dd(date('Y-m-d',strtotime('-30 days')));
                    if(date('Y-m-d',strtotime('-30 days')) <= date('Y-m-d', $data->created_at->timestamp)){
                        return $next($request);
                    }else{
                        Auth::logout();
                        return redirect()->route('public.home')->with('message', 'Trial expires. Please register Premium')->with('status', 'error');
                    }
                }
            }
        }

        
    }
}
