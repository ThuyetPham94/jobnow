<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\Job\EloquentJobRepository;
use App\Models\Notification;
use App\User;
class NotificationController extends Controller
{

    public function setNotification($CompanyID,$JobSeekerID,$JobID,$Title,$Content,$KeyScreen,$Status,$isCompany) {
        try {
            $notification = new Notification;
            $notification->CompanyID = $CompanyID;
            $notification->JobSeekerID = $JobSeekerID;
            $notification->JobID = $JobID;
            $notification->Title = $Title;
            $notification->Content = $Content;
            $notification->KeyScreen = $KeyScreen;
            $notification->Status = $Status;
            $notification->isCompany = $isCompany;
            if($notification->save())
            {
                $user = User::find($CompanyID);

                $this->sendNotification($Content,$Title,$KeyScreen,$user->TokenFirebase);
            }
            return "";
        } catch (Exception $e) {
            return "";
        }
    }

    public function setNotificationInterview($CompanyID,$JobSeekerID,$JobID,$Title,$Content,$KeyScreen,$Status,$isCompany,$InterviewID) {
        try {
            $notification = new Notification;
            $notification->CompanyID = $CompanyID;
            $notification->JobSeekerID = $JobSeekerID;
            $notification->JobID = $JobID;
            $notification->Title = $Title;
            $notification->Content = $Content;
            $notification->KeyScreen = $KeyScreen;
            $notification->Status = $Status;
            $notification->isCompany = $isCompany;
            $notification->InterviewID = $InterviewID;
            if($notification->save())
            {
                if($isCompany ==0)
                {
                    $user = User::find($JobSeekerID);
                }
                else
                {
                    $user = User::find($CompanyID);
                }


                $this->sendNotification($Content,$Title,$KeyScreen,$user->TokenFirebase);
            }
            return "";
        } catch (Exception $e) {
            return "";
        }
    }


    public function sendNotification($message,$title,$keyScreen,$token) {
        $msg = array
        (
            'body' => $message,
            'title' => $title,
            'data' => array('content' => $message,'keyscreen' => $keyScreen),
            'sound' => $keyScreen
        );
        $url = 'https://fcm.googleapis.com/fcm/send';

        $fields = array(
            'registration_ids' => array(
                $token
            ),
            'notification' => $msg
        );

        $headers = array(
            'Authorization: key=AIzaSyB9Cu0moO-32dkcGBVb6eWaH4VX1HWDUCI',
            'Content-Type: application/json'
        );

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

        $result = curl_exec($ch);

        curl_close($ch);

        return $result;
    }

    public function sendGCM( $id) {
        $content = "This is a content";
        $keyscreen = 1;
        $msg = array
        (
            'body' => json_encode(array('content' => $content,'keyscreen' => $keyscreen)),
            'title' => 'this is a title',
            'vibrate' => 1,
            'sound' => 1,
        );
        $url = 'https://fcm.googleapis.com/fcm/send';

        $fields = array(
            'registration_ids' => array(
                'eWP5zDNmDX0:APA91bFA0yRUtQzYguVEiPGF4uEs6hhflCMa0EZPJEntA4pwasx7O6TE8ZoBBdvzwCHDHgaSIYzyGRLureSTOXNeSUEhYLL2PGvw3008-6oXpDdHaPMVCnZyLH_uA-qLZUrOc5hWJXEg'
            ),
            'notification' => $msg
        );

        $headers = array(
            'Authorization: key=AIzaSyB9Cu0moO-32dkcGBVb6eWaH4VX1HWDUCI',
            'Content-Type: application/json'
        );

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

        $result = curl_exec($ch);

        curl_close($ch);

        return $result;
    }

    public function sendGCM1( $id) {
        $content = "This is a content";
        $keyscreen = 1;
        return json_encode(array('content' => $content,'keyscreen' => $keyscreen));
        $msg = array
        (
            'body' => json_encode(array('content' => $content,'keyscreen' => $keyscreen)),
            'title' => 'this is a title',
            'vibrate' => 1,
            'sound' => 1,
        );
        $url = 'https://fcm.googleapis.com/fcm/send';

        $fields = array(
            'registration_ids' => array(
                'cWFpLzcbezU:APA91bHKIg7LwMS-mFqK4ztmG0PRRjwDPD8-4b6DiRVRYT7EH_X1R2if3iSDqYBbiIqFkdlvltEah1H4Ycx4V1fHAE0guJpDyg7w3MBkFJGw5LyVMLB1QPmbj7c2GqDbMT-9H537mRII'
            ),
            'notification' => $msg
        );

        $headers = array(
            'Authorization: key=AIzaSyB9Cu0moO-32dkcGBVb6eWaH4VX1HWDUCI',
            'Content-Type: application/json'
        );

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

        $result = curl_exec($ch);

        curl_close($ch);

        return $result;
    }

}
