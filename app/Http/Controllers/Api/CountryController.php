<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\Country\CountryRepository;
class CountryController extends ApiBaseController
{
    protected $country;
    public function __construct(CountryRepository $country){
        $this->country = $country;
    }

    public function getAllCountry($sign, $app_id, $device_type){
        try {
            $country = $this->country->getAll();
            if($country){
                foreach ($country as $key => $value) {
                    $row[] = array("id"=>$value->id, "Name"=>$value->Name, "PostalCode"=>$value->PostalCode);
                }
                return $this->returnSuccess('Success!', $row);
            }else{
                return $this->returnError(404, "Thử lại sau");
            }
        } catch (Exception $e) {
            return $this->returnError(502, "Thử lại sau");
        }
    }
}
