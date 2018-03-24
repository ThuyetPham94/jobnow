<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\Feedback\FeedbackRepository;
use App\Repositories\User\UserRepository;
use Mail;
class FeedbackController extends ApiBaseController
{
    protected $Feedback;
    protected $User;
    public function __construct(FeedbackRepository $Feedback,UserRepository $User){
        $this->User = $User;
        $this->Feedback = $Feedback;
    }

    public function addFeedback(Request $request) {
        try {
           $input = $request->all();
            $result = $this->Feedback->create($input);
            if($result)
            {
                $user = $this->User->where('id','=',$request->User_id)->first();
                Mail::send(['html'=>'company.modules.test_email.sendfeedback'], array('title1'=>$request->Title,'message1'=>$request->Message), function($message) use($user){
                    $message->from($user->Email,'Feedback about jobnow');
                    $message->to('cs@jobnow.com.sg', 'Visitor')->subject('Feedback');
                });
                return $this->returnSuccess('Feedback sent successully');
            }

                return $this->returnError(404, "Thử lại sau");
        } catch (\Exception $e) {
            return $this->returnError(500, "Thử lại sau");
        }
    }

}
