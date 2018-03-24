<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
class ApiTokenMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //return $next($request);
        if($request->isMethod('post') == true){
            $token = $request->ApiToken;
            $userId = $request->UserID;
        }else{
            $input = (object)$request->route()->parameters();
            $token = $input->ApiToken;
            $userId = $input->user_id;
        }
        
        $res = User::where('id', $userId)->where('remember_token', $token)->first();
        if($res){
            return $next($request);
        }else{
            $res = array('code' => 503, 'message'=>'Token or User Failse!');
            return json_encode($res);
        }

        
    }
}
