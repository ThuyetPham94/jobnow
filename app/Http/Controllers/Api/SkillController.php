<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\Skill\SkillRepository;
use App\Repositories\JobSeekerSkill\JobSeekerSkillRepository;
use App\Repositories\User\UserRepository;
use Validator;
class SkillController extends ApiBaseController
{
    protected $skill;
    protected $jsskill;
    protected $user;
    public function __construct(SkillRepository $skill, JobSeekerSkillRepository $jsskill, UserRepository $user){
        $this->skill = $skill;
        $this->jsskill = $jsskill;
        $this->user = $user;
    }

    public function getListSkill($sign, $app_id, $device_type, $user_id){
        try {
            if($user_id == 0):
                $skill = $this->skill->orderBy('id', 'DESC')->get();
            else:
                $skill = $this->skill->orderBy('id', 'DESC')->get();
                $u_skill = $this->user->getById($user_id)->jobseekerskill->toArray();
                //dd($u_skill);
                if($u_skill){
                    foreach ($skill as $key => $value) {
                        foreach ($u_skill as $key1 => $value1) {
                            //var_dump("__".$value1['pivot']['SkillID']);
                            if($value->id == $value1['pivot']['SkillID']){
                                $value->isSelected = 1;
                                break;
                            }else{
                                $value->isSelected = 0;
                            }
                        }
                    }
                }else{
                    foreach ($skill as $key => $value) {
                        $value->isSelected = 0;
                    }
                }
                
                //die;
            endif;
            return $this->returnSuccess('Success!', $skill);
        } catch (Exception $e) {
            return $this->returnError('500', "Thử lại sau");
        }
    }
    public function postEditSkill(Request $request){
        try {
            $validator = Validator::make($request->all(), array(
                'UserID' => 'required|integer',
            ));
            if($validator->fails()){
                $res = array('error'=>$validator->messages()->all());
                return $this->returnError(405,$validator->messages()->first(), $res);
            }
            $user_id = (int)trim($request->UserID);
            $input = $request->all();
            //dd($input);
            $skill = $this->jsskill->where('JobSeekerID', '=', $user_id)->delete();
            if($request->Skill && $request->Skill != ''){
                foreach ($request->Skill as $key => $value) {
                    $input['JobSeekerID'] = $input['UserID'];
                    $input['SkillID'] = $value;
                    $skill = $this->jsskill->create($input);
                }
            }
            
            return $this->returnSuccess('Skill updated Successfully');
        } catch (Exception $e) {
            return $this->returnError('500', "Thử lại sau");
        }
    }
}
