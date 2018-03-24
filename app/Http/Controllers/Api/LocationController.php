<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\Location\LocationRepository;
use App\Repositories\Country\CountryRepository;
class LocationController extends ApiBaseController
{
    protected $location;
    protected $country;
    public function __construct(LocationRepository $location, CountryRepository $country){
        $this->location = $location;
        $this->country = $country;
    }
    public function getAllLocationOnCountry($sign, $app_id, $device_type, $country_id){
        if($country_id == 0){
            $location = $this->location->getAll();
        }else{
            $location = $this->country->getById($country_id)->location;
        }
        return $this->returnSuccess('Success!', $location);
    }
}
