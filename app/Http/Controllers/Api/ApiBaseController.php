<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Response;
class ApiBaseController extends Controller
{
    protected function returnSuccess($message = 'success',$result = array()){

        return $this->returnJSON(200, $message, $result);
    }
    protected function returnError($code, $message, $result = array()){
        return $this->returnJSON($code, $message, $result);
    }
    protected function returnJSON($error = 0, $message = "OK", $result = array())
    {
        $response = array('code' => $error, 'message' => $message);
        if (!empty($result)){
            $response['result'] = $result;
        }else{
            $empty = (object)array();
            $response['result'] =  $empty;
        }
        return Response::json($response);
    }
}
