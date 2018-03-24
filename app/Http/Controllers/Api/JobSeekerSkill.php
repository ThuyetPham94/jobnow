<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\JobSeekerSkill\JobSeekerSkillRepository;
use App\Repositories\User\UserRepository;
use Validator;
class JobSeekerSkill extends ApiBaseController
{
    protected $seekerskill;
    protected $user;
    public function __construct(JobSeekerSkillRepository $seekerskill, UserRepository $user){
        $this->seekerskill = $seekerskill;
        $this->user = $user;
    }
    public function getAllJobSeekerSkill($sign, $app_id, $device_type, $user_id){
        try {
            $seekerskill = $this->user->getById($user_id)->jobseekerskill;
            if($seekerskill){
                foreach ($seekerskill as $key => $value) {
                    $value->SkillName = $value->skill->Name;
                    unset($value->skill);
                }
                return $this->returnSuccess('Success!', $seekerskill);
            }else{
                return $this->returnError(404, 'No Data Response !');
            }
        } catch (Exception $e) {
            return $this->returnError(500, "Thử lại sau");
        }
    }

    public function getAllUserSkill($sign, $app_id, $device_type, Request $request){
        try {
            $seekerskill = $this->user->getById($request->user_id)->jobseekerskill;
            if($seekerskill){
                foreach ($seekerskill as $key => $value) {
                    $value->SkillName = $value->skill->Name;
                    unset($value->skill);
                }
                return $this->returnSuccess('Success!', $seekerskill);
            }else{
                return $this->returnError(404, 'No Data Response !');
            }
        } catch (Exception $e) {
            return $this->returnError(500, "Thử lại sau");
        }
    }

    public function postAddJobSeekerSkill(Request $request){
        try {
            $validator = Validator::make($request->all(), array(
                'JobSeekerID' => 'required|integer',
                'SkillID' => 'required|integer',
                'PositionName' => 'required',
            ));
            if($validator->fails()){
                $res = array('error'=>$validator->messages()->all());
                return $this->returnError(405,$validator->messages()->first(), $res);
            }
            $check = $this->seekerskill->where('JobSeekerID', '=', $request->JobSeekerID)->where('SkillID', '=', $request->SkillID)->first();
            if(!$check){
                $result = $this->seekerskill->create($request->all());
            }else{
                return $this->returnError(406, 'Skill already exists!');
            }            
            if($result){
                return $this->returnSuccess('Thêm kỹ năng thành công');
            }else{
                return $this->returnError(403, "Thử lại sau");
            }
        } catch (Exception $e) {
            return $this->returnError(500, "Thử lại sau");
        }
    }

    public function postDeleteJobSeekerSkill(Request $request){
        try {
            $validator = Validator::make($request->all(), array(
                'JobSeekerID' => 'required|integer',
                "id"          => 'required|integer',
            ));
            if($validator->fails()){
                $res = array('error'=>$validator->messages()->all());
                return $this->returnError(405,$validator->messages()->first(), $res);
            }
            $id = $request->id;
            $uid = $request->JobSeekerID;

            $skill = $this->seekerskill->getSkillWithUidAndID($id, $uid);
            if($skill && $skill->delete()){
                return $this->returnSuccess('Xóa thành công');
            }else{
                return $this->returnError(403,"Thử lại sau");
            }
        } catch (Exception $e) {
            return $this->returnError(500,"Thử lại sau");
        }
    }
}
