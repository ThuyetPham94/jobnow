<?php

namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use App\Models\Notification;
use Auth;
class NotificationComposer
{

    public function compose(View $view)
    {
        // if(!empty(Auth::user())) {
            // if(Auth::user()->IsCompany < 1) {
                $notify = Notification::where('Status', '=', 1)->where('MembershipID', '=', Auth::user()->id)->get();
                // if($notify) {
                return $view->with('notification', $notify);
        //         }else{
        //             return $view->with('notification', []);
        //         }
        //     }else{
        //         return $view->with('notification', []);
        //     }
        // }else{
        //     return $view->with('notification', []);
        // }
        
    }
}