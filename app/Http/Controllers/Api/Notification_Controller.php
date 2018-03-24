<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\User;
use Input;
use App\Http\Controllers\NotificationController;
use App\Repositories\User\UserRepository;
use App\Repositories\JobSeeker\JobSeekerRepository;
use App\Repositories\CompanyProfile\CompanyProfileRepository;
use App\Repositories\Notification\NotificationRepository;
use App\Repositories\Job\JobRepository;
use Mockery\Exception;
use Carbon\Carbon;
use Config;
class Notification_Controller extends ApiBaseController
{

    protected $notify;
    protected $User;
    protected $CompanyProfile;
    protected $JobSeeker;
    protected $NotificationRepository;
    protected $Job;
    public function __construct(NotificationController $notify,UserRepository $User,JobSeekerRepository $JobSeeker,
                                CompanyProfileRepository $CompanyProfile,NotificationRepository $Notification,JobRepository $Job){
        $this->notify = $notify;
        $this->User   = $User;
        $this->JobSeeker   = $JobSeeker;
        $this->CompanyProfile   = $CompanyProfile;
        $this->Notification   = $Notification;
        $this->Job   = $Job;
    }

    public function setNotification(Request $request) {
        try {
            $input = $request->all();
            Notification::create($input);
            return $this->returnSuccess('Success!', "Set Notification Success");
        } catch (Exception $e) {
            return $this->returnError(500, 'Bad Gateway');
        }
    }

    public function updateNotificationStatus(Request $request) {
        try {
            $notify = $this->Notification->where('id','=',$request->NotifiID)->first();
            $notify->Status = 1;
            $notify->update();
            return $this->returnSuccess('Success!', "Update Status Success");
        } catch (Exception $e) {
            return $this->returnError(500, 'Bad Gateway');
        }
    }

    public function getListNotification($sign, $app_id, $device_type,Request $request){
        try {
            $noti = $this->Notification;
            if($request->JobSeekerID == 0 || $request->JobSeekerID == null)
            {
                $noti = $noti->where('CompanyID', $request->CompanyID)
                            ->where('isCompany',1)
                            ->orderBy('id', 'DESC');
            }
            else
            {
                $noti = $noti->where('JobSeekerID', $request->JobSeekerID)
                    ->where('isCompany',0)
                    ->orderBy('id', 'DESC');
            }
            $noti = $noti->paginate(10);
            $noti = $noti->toArray();
            foreach ($noti['data'] as $key => &$value) {
                if($value['JobID'] != 0)
                {
                    $Job_ = $this->Job->where('id','=',$value['JobID'])->first();
                    if($Job_)
                    {
                        $value['Title'] = $value['Title'].'('.$Job_->Title.')';
                    }

                }
                if($request->JobSeekerID == 0 || $request->JobSeekerID == null)
                {
                    $JobSeeker = $this->JobSeeker->where('user_id','=',$value['JobSeekerID'])->first();
                    $value['Avatar'] = $JobSeeker->Avatar;
                    $value['Email'] = $this->User->where('id','=',$value['JobSeekerID'])->first()->Email;
                    $value['FullName'] = $JobSeeker->FullName;

                }
                else
                {
                    $Company = $this->CompanyProfile->where('CompanyID','=',$value['CompanyID'])->first();
                    $value['Avatar'] = Config::get('images.base_domain').Config::get('images.image_company_url_logo').$Company->Logo;
                    $value['Email'] = $this->User->where('id','=',$value['CompanyID'])->first()->Email;
                    $value['FullName'] = $Company->Name;
                    //$value['Content'] = $value['FullName'].' would like to invite you to attend an interview';
                }

                //$value['Avatar'] = $request->JobSeekerID == 0 ?$this->JobSeeker->where('user_id','=',$value['JobSeekerID'])->first()-> Avatar :
                 //   $this->CompanyProfile->where('CompanyID','=',$value['CompanyID'])->first()->Logo;
                //$value['Email'] = $request->JobSeekerID == 0 ? $this->User->where('id','=',$value['JobSeekerID'])->first()->Email : $this->User->where('id','=',$value['CompanyID'])->first()->Email;
                if(substr(trim($value['Avatar']), 0,4) !== 'http'){
                    $value['Avatar']  = Config::get('images.base_domain').Config::get('images.url').$value['Avatar'];
                }
            }
            return $this->returnSuccess('Success!', $noti);
        } catch (\Exception $e) {
            return $this->returnError(500, 'Bad Gateway');
        }
    }

    public function deleteNotification(Request $request) {
        try {
            $this->Notification
                ->Where('CompanyID','=',$request->CompanyID)
                ->orwhere('JobSeekerID','=',$request->JobSeekerID)
                ->delete();
            return $this->returnSuccess('Xóa thông báo thành công');
        } catch (Exception $e) {
            return $this->returnError(500, "Thử lại sau");
        }
    }

    public function deleteNotificationByID(Request $request) {
        try {
            $this->Notification
                ->Where('id','=',$request->NotificationID)
                ->delete();
            return $this->returnSuccess('Xóa thông báo thành công');
        } catch (Exception $e) {
            return $this->returnError(500, "Thử lại sau");
        }
    }

    public function countAllNotification(Request $request) {
        try {

            if($request->CompanyID == 0 || $request->CompanyID ==null){
                $count = $this->Notification
                    ->where('JobSeekerID','=',$request->JobSeekerID)
                    ->where('Status','=',0)
                    ->where('isCompany','=',0)
                    ->count();
            }else{
                $count = $this->Notification
                    ->where('CompanyID','=',$request->CompanyID)
                    ->where('Status','=',0)
                    ->where('isCompany','=',1)
                    ->count();
            }
            return $this->returnJSON(200, 'count', $count);
        } catch (Exception $e) {

        }
    }

    public function testNotify()
    {
        $result = $this->notify->sendGCM('1');
        return $result;
    }

}
