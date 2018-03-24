<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

abstract class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    function getData($func, $data) {
    	$core_api_url = url();
    	$_apikey = 'tD0EudnC92D198TR';
    	$_appid = 'com.jobnow.demo';
        $time = round(microtime(true) * 1000);
        $sign =  $time. "." . md5("$func:" . $time . ":" . $_apikey);
        $data['sign'] = $sign;
        $data['app_id'] = $_appid;
        $data['device_type'] = 2;
        $str_data = json_encode($data);
        //echo $str_data = json_encode($data);

        // echo $core_api_url.'/'.$func;
        // die();
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $core_api_url.'/'.$func);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($curl, CURLOPT_POSTFIELDS, $str_data);

        $result = curl_exec($curl);
        $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
       // dd($http_code);die();
        curl_close($curl);
        if ($http_code == 200) {
            return $result;
        } else {
            return false;
        }
    }


}
