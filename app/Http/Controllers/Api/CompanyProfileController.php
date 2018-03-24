<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Mockery\Exception;
use Validator;
use Config;
use App\Repositories\CompanyProfile\CompanyProfileRepository;
use App\Http\CompanyProfileRequests;
use Intervention\Image\ImageManagerStatic as Image;

class CompanyProfileController extends ApiBaseController
{

	protected $companyprofile;

	public function __construct(CompanyProfileRepository $model) {
		$this->companyprofile = $model;
	}

	// API chỉnh sửa thông tin công ty
	
	public function postUpdateCompany(Request $request) {
		try{			
			$ComProfile = $this->companyprofile->where('CompanyID', '=', $request->UserID)->first();
			if($request->Phone != null && $request->Phone != "")
			{
				$ComProfile->ContactNumber = $request->Phone;
			}
			else
			{
				$ComProfile->Overview = $request->Description;
                $ComProfile->Name = $request->Name;
			}            
            $ComProfile->save();
			return $this->returnError(200, 'Cập nhật thành công');
		} catch (Exception $e){
			return $this->returnError(404, "Thử lại sau");
		}
	}

	public function postCompanyUploadFile(Request $request) {
		try{
			$validator = Validator::make($request->all(), array(
				'Files' => 'required|image',
			));
			if($validator->fails()){
				$res = array('error'=>$validator->messages()->all());
				return $this->returnError(405,$validator->messages()->first(), $res);
			}
			//dd(Config::get('images.path_upload'));
			$images = $request->file('Files');
			$filename = time() . '_' . md5($images->getClientOriginalName());
			$fileext = $images->getClientOriginalExtension();
			//exec('mkdir -m 777 '.Config::get('images.path_upload'));
			$images->move(Config::get('images.image_company_url_logo'), $filename.'.'.$fileext);
			$ComProfile = $this->companyprofile->where('CompanyID', '=', $request->UserID)->first();
            $ComProfile->Logo = $filename.'.'.$fileext;
            $ComProfile->save();
			$res = array('avatar_name'=>$filename.'.'.$fileext,'img_url'=>Config::get('images.base_domain').Config::get('images.image_company_url_logo').$filename.'.'.$fileext);
			return $this->returnSuccess('Upload thành công', $res);
		} catch (Exception $e){
			return $this->returnError(404, "Thử lại sau");
		}
	}	

	public function getCompanyProfile(Request $request){
        try {
            $CompanySize = $this->companyprofile->where('CompanyID','=',$request->CompanyID)->first();
            $CompanySize->CreditNumber = User::find($request->CompanyID)->CreditNumber;
            if(substr(trim($CompanySize->Logo), 0,4) !== 'http'){
                $CompanySize->Logo  = Config::get('images.base_domain').Config::get('images.image_company_url_logo').$CompanySize->Logo;
            }
            return $this->returnSuccess('Success!', $CompanySize);
        } catch (Exception $e) {
            return $this->returnError('500', "Thử lại sau");
        }
    }

}