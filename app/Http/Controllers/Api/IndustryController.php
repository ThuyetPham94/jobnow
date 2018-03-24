<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\Industry\IndustryRepository;
class IndustryController extends ApiBaseController
{
    protected $industry;

    public function __construct(IndustryRepository $industry){
        $this->industry = $industry;
    }

    public function getListIndustry($sign, $app_id, $device_type){
        try {
            $industry = $this->industry->orderBy('id', 'DESC')->get();
            return $this->returnSuccess('Success!', $industry);
        } catch (Exception $e) {
            return $this->returnError('500', "Thử lại sau");
        }
    }
}
