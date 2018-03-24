<?php

namespace App\Http\Controllers\Api;

use App\Models\JobSeeker;
use App\Models\Notification;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\Interview\InterviewRepository;
use App\Models\Interview;
use Illuminate\Support\Facades\DB;
use Config;
use App\Http\Controllers\NotificationController;
use App\Repositories\CompanyProfile\CompanyProfileRepository;
use App\Repositories\JobSeeker\JobSeekerRepository;
use App\Repositories\User\UserRepository;
use Mail;
class InterviewController extends ApiBaseController
{
    protected $Interview;
    protected $notify;
    protected $JobSeeker;
    protected $CompanyProfile;
    protected $User;
    public function __construct(InterviewRepository $Interview,NotificationController $notify,CompanyProfileRepository $CompanyProfile,
                                JobSeekerRepository $JobSeeker,UserRepository $User){
        $this->Interview = $Interview;
        $this->notify = $notify;
        $this->CompanyProfile = $CompanyProfile;
        $this->JobSeeker = $JobSeeker;
        $this->User = $User;
    }

    public function setInterview(Request $request) {
        try {
            $input = $request->all();
            $result;
            if($request->id != 0 && $request->id != null)
            {
                $result = $this->Interview->update($request->id,$input);
            }
            else
            {
                $result = $this->Interview->create($input);

            }
            $this->notify->setNotificationInterview($request->CompanyID,$request->JobSeekerID,0,'Interview Invitation','I would like to invite you to attend an interview',1,0,0,$result->id);
            $CompanyProfile = $this->CompanyProfile->where('CompanyID','=',$request->CompanyID)->first();

            $JobSeeker = $this->JobSeeker->where('user_id','=',$request->JobSeekerID)->first();
            $User = $this->User->where('id','=',$request->JobSeekerID)->first();

            Mail::send(['html'=>'company.modules.test_email.send_interview'], array('company'=>$CompanyProfile->Name,
                'datetime'=>$request->InterviewDate,'Name'=>$JobSeeker->FullName,'Title'=>$request->Title,'Location'=>$request->Location,
                'Manage'=>$request->ContactName,'Start_time'=>$request->Start_time,'End_time'=>$request->End_time), function ($message) use($CompanyProfile,$JobSeeker,$request,$User){

                $message->to($User ->Email, 'Visitor')->subject('Invitation/Interview with '.$CompanyProfile->Name.' for the '.$request->Title.' position');

            });
            if($result) return $this->returnSuccess('Cập nhật thành công');
                return $this->returnError(404, "Thử lại sau");
        } catch (\Exception $e) {
            return $this->returnError(500, "Thử lại sau");
        }
    }

    public function deleteInterview(Request $request) {
        try {
            //$inteview = $this->Interview->where('id','=',)->first();
            $inteview =  Interview::find($request->InterviewID);
            if($inteview)
            {
                if($request->IsCompany == 1)
                {
                    $inteview->IsDeleteCompany = 1;
                }
                else
                {
                    $inteview->IsDeleteJobSeeker = 1;
                }
                $inteview->save();
                return $this->returnSuccess('Xóa thành công');
            }
            return $this->returnError(404, "Thử lại sau");
        } catch (Exception $e) {
            return $this->returnError(500, "Thử lại sau");
        }
    }

    public function getInterviewDetail($sign, $app_id, $device_type,Request $request){
        try {
            $CompanySize = $this->Interview
                                ->where('CompanyID','=',$request->CompanyID)
                                ->where('JobSeekerID','=',$request->JobSeekerID)
                                ->orderBy('id', 'ASC')
                                ->first();
            return $this->returnSuccess('Success!', $CompanySize);
        } catch (Exception $e) {
            return $this->returnError('500', "Thử lại sau");
        }
    }

    public function getAnInterviewDetail($sign, $app_id, $device_type,Request $request){
        try {
            $listInterview = DB::select('call sp_getDetailInterview(?)',array($request->InterviewID));
            $collection = collect($listInterview);
            if($collection)
            {
                foreach ($collection as $key => $value) {
                    if(substr(trim($value->CompanyAvatar), 0,4) !== 'http'){
                        $value->CompanyAvatar  = Config::get('images.base_domain').Config::get('images.url').$value->CompanyAvatar;
                    }
                }
                return $this->returnJSON(200,'Success!', $collection['0']);
            }
            else
            {
                return $this->returnJSON(200,'Success!','');
            }
        } catch (\Exception $e) {
            return $this->returnError('500', "Thử lại sau");
        }
    }

    public function getListInterView($sign, $app_id, $device_type,Request $request){
        try {
            //dd('fe');die;
            
            //$listInterview
            if( $request->CompanyID != 0){
                $listInterview = Interview::select('Interview.*','JobSeeker.Avatar','JobSeeker.FullName','Country.Name','users.Email')
                                ->join('JobSeeker','JobSeeker.user_id','=','Interview.JobSeekerID')
                                ->join('Country','Country.id','=','JobSeeker.CountryID')
                                ->join('users','users.id','=','Interview.JobSeekerID')
                                ->get();
            }else{
                $listInterview = DB::select('call sp_getListInterview(?,?)',array(0,$request->JobSeekerID));
            }
            $collection = collect($listInterview);
            foreach ($collection as $key => $value) {
                if($request->CompanyID != 0){
                    $value->InterviewDate_int =  DB::select('select UNIX_TIMESTAMP(?) as InterviewDate_int',array($value->InterviewDate))[0]->InterviewDate_int;
                    //DB::select('call func_setTime(?,?)',array($value->InterviewDate,$value->End_time));
                }
                if(substr(trim($value->Avatar), 0,4) !== 'http'){
                    $value->Avatar  = Config::get('images.base_domain').Config::get('images.url').$value->Avatar;
                }
                if($request->CompanyID ==0)
                {
                    if(substr(trim($value->CompanyAvatar), 0,4) !== 'http'){
                        $value->CompanyAvatar  = Config::get('images.base_domain').Config::get('images.image_company_url_logo').$value->CompanyAvatar;
                    }
                }


            }
            return $this->returnSuccess('Success!', $collection);
        } catch (Exception $e) {
            return $this->returnError('500', "Thử lại sau");
        }
    }

    public function updateInterviewStatus(Request $request) {
        try {
            $inteview =  Interview::find($request->InterviewID);
            if($inteview)
            {
                $message = $request->Status == 2 ? 'accepted' : 'rejected';
                $JobSeeker = $this->JobSeeker->where('user_id','=',$inteview->JobSeekerID)->first();
                $this->notify->setNotificationInterview($inteview->CompanyID,$inteview->JobSeekerID,0,'Interview Reply',$JobSeeker->FullName.' has '.$message.' your company interview.',3,0,1,$inteview->id);
                $inteview->Status = $request->Status;
                $inteview->save();
                return $request->Status == 2 ? $this->returnSuccess('Chấp nhận phỏng vấn thành công') : $this->returnSuccess('Interview rejected successfully');
            }
            return $this->returnError(404, "Thử lại sau");
        } catch (Exception $e) {
            return $this->returnError(500, "Thử lại sau");
        }
    }

    public function rejectInterview(Request $request) {
        try {
            $inteview =  Interview::find($request->InterviewID);
            if($inteview)
            {
                $Company = $this->CompanyProfile->where('CompanyID','=',$inteview->CompanyID)->first();
                $JobSeeker_ = JobSeeker::select('JobSeeker.FullName','users.Email')
                                    ->join('users','users.id','=','user_id')
                                    ->where('user_id','=',$inteview->JobSeekerID)
                                    ->first();
                $Notifi = Notification::select('Job.Title')->where('InterviewID','=',$request->InterviewID)
                                        ->where('isCompany','=',1)
                                        ->where('JobID','<>',0)
                                        ->join('Job','Job.id','=','Notification.JobID')
                                        ->first();
                $this->notify->setNotificationInterview($inteview->CompanyID,$inteview->JobSeekerID,0,'Application Status',' Your application to '.$Company->Name.' is not selected',3,0,0,$inteview->id);
                Mail::send(['html'=>'company.modules.test_email.rejectInterview'], array('companyName'=>$Company->Name,'username'=>$JobSeeker_->FullName,'jobTitle'=>$Notifi->Title), function ($message) use($Company,$JobSeeker_){
                    $message->to($JobSeeker_->Email, 'Visitor')->subject('JobNow –Your application to '.$Company->Name );
                });
                    $inteview->IsReject = 1;
                    $inteview->save();
                return $this->returnSuccess('Từ chối phỏng vấn thành công');
            }
            return $this->returnError(404,"Thử lại sau");
        } catch (\Exception $e) {
            return $this->returnError(500, "Thử lại sau");
        }
    }

}
