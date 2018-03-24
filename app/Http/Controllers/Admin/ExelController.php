<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Repositories\User\UserRepository;

use App\Models\CompanyProfile;

use App\Models\JobSeeker;

use Excel;

class ExelController extends Controller
{
    protected $User;
    public function __construct(UserRepository $user) {
        $this->User = $user;
    }
    //export job
    public function downloadUser()
    {
        $data = User::select('users.id','users.email','users.CreditNumber')->get();
        
        foreach ($data as $item){
            $user = CompanyProfile::select('CompanyProfile.*')->where('CompanyProfile.CompanyID','=',$item->id)->first();
            $seeker = JobSeeker::select('JobSeeker.*')->where('JobSeeker.user_id','=',$item->id)->first();
            
            //dd($user);die();
            if(count($user)>0){
                //dd($user['Name']);die();
                $item->Company_name = $user['Name'];
                $item->ContactNumber = $user['ContactNumber'];
                $item->Address = $user['Address'];
            }else{
                $item->Company_name = "";
                $item->ContactNumber = "";
                $item->Address = "";
            }
            if(count($seeker)>0){
                $item->FullName = $seeker['FullName'];
                $item->Phone_Number = $seeker['PhoneNumber'];
            }else{
                $item->FullName = "";
                $item->Phone_Number ="";
            }
        }
        
        //dd($data);die();
        
        Excel::create('export_user', function($excel) use ($data) {
            $excel->sheet('mySheet', function($sheet) use ($data)
            {
                $sheet->fromArray($data);
            });
        })->download('xls');
        return redirect()->back();
    }
    //end export job
}
