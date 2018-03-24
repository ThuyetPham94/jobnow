<?php

namespace App\Http\Middleware;

use Closure;
use Response;
use App\Http\Requests;
use Illuminate\Http\Request;
class ApiBaseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    protected $apps;
    protected $device_type;
    protected $client_ip;
    public function handle($request, Closure $next)
    {
        //dd('fe');die;
        return $next($request);
        $this->apps = array(
            'com.jobnow.demo' => 'tD0EudnC92D198TR',
        );
        $this->device_type = $request->device_type;
        $signature         = $request->sign;
        $app_id            = $request->app_id;
        if (empty($this->device_type) || empty($app_id) || empty($signature) || !array_key_exists($app_id, $this->apps))
        {
            //$test = array('result'=>$data);
            return $this->returnJSON(400, "Bad gateway");
        }
        if($this->device_type == 2 || $this->device_type == 3 || $this->device_type == 4){
            /*$parts = explode(".", $signature, 2);
            $time = count($parts) == 2 ? $parts[0] : "";
            $sign = count($parts) == 2 ? $parts[1] : "";
            $key = $this->apps[$app_id];
            $uri = $request->route()->getPath();

            $sum = md5("$uri:$time:$key");

            if (($sum != $sign)) {
            return $this->returnJSON(401, "Bad signature");
            }*/

            /*$milliseconds = round(microtime(true) * 1000);
            if($now*1000 + 100000 - $time > 600000 || $now*1000+100000 - $time < -120000){
                return $this->returnJSON(501, "Expired!");
            }*/
            return $next($request);
        }else{
            return $this->returnJSON(403, "Devicetype not support!");
        }
        

        
    }
    protected function returnJSON($error = 0, $message = "OK", $result = array())
    {
        $response = array('code' => $error, 'message' => $message);
        if (!empty($result)){
            $response['result'] = $result;
        }else{
            $empty = array();
            $response['result'] =  $empty;
        }
        return Response::json($response);
    }
}
