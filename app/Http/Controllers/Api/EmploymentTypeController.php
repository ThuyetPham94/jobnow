<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\EmploymentType;
class EmploymentTypeController extends ApiBaseController
{

    public function __construct(){}

    public function getListEmployment($sign, $app_id, $device_type){
        try {
            $employment = EmploymentType::all();
            return $this->returnSuccess('Success!', $employment);
        } catch (Exception $e) {
            return $this->returnError('500', "Thử lại sau");
        }
    }
}
