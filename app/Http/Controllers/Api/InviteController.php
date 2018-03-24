<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Invite;
use App\Models\Category;
use App\User;
use Mail;
use Input;
use App\Http\Controllers\NotificationController;
class InviteController extends ApiBaseController
{

    protected $notify;

    public function __construct(NotificationController $notify){
        $this->notify = $notify;
    }

    public function setInvite(Request $request) {
        try {
            $input = $request->all();
            $user = User::Where('Email', $request->Email)->first();
            if($user)
            //if(1==0)
            {
                return $this->returnError(404, 'The email already exitst!');
            }
            else
            {
                $invite = Invite::Where('Email', $request->Email)
                                ->Where('User_id', $request->User_id)
                                ->first();
                if($invite) 
                {
                    return $this->returnError(404, 'You invited this company');    
                }
                $result =  $request->all();
                //var_dump($result['Email']);die();

                Mail::send(['html'=>'company.modules.test_email.mail_content'], array('id_inviter'=>$request->User_id,'user'=>'','company'=>$request->CompanyName,'email'=>md5($request->Email)), function ($message) use ($request){
                    $message->to($request->Email, 'Visitor')->subject("JobNow's invitation is awaiting your response");
                });
                Invite::create($input);
                return $this->returnError(200, 'Thừ mời gửi thành công');
            }
            
            } catch (Exception $e) {
                return $this->returnError(500, "Thử lại sau");
            }
    }

    public function setInvite1(Request $request) {
        try {
             //Mail::send(['html'=>'company.modules.test_email.template_content'], array('id_inviter'=>77,'user'=>'','email'=>md5('viet.ptit.17@gmail.com')), function($message){
            Mail::send('company.modules.test_email.template_content', ['title' => '', 'content' => ''], function ($message){
            $message->to('viet.ptit.17@gmail.com', 'Visitor')->subject('JobNow Invitation');
            });
                    return $this->returnError(200, 'Invite successful');
                
            
            } catch (Exception $e) {
                return $this->returnError(500, "Thử lại sau");
            }
    }

    public function getListInvitation($sign, $app_id, $device_type,Request $request){
        try {
            $invite = Invite::Where('User_id', $request->User_id)->orderBy('id', 'DESC')->get();
            return $this->returnSuccess('Success!', $invite);
        } catch (Exception $e) {
            return $this->returnError(500, "Thử lại sau");
        }
    }

    public function testNotify()
    {
        $result = $this->notify->sendGCM('1');
        return $result;
    }
    public function testNotify1()
    {
        $result = $this->notify->sendGCM1('1');
        return $result;
    }

}
