<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\CompanySize\CompanySizeRepository;
use Illuminate\Support\Facades\DB;
class CompanySizeController extends ApiBaseController
{
    protected $CompanySize;

    public function __construct(CompanySizeRepository $CompanySize){
        $this->CompanySize = $CompanySize;
    }

    public function getListCompanySize($sign, $app_id, $device_type){
        try {
            $CompanySize = $this->CompanySize->orderBy('id', 'ASC')->get();
            //$CompanySize = DB::select('SELECT * FROM CompanySize');
            return $this->returnSuccess('Success!', $CompanySize);
        } catch (Exception $e) {
            return $this->returnError('500', "Thử lại sau");
        }
    }
}
