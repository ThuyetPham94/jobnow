<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\Job\JobRepository;
use App\Repositories\JobSeeker\JobSeekerRepository;
use App\Repositories\SavedJob\SavedJobRepository;
use App\Repositories\Location\LocationRepository;
use App\Models\CompanyProfile;
use App\Repositories\CompanyProfile\CompanyProfileRepository;
use App\Repositories\AppliedJob\AppliedJobRepository;
use App\Repositories\Industry\IndustryRepository;
use App\Repositories\Currency\CurrencyRepository;
use App\Repositories\JobActstatic\JobActstaticRepository;
use App\Repositories\JobSkill\JobSkillRepository;
use App\Repositories\Skill\SkillRepository;
use App\Http\Controllers\NotificationController;
use App\Models\Experience;
use Mockery\Exception;
use Validator;
use Carbon\Carbon;
use App\Models\Job;
use Illuminate\Support\Facades\DB;
use Config;
use App\Http\Requests\JobRequest;
use App\User;
use App\Repositories\User\UserRepository;
use App\Repositories\Interview\InterviewRepository;
class JobsController extends ApiBaseController
{
    protected $job;
    protected $savejob;
    protected $location;
    protected $companyprofile;
    protected $applyjob;
    protected $industry;
    protected $currency;
    protected $JobActstatic;
    protected $JobSkill;
    protected $skill;
    protected $User;
    protected $JobSeeker;
    protected $notify;
    protected $interview;
    public function __construct(JobRepository $job, SavedJobRepository $savejob, LocationRepository $location, CompanyProfileRepository $companyprofile, AppliedJobRepository $applyjob, IndustryRepository $industry, CurrencyRepository $currency,JobActstaticRepository $JobActstatic,
        JobSkillRepository $JobSkill,SkillRepository $skill,UserRepository $User,JobSeekerRepository $JobSeeker,NotificationController $notify,InterviewRepository $interview){
        $this->job            = $job;
        $this->savejob        = $savejob;
        $this->location       = $location;
        $this->companyprofile = $companyprofile;
        $this->applyjob       = $applyjob;
        $this->industry       = $industry;
        $this->currency       = $currency;
        $this->JobActstatic   = $JobActstatic;
        $this->JobSkill   = $JobSkill;
        $this->skill   = $skill;
        $this->User   = $User;
        $this->JobSeeker   = $JobSeeker;
        $this->notify = $notify;
        $this->interview = $interview;
    }

    public function getListJob(Request $request,$sign, $app_id, $device_type){
        try {

            $data = $this->job->orderBy('id','DESC');
//            if ($request->JobID && $request->JobID != 0)
//            {
//                $data = $data->where('id', '=', $request->JobID);
//            }
            //$request->Title = ' ';
            if($request->Title != ''){
                $title_ = $this->vn_str_filter($request->Title);
                $data = Job::select('Job.*','CompanyProfile.Name')
                                ->where('Title', 'like', '%'.trim($title_).'%')
                                ->join('CompanyProfile','CompanyProfile.CompanyID','=','Job.CompanyID')
                                ->orwhere('CompanyProfile.Name','like','%'.trim($title_).'%')
                                ->orderBy('id','DESC');
                //dd($data);die();
            }
            if($request->IndustryID && $request->IndustryID != ''){
                $data = $data->where('IndustryID', '=', (int)trim($request->IndustryID));
            }
            if($request->isEmployee == null)
            {
                if($request->MinSalary && $request->MinSalary != '' ){
                $data = $data->where('FromSalary', '>=', (int)$request->MinSalary);
                if($request->ToSalary && $request->ToSalary != ''){
                    $data = $data->where('ToSalary', '<=', (int)$request->ToSalary);
                }
                }else{
                    if($request->FromSalary && $request->FromSalary != ''){
                        $data = $data->where('FromSalary', '>=', (int)$request->FromSalary);
                    }
                    if($request->ToSalary && $request->ToSalary != ''){
                        $data = $data->where('ToSalary', '<=', (int)$request->ToSalary);
                    }

                }
            }
//
//
            // if($request->Location && $request->Location != ''){
            //     $input_location = explode(',',$request->Location);

            //     $data = $data->where(function ($query)  use ($input_location)  {
            //         foreach ($input_location as $value) {
            //             $query->orWhere('LocationID', '=',$value);
            //         }
            //     });
            // }
//
            if($request->Skill && $request->Skill != ''){
                $arrskill = explode(',',$request->Skill);
                $data = $data->whereHas('skill', function ($query) use ($arrskill) {
                    $query->where(function ($q) use ($arrskill) {
                        foreach ($arrskill as $value) {
                            $q->orWhere('SkillID', '=', $value);
                        }
                    });
                });
            }

            if($request->isEmployee == 1)
            {
                $today = Date('20y-m-d');
                if($request->isHiring == 1)
                {
                    $data = $data->where('DateExprire','>=',$today)
                            ->where('CompanyID','=',$request->CompanyID)
                            ->where('IsActive', '=',1);
                }
                else
                {
                    $data = $data->where('DateExprire','<',$today)
                            ->where('CompanyID','=',$request->CompanyID)
                            ->orWhere('IsActive', '=',0)
                            ->where('CompanyID', '=',$request->CompanyID);


                }
            }

           $data = $data->where('IsActive', '!=' , 0);
           switch ($request->Order) {
               case 'ASC':
                   $data = $data->orderBy('id', 'ASC');
                   break;
               case 'DESC':
                   $data = $data->orderBy('id', 'DESC');
                   break;
               default:
                   $data = $data->orderBy('id', 'DESC');
                   break;
           }
            if($request->IsParttime ==1) {
                $data = $data->where('EmploymentID', '=', 2);
            }else if($request->IsParttime ==-1){

            }else{
                $data = $data->where('EmploymentID', '<>', 2);
            }
            $data = $data->paginate(10);
            $data = $data->toArray();
            $comProfile;
            if($data){
                foreach ($data['data'] as $key => &$value) {
                    $value['LocationName'] = ($this->location->getById($value['LocationID']))?$this->location->GetById($value['LocationID'])->Name:"";
                    $comProfile = CompanyProfile::where('CompanyID','=',$value['CompanyID'])->first();
                    //$comProfile = DB::select('select * from CompanyProfile where CompanyID = ?',array($value['CompanyID']));
                    $value['CompanyName']  = $comProfile ? $comProfile->Name:"";
                    $value['CompanyLogo']  = $comProfile ? Config::get('images.base_domain').Config::get('images.image_company_url_logo').$comProfile->Logo:"";

                    //$value['CompanyLogo']  = ($this->companyprofile->getById($value['CompanyID']))?Config::get('images.base_domain').Config::get('images.image_company_url_logo').$this->companyprofile->GetById($value['CompanyID'])->Logo:"";
                    $value['IndustryName']     = ($this->industry->getById($value['IndustryID']))?$this->industry->GetById($value['IndustryID'])->Name:"";
                    $value['CurrencyName']     = ($this->currency->getById($value['CurrencyID']))?$this->currency->GetById($value['CurrencyID'])->Name:"";
                    $value['CreateDate_int']     = DB::select('select UNIX_TIMESTAMP(?) as time_int',array($value['CreateDate']))[0]->time_int;
                    $value['created_at_int']     = DB::select('select UNIX_TIMESTAMP(?) as time_int',array($value['created_at']))[0]->time_int;
                    $value['updated_at_int']     = DB::select('select UNIX_TIMESTAMP(?) as time_int',array($value['updated_at']))[0]->time_int;
                    $value['Start_date_int']     = DB::select('select UNIX_TIMESTAMP(?) as time_int',array($value['Start_date']))[0]->time_int;
                    $value['End_date_int']     = DB::select('select UNIX_TIMESTAMP(?) as time_int',array($value['End_date']))[0]->time_int;
                }
                /*if($request->Title && $request->Title != ''){
                    foreach ($data['data'] as $key => &$value) {
                        if (strpos($value['CompanyName'], trim($request->Title)) === FALSE && strpos($value['Title'], trim($request->Title) === FALSE)
                            && strpos($value['LocationName'], trim($request->Title)) === FALSE) {
                            unset($data['data'][$key]);
                        }
                    }
                }*/

            }

            return $this->returnSuccess("Success!", $data);
        } catch (Exception $e) {
            return $this->returnError(500, 'We\'re sorry, we are unable to proceed your request at this time. Please try again later.');
        }
    }

    public function postSaveJob(Request $request){
        try {
            $validator = Validator::make($request->all(), array(
                'JobSeekerID' => 'required|integer',
                'JobID' => 'integer|required',
            ));
            if($validator->fails()){
                $res = array('error'=>$validator->messages()->all());
                return $this->returnError(405,$validator->messages()->first(), $res);
            }
            $input = $request->all();
            $input['CreateDate'] = Carbon::now();
            $check = $this->savejob->checkExitsData($request->JobSeekerID, $request->JobID);
            if($check){
                return $this->returnError(406, "Thử lại sau");;
            }else{
                $result = $this->savejob->create($input);
                if($result) return $this->returnSuccess('Job saved successfully');
                return $this->returnError(404, "Thử lại sau");
            }
        } catch (Exception $e) {
            return $this->returnError(500, "Thử lại sau");
        }
    }

    public function postAppliedJob(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), array(
                'JobSeekerID' => 'required|integer',
                'JobID' => 'integer|required',
            ));
            if ($validator->fails()) {
                $res = array('error' => $validator->messages()->all());
                return $this->returnError(405, $validator->messages()->first(), $res);
            }
            $input = $request->all();
            $check = $this->applyjob->checkExitsData($request->JobSeekerID, $request->JobID);
            if ($check) {
                return $this->returnError(406, 'Job already exists!');
            } else {
                $result = $this->applyjob->create($input);
                if ($result)
                {
                    $data = $this->job->getById($request->JobID);
                    $JobS = $this->JobSeeker->where('user_id', '=', $request->JobSeekerID)->first();
                    $input = array();
                    $input['CompanyID'] = $data['CompanyID'];
                    $input['JobSeekerID'] = $request->JobSeekerID;
                    $input['InterviewDate'] = Date("20y-m-d");
                    $input['Status'] = 4;
                    //create interview
                    $interview_ = $this->interview->create($input);
                    $this->notify->setNotificationInterview($data->CompanyID,$request->JobSeekerID,$request->JobID,'Apply Job',$JobS ->FullName.' would like to apply your job',2,0,1,$interview_->id);
                    return $this->returnSuccess('Job applied successfully');
                }

                return $this->returnError(404, "Thử lại sau");
            }
        } catch (Exception $e) {
            return $this->returnError(500, "Thử lại sau");
        }
    }

    public function getAppliedJob($sign, $app_id, $device_type, $user_id){
        try {
            $applyjob = $this->applyjob->where('JobSeekerID', '=', $user_id)
                        ->orderBy('id','DESC')
                        ->paginate(10)->toArray();
            if($applyjob){
                foreach ($applyjob['data'] as $key => &$value) {
                    $jobs = $this->job->getById($value['JobID']);
                    $CompanyInfo = ($this->companyprofile->where('CompanyID','=',$jobs->CompanyID)->first());
                    $value['JobID']            = $jobs->id;
                    $value['CompanyID']        = $jobs->CompanyID;
                    $value['CompanyName']      = $CompanyInfo ? $CompanyInfo ->Name:"";
                    $value['CompanyLogo']      = $CompanyInfo ? Config::get('images.base_domain').Config::get('images.image_company_url_logo').$CompanyInfo->Logo:"";
                    $value['Title']            = $jobs->Title;
                    $value['Position']         = $jobs->Position;
                    $value['YearOfExperience'] = $jobs->YearOfExperience;
                    $value['Level']            = $jobs->Level;
                    $value['LocationID']       = $jobs->LocationID;
                    $value['LocationName']     = ($this->location->getById($value['LocationID']))?$this->location->GetById($value['LocationID'])->Name:"";
                    $value['IndustryID']       = $jobs->IndustryID;
                    $value['IndustryName']     = ($this->industry->getById($value['IndustryID']))?$this->industry->GetById($value['IndustryID'])->Name:"";
                    $value['FromSalary']       = $jobs->FromSalary;
                    $value['ToSalary']         = $jobs->ToSalary;
                    $value['CurrencyID']       = $jobs->CurrencyID;
                    $value['CurrencyName']     = ($this->currency->getById($value['CurrencyID']))?$this->currency->GetById($value['CurrencyID'])->Name:"";
                    $value['Description']      = $jobs->Description;
                    $value['Requirement']      = $jobs->Requirement;
                    $value['CreateDate']       = $jobs->created_at;
                    $value['IsDisplaySalary']  = $jobs->IsDisplaySalary;
                    $value['updated_at_int']   = DB::select('select UNIX_TIMESTAMP(?) as time_int',array($jobs->created_at))[0]->time_int;
                }
            }
            return $this->returnSuccess('Success!', $applyjob);
        } catch (Exception $e) {
            return $this->returnError(500, "Thử lại sau");
        }
    }

    public function getJobDetail($sign, $app_id, $device_type,$user_id, $job_id){
        try {
            $job = $this->job->getById($job_id);
            if($job){
                $exp = Experience::find($job->ExperienceID);
                $job->ExperienceName = $exp->Name;
                $CompanyInfo = ($this->companyprofile->where('CompanyID','=',$job->CompanyID)->first());
                $job->CompanyName      = $CompanyInfo ? $CompanyInfo->Name:"";
                $job->CompanyLogo = $CompanyInfo?Config::get('images.base_domain').Config::get('images.image_company_url_logo').$CompanyInfo->Logo:"";
                $job->LocationName      = ($this->location->getById($job->LocationID))?$this->location->GetById($job->LocationID)->Name:"";
                $job->IndustryName      = ($this->industry->getById($job->IndustryID))?$this->industry->GetById($job->IndustryID)->Name:"";
                $job->CurrencyName      = ($this->currency->getById($job->CurrencyID))?$this->currency->GetById($job->CurrencyID)->Name:"";
                $job->CountUserApplyJob = $this->applyjob->where('JobID', '=', $job_id)->count();
                $job->IsApplyJob = ($this->applyjob->where('JobSeekerID', '=', $user_id)->where('JobID', '=', $job_id)->count()>0)?true:false;
                $job->IsSaveJob = ($this->savejob->where('JobSeekerID', '=', $user_id)->where('JobID', '=', $job_id)->count()>0)?true:false;
                $job->ShareUrl = Config('images.base_domain').'jobs/detail/'.$job_id;
                $job->updated_at_int   = DB::select('select UNIX_TIMESTAMP(?) as time_int',array($job->created_at))[0]->time_int;
            }
            return $this->returnSuccess('Success!', $job);
        } catch (\Exception $e) {
            return $this->returnError(500, "Thử lại sau");
        }
    }

    public function getCountJob($sign, $app_id, $device_type, $location_id){
        try {
            if($location_id == 0):
                $count_job = $this->job->count();
            else:
                $count_job = $this->job->where('LocationID', '=', $location_id)->count();
            endif;
            return $this->returnSuccess('Success', $count_job);
        } catch (Exception $e) {
            return $this->returnError(500, "Thử lại sau");
        }
    }

    public function getSaveJob($sign, $app_id, $device_type, $user_id){
        try{
            $savejob = $this->savejob->where('JobSeekerID', '=', $user_id)->orderBy('id','DESC')->paginate(10)->toArray();

            if($savejob){
                foreach ($savejob['data'] as $key => &$value) {
                    $jobs = $this->job->getById($value['JobID']);
                    //unset($savejob['data'][0]);
                    if($jobs):
                        $value['JobID']            = $jobs->id;
                        $value['CompanyID']        = $jobs->CompanyID;
                        $CompanyInfo = ($this->companyprofile->where('CompanyID','=',$jobs->CompanyID)->first());
                        $value['CompanyName']      = $CompanyInfo ? $CompanyInfo->Name:"";
                        $value['CompanyLogo']      = $CompanyInfo ? Config::get('images.base_domain').Config::get('images.image_company_url_logo').$CompanyInfo->Logo:"";
                        $value['Title']            = $jobs->Title;
                        $value['Position']         = $jobs->Position;
                        $value['YearOfExperience'] = $jobs->YearOfExperience;
                        $value['Level']            = $jobs->Level;
                        $value['LocationID']       = $jobs->LocationID;
                        $value['LocationName']     = ($this->location->getById($value['LocationID']))?$this->location->GetById($value['LocationID'])->Name:"";
                        $value['IndustryID']       = $jobs->IndustryID;
                        $value['IndustryName']     = ($this->industry->getById($value['IndustryID']))?$this->industry->GetById($value['IndustryID'])->Name:"";
                        $value['FromSalary']       = $jobs->FromSalary;
                        $value['ToSalary']         = $jobs->ToSalary;
                        $value['CurrencyID']       = $jobs->CurrencyID;
                        $value['CurrencyName']     = ($this->currency->getById($value['CurrencyID']))?$this->currency->GetById($value['CurrencyID'])->Name:"";
                        $value['Description']      = $jobs->Description;
                        $value['Requirement']      = $jobs->Requirement;
                        $value['CreateDate']       = $jobs->created_at;
                        $value['IsDisplaySalary']  = $jobs->IsDisplaySalary;
                        $value['updated_at_int']   = DB::select('select UNIX_TIMESTAMP(?) as time_int',array($jobs->created_at))[0]->time_int;
                    else:
                        //unset($savejob['data'][$key]);
                        //array_diff_key($savejob['data'],[0=>'a']);
                    endif;
                }
            }
            return $this->returnSuccess('Success!', $savejob);
        }catch(Exception $e){
            return $this->returnError(500, "Thử lại sau");
        }
    }

    public function postDeleteSaveJob(Request $request){
        try {
            $validator = Validator::make($request->all(), array(
                'JobSeekerID' => 'required|integer',
                'JobID' => 'integer|required',
            ));
            $res = $this->savejob->where('JobSeekerID','=',$request->JobSeekerID)->where('JobID','=',$request->JobID)->first();
            //dd($res);
            if($res){
                $this->savejob->where('JobSeekerID','=',$request->JobSeekerID)->where('JobID','=',$request->JobID)->delete();
                return $this->returnSuccess('Job deleted successfully');
            }else{
                return $this->returnSuccess(500, "Thử lại sau");
            }
        } catch (Exception $e) {
            return $this->returnSuccess(502, "Thử lại sau");
        }
    }

    public function postDeleteAppliedJob(Request $request){
        try {
            $validator = Validator::make($request->all(), array(
                'JobSeekerID' => 'required|integer',
                'JobID' => 'integer|required',
            ));
            $res = $this->applyjob->where('JobSeekerID','=',$request->JobSeekerID)->where('JobID','=',$request->JobID)->first();
            if($res){
                $this->applyjob->where('JobSeekerID','=',$request->JobSeekerID)->where('JobID','=',$request->JobID)->delete();
                return $this->returnSuccess('Job deleted successfully');
            }else{
                return $this->returnSuccess(500,"Thử lại sau");
            }
        } catch (Exception $e) {
            return $this->returnSuccess(502, "Thử lại sau");
        }
    }

    public function getListJobInLocation($sign, $app_id, $device_type, $lat, $lng){
        $res = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?latlng='.$lat.','.$lng.'&sensor=false');
        $res = json_decode($res);
        if($res->results[1]->address_components && $res->results[1]->address_components[2]->long_name){
            $location = $res->results[1]->address_components[2]->long_name;
        }else if($res->results[0]->address_components && $res->results[0]->address_components[5]->long_name){
            $location = $res->results[0]->address_components[5]->long_name;
        }else{
            $location = "Hà Nội";
        }
        $id_location = $this->location->where('Name', 'like', '%'.$location.'%')->first();
        if($id_location){
            $result = array();
            $job = $this->job->where('LocationID', '=', $id_location->id)->get();
            foreach ($job as $key => $value) {
                $value->CompanyName      = ($this->companyprofile->getById($value->CompanyID))?$this->companyprofile->GetById($value->CompanyID)->Name:"";
                $value->CompanyLogo = ($this->companyprofile->getById($value->CompanyID))?Config::get('images.base_domain').Config::get('images.image_company_url_logo').$this->companyprofile->GetById($value->CompanyID)->Logo:"";
                $value->LocationName      = ($this->location->getById($value->LocationID))?$this->location->GetById($value->LocationID)->Name:"";
                $value->IndustryName      = ($this->industry->getById($value->IndustryID))?$this->industry->GetById($value->IndustryID)->Name:"";
                $value->CurrencyName      = ($this->currency->getById($value->CurrencyID))?$this->currency->GetById($value->CurrencyID)->Name:"";
                $value->CountUserApplyJob = $this->applyjob->where('JobID', '=', $value->id)->count();
                
            }
            return $this->returnSuccess('Success', $job);
        }else{
            $result = array();
            $job = $this->job->get();
            foreach ($job as $key => $value) {
                $value->CompanyName      = ($this->companyprofile->getById($value->CompanyID))?$this->companyprofile->GetById($value->CompanyID)->Name:"";
                $value->CompanyLogo = ($this->companyprofile->getById($value->CompanyID))?Config::get('images.base_domain').Config::get('images.image_company_url_logo').$this->companyprofile->GetById($value->CompanyID)->Logo:"";
                $value->LocationName      = ($this->location->getById($value->LocationID))?$this->location->GetById($value->LocationID)->Name:"";
                $value->IndustryName      = ($this->industry->getById($value->IndustryID))?$this->industry->GetById($value->IndustryID)->Name:"";
                $value->CurrencyName      = ($this->currency->getById($value->CurrencyID))?$this->currency->GetById($value->CurrencyID)->Name:"";
                $value->CountUserApplyJob = $this->applyjob->where('JobID', '=', $value->id)->count();
                
            }
            return $this->returnSuccess('Success', $job);
        }
        
    }

    public function postDeleteJob(Request $request){
        try {
            $res = $this->applyjob->where('JobID','=',$request->JobID)->delete();
            $res = $this->savejob->where('JobID','=',$request->JobID)->delete();
            $res = $this->JobActstatic->where('JobID','=',$request->JobID)->delete();
            $res = $this->JobSkill->where('JobID','=',$request->JobID)->delete();
            $this->job->where('id','=',$request->JobID)->delete();
            return $this->returnSuccess('Xóa thành công');
        } catch (Exception $e) {
            return $this->returnSuccess(502, "Thử lại sau");
        }
    }

    public function postCreateJob(Request $request) {
        try {
            $input = $request->all();
            $input['CompanyID'] = $request -> UserID;
            $user = User::where('id', $request -> UserID)->first();
            $result = null;
            $numCredit=0;
            if($user->CreditNumber >= 1){
                $today=date('Y-m-d');
                if($user->IsTrial == 1 ){
                    $next_date= date('Y-m-d', strtotime($today. ' + 14 days'));
                    $input['DateExprire'] = $next_date;
                }else{
                    $next_date= date('Y-m-d', strtotime($today. ' + 30 days'));
                    $input['DateExprire'] = $next_date;
                }
                $result = $this->job->create($input);
                $arr = array();
                $arr['CreditNumber'] = $user->CreditNumber - 1;
                $numCredit = $arr['CreditNumber'];
                $this->User->update($request -> UserID,$arr);
            }
            if ($result) {
                if ($request->Skill && $request->Skill != '') {
                    foreach ($request->Skill as $key => $value) {
                        $check_job_skill = $this->JobSkill->where('JobID', '=', $result->id)->where('SkillID', '=', $value)->first();
                        if (!$check_job_skill)
                            $this->JobSkill->create(['JobID' => $result->id, 'SkillID' => $value]);
                    }
                }
                $this->JobActstatic->create(['JobID' => $result->id]);
                return $this->returnSuccess($numCredit,'Đăng việc thành công');
            }else {
                return $this->returnError(404,'Mời thêm credit để được post job');
            }
        } catch (Exception $e) {
            return $this->returnError(502, "Thử lại sau");
        }
    }

    public function postEditJob(Request $request) {
        try {
            $input = $request->all();
            $input['CompanyID'] = $request -> UserID;
            $result = $this->job->update($input['JobID'],$input);
            if ($result) {
                return $this->returnSuccess(200,'Cập nhật thành công');
            }else {
                return $this->returnError(404,"Thử lại sau");
            }
        } catch (Exception $e) {
            return $this->returnError(502, "Thử lại sau");
        }
    }

    public function getIndustry($sign, $app_id, $device_type,Request $request){
        try {
            $Industry = $this->industry->get();
            $skill_ = $this->skill->get();

            foreach ($Industry as $key => $value) {
                $value->data = $this->skill->where('IndustryID', '=', $value['id'])->get();
            }
            return $this->returnSuccess('Success!', $Industry);
        } catch (Exception $e) {
            return $this->returnError('500', "Thử lại sau");
        }
    }

    public function getListLevel($sign, $app_id, $device_type,Request $request){
        try {
            $listLevel = DB::select('SELECT * FROM JobLevel',array());
            $collection = collect($listLevel);
            return $this->returnSuccess('Success!', $collection);
        } catch (Exception $e) {
            return $this->returnError('500', "Thử lại sau");
        }
    }

    public function extendJob(Request $request)
    {
        try {
            $user = User::where('id', $request -> UserID)->first();
            //dd(Auth::user()->CreditNumber);die();
            if($user->CreditNumber >0 ){
                //$job = $this->Job->getById($id);
                $today = date('Y-m-d');
                $date = date('Y-m-d', strtotime($today .' + 7 days'));
                $input['DateExprire'] = $date;
                $this->job->update($request->JobID,$input);
                $arr = array();
                $arr['CreditNumber'] = $user->CreditNumber - 0.5;
                $this->User->update($request->UserID,$arr);
                return $this->returnSuccess('Gia hạn thành công',$arr['CreditNumber']);
            }else{
                return $this->returnError(404, "Thử lại sau");
            }
        } catch (Exception $e) {
            return $this->returnError('500', "Thử lại sau");
        }
    }

    public function vn_str_filter ($str){
        $unicode = array(
            'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
            'd'=>'đ',
            'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
            'i'=>'í|ì|ỉ|ĩ|ị',
            'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
            'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
            'y'=>'ý|ỳ|ỷ|ỹ|ỵ',
            'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
            'D'=>'Đ',
            'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
            'I'=>'Í|Ì|Ỉ|Ĩ|Ị',
            'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
            'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
            'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ',
        );

        foreach($unicode as $nonUnicode=>$uni){
            $str = preg_replace("/($uni)/i", $nonUnicode, $str);
        }
        return $str;
    }

}
