<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use Validator;
use App\Http\Controllers\Controller;
use App\Repositories\JobSeekerExperience\JobSeekerExperienceRepository;
use App\Repositories\User\UserRepository;
class JobSeekerExperience extends ApiBaseController
{
    protected $experience;
    protected $user;
    public function __construct(JobSeekerExperienceRepository $experience, UserRepository $user){
        $this->experience = $experience;
        $this->user = $user;
    }

    public function getAllJobSeekerExperience($sign, $app_id, $device_type, $user_id){
        try {
            $experiences = $this->user->getById($user_id)->experience;
            if($experiences){
                return $this->returnSuccess('Success!', $experiences);
            }else{
                return $this->returnError(404, "Thử lại sau");
            }
        } catch (Exception $e) {
            return $this->returnError(500, "Thử lại sau");
        }
    }

    public function getAllUserExperience($sign, $app_id, $device_type,Request $request){
        try {
            $experiences = $this->user->getById($request->user_id)->experience;
            if($experiences){
                return $this->returnSuccess('Success!', $experiences);
            }else{
                return $this->returnError(404, "Thử lại sau");
            }
        } catch (Exception $e) {
            return $this->returnError(500, "Thử lại sau");
        }
    }

    public function postAddJobSeekerExperience(Request $request){
        try {
            $validator = Validator::make($request->all(), array(
                'JobSeekerID'  => 'required|integer',
                'CompanyName'  => 'required',
                'PositionName' => 'required',
                'FromDate'  => 'required',
                'ToDate'  => 'required',
                'Salary' => 'required'
            ));
            if($validator->fails()){
                $res = array('error'=>$validator->messages()->all());
                return $this->returnError(405,$validator->messages()->first(), $res);
            }
            $result = $this->experience->create($request->all());
            if($result){
                return $this->returnSuccess('Thêm kinh nghiệm thành công');
            }else{
                return $this->returnError(403, "Thử lại sau");
            }
        } catch (Exception $e) {
            return $this->returnError(500,"Thử lại sau");
        }
    }
    public function postUpdateJobSeekerExperience(Request $request){
        try {
            $validator = Validator::make($request->all(), array(
                'JobSeekerID'  => 'required|integer',
                'CompanyName'  => 'required',
                'PositionName' => 'required',
                'ExperienceID' => 'required',
                'FromDate'  => 'required',
                'ToDate'  => 'required',
                'Salary' => 'required'
            ));
            if($validator->fails()){
                $res = array('error'=>$validator->messages()->all());
                return $this->returnError(405,$validator->messages()->first(), $res);
            }
            $result = $this->experience->update($request->ExperienceID, $request->all());
            if($result){
                return $this->returnSuccess('Cập nhật thành công');
            }else{
                return $this->returnError(403, "Thử lại sau");
            }
        } catch (Exception $e) {
            return $this->returnError(500, "Thử lại sau");
        }
    }
    public function postDeleteJobSeekerExperience(Request $request){
        try {
            $validator = Validator::make($request->all(), array(
                'JobSeekerID' => 'required|integer',
                'id' => '|integer'
            ));
            if($validator->fails()){
                $res = array('error'=>$validator->messages()->all());
                return $this->returnError(405,$validator->messages()->first(), $res);
            }
            $id = $request->id;
            $uid = $request->JobSeekerID;

            $exp = $this->experience->getExperienceWithUidAndID($id, $uid);
            if($exp && $exp->delete()){
                return $this->returnSuccess('Xóa thành công');
            }else{
                return $this->returnError(403,"Thử lại sau");
            }
        } catch (Exception $e) {
            return $this->returnError(500,"Thử lại sau");
        }
    }
}
