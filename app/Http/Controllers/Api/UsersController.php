<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Models\JobSeeker;
use Hash;
use Auth;
use Validator;
use App\Repositories\CompanyProfile\CompanyProfileRepository;
use App\Repositories\JobSeeker\JobSeekerRepository;
use App\Repositories\Country\CountryRepository;
use App\Repositories\User\UserRepository;
use App\Repositories\Notification\NotificationRepository;
use Socialite;
use Mail;
use Config;
use Illuminate\Support\Facades\DB;
class UsersController extends ApiBaseController
{
    protected $user;
    protected $companyProfile;
    protected $jobSeeker;
    protected $country;
    protected $noti;
    public function __construct(UserRepository $user, CompanyProfileRepository $companyProfile,JobSeekerRepository $jobSeeker, CountryRepository $country, NotificationRepository $noti){
        $this->user           = $user;
        $this->companyProfile = $companyProfile;
        $this->jobSeeker      = $jobSeeker;
        $this->country        = $country;
        $this->noti           = $noti;
    }
    public function postRegister(Request $request){

        try {
            $validator = Validator::make($request->all(), array(
                'FullName' => 'required',
                'Email' => 'email|required',
                'PhoneNumber' => 'required',
                'Password' => 'required',
            ));
            if($validator->fails()){
                $res = array('error'=>$validator->messages()->all());
                return $this->returnError(405,$validator->messages()->first(), $res);
            }
            $full_name = $request->FullName;
            $email     = $request->Email;
            $phone     = $request->PhoneNumber;
            $pass      = $request->Password;
            $iscompany = $request->input('IsCompany', 0);
            $c_user = User::where('Email', $email)->first();
            if($c_user){
                return $this->returnError(406, 'This email is already registered');
            }else{
                $user           = new User;
                $user->Email    = $email;
                $user->IsCompany= $iscompany;
                $user->Password = Hash::make($pass);
                if($user->save()){
                        $jobseeker              = new JobSeeker;
                        $jobseeker->user_id     = $user->id;
                        $jobseeker->FullName    = $full_name;
                        $jobseeker->PhoneNumber = $phone;
                        $jobseeker->save();
                    Mail::send(['html'=>'company.modules.test_email.mail_candidate'], array('user'=>$request->full_name), function ($message) use ($request){                        
                        $message->to($request->Email, 'Visitor')->subject('Welcome to JobNow!');
                    });
                    
                    // User::sendMail('thuyetphamit@gmail.com','bkerpham94',$request->Email,array('user'=>$request->full_name),'Welcome to JobNow!','Welcome to JobNow!','company.modules.test_email.mail_candidate');
                    return $this->returnSuccess('Register successfully');
                }else{
                    return $this->returnError(404, "Thử lại sau");
                }
            }
        } catch (Exception $e) {
            return $this->returnError(502, "Thử lại sau");
        }
    }

    public function postRegisterEmployee(Request $request){

        try {
            $valid = Validator::make($request->all(), [
            'Password' => 'required|min:8',
            'IndustryID' => 'required',
            'CompanySizeID' => 'required',
            'Name' => 'required',
            'ContactNumber' => 'required|min:10',
            ]);
                        
            if($valid->fails()){
                $res = array('error'=>$valid->messages()->all());
                return $this->returnError(405,$valid->messages()->first(), $res);
            }
            $c_user = User::where('Email', $request->Email)->first();
            if(!$c_user)
            {
                $user           = new User;
                $user->Email    = $request->Email;
                $user->IsCompany= 1;
                $user->Password = Hash::make($request->Password);
                if($user->save()){
                    $input = $request->all();
                    $input['CompanyID'] = $user->id;
                    $input['IsActive'] = 1;
                    $company = $this->companyProfile->create($input);
                    if($company){
                        Mail::send(['html'=>'company.modules.test_email.mail_employer'], array('user'=>$request->Name), function ($message) use ($request){                            
                            $message->to($request->Email, 'Visitor')->subject('Welcome to JobNow!');
                        });

                        // User::sendMail('thuyetphamit@gmail.com','bkerpham94',Input::get("Email"),array('user'=>$request->Name),'Welcome to JobNow!','Welcome to JobNow!','company.modules.test_email.mail_employer');

                        $users =  User::find($user->id);
                        $users->ApiToken = '';
                        return $this->returnJSON(200, 'Register successfully',$users);
                    }else{
                        $user->delete();
                        return $this->returnError(404, 'We\'re sorry, we are unable to proceed your request at this time. Please try again later.');
                    }
                }
            }
            else
            {
                return $this->returnJSON(404, 'Email đã đăng ký rồi');
            }

        } catch (\Exception $e) {
            return $this->returnError(502, "Thử lại sau");
        }
    }

    public function postLogin(Request $request) {
        try {
            $remember = false;
            if($request->Check == 1) {
                $remember = true;
            }            
            if(Auth::attempt(['Email' => $request->Email, 'password' => $request->Password], $remember) OR Auth::attempt(['Username' => $request->email, 'password' => $request->Password], $remember)) {
                Auth::login(Auth::user(), true);
                $users = Auth::user();                
                $users->ApiToken = $users->remember_token;

                if($request->device_type != 2){
                    if($users->IsCompany == 1 && $request->isEmployee == null){
                        $users->ApiToken = '';
                        $user_detail = User::find($users->id);
                        $user_detail->remember_token = '';
                        $user_detail->save();
                        return $this->returnError(504, 'Email/password nhập không đúng');
                    }
                    else if($users->IsCompany == 0 && $request->isEmployee != null)
                    {
                        return $this->returnError(404, 'Email/password nhập không đúng!');
                    }

                }
                $Avatar = $request->isEmployee ? $this -> companyProfile->where('CompanyID','=',$users->id)->first()->Logo :
                                                        $this -> jobSeeker->where('user_id','=',$users->id)->first()->Avatar;
                $users->Avatar = Config::get('images.base_domain').Config::get('images.url').$Avatar;
                $user_detail1 = User::find($users->id);
                $user_detail1->TokenFirebase = $request->TokenFirebase;
                $user_detail1->save();
                return $this->returnJSON(200, 'Thành công', $users);
            }else{
                return $this->returnError(404, 'Email/password nhập không đúng');
            }
        } catch (\Exception $e) {
            return $this->returnError(404, 'Email/password nhập không đúng');
        }
    }

    public function changePassword(Request $request) {
        try {
            $remember = false;
            if($request->Check == 1) {
                $remember = true;
            }            
            if(Auth::attempt(['Email' => $request->Email, 'password' => $request->OldPassword], $remember) OR Auth::attempt(['Username' => $request->email, 'password' => $request->OldPassword], $remember)) {
                $users = Auth::user();                             
                $user_detail = User::find($users->id);   
                $user_detail->Password = Hash::make($request->NewPassword);                
                $user_detail->save();            
                return $this->returnJSON(200, 'Cập nhật mật khẩu thành công', "");
            }else{
                return $this->returnError(404, 'Cập nhật lỗi');
            }
        } catch (Exception $e) {
            return $this->returnError(404, 'Cập nhật lỗi');
        }
    }

    public function postRegisterSocialite(Request $request) {
        $user = User::where('fb_id', $request->FB_id)->where('IsCompany','=',0)->first();
        if($user) {
            Auth::login($user, true);
            $users = Auth::user();
            $users->TokenFirebase = $request->TokenFirebase;
            if($users -> save())
            {
                $users->ApiToken = $users->remember_token;
            }
            return $this->returnJSON(200, 'Login successul', $users);
        }else{
            $validator = Validator::make($request->all(), array(
                'FullName' => 'required',
                'Email' => 'required',
                'Avatar' => 'required',
                'FB_id' => 'required',
            ));
            if($validator->fails()){
                $res = array('error'=>$validator->messages()->all());
                return $this->returnError(405,$validator->messages()->first(), $res);
            }

            $user = User::where('Email', $request->Email)->first();
            if($user){
                return $this->returnError(406, 'Email already exists!');
            }else{
                $user = new User();                
            }
            $user->Email = $request->Email;
            $user->fb_id = $request->FB_id;
            $user->TokenFirebase = $request->TokenFirebase;
            $jobseeker = new JobSeeker();
            if($user->save()){
                $jobseeker->user_id = $user->id;
                $jobseeker->Avatar = $request->Avatar;
                $jobseeker->FullName = $request->FullName;
                $jobseeker->IsActive = 1;
                $jobseeker->save();
                Auth::login($user, true);
                $users = Auth::user();

                $users->ApiToken = $users->remember_token;
                return $this->returnJSON(200, 'Đăng ký thành công', $users);
            }else{
                return $this->returnError(404, 'Đăng ký lỗi');
            }
        }
    }

    // udpate seeker

    public function postUpdateJobSeeker(Request $request) {
        //$user = Auth::user();
        try {
            $user = User::Where('Email', $request->Email)->first();

            if($user){

                if($user->IsCompany == 0) {
                    //dd($this->jobSeeker);
                    $id_user = $this->jobSeeker->where('user_id', $user->id)->first();
                    $result = $this->jobSeeker->update($id_user->id, $request->all());
                    if($result) {
                        return $this->returnSuccess('Update successfully');
                    }else{
                        return $this->returnError(404, 'Update failed');
                    }
                }else{
                    return $this->returnError(504, 'User is not Seeker !');
                }
            }else{
                return $this->returnError(412, 'Account do not exit!');
                
            }
        } catch (Exception $e) {
            return $this->returnError(502, 'Bad Gateway');
        }
    }

    public function getUserProfile($sign, $app_id, $device_type,Request $request){
        try {
            $user = User::find($request->user_id);
            $user_seeker = $user->jobSeeker;
            if($user && $user_seeker){
                if(substr(trim($user->Avatar), 0,4) === 'http'){
                    $user->Avatar = $user_seeker->Avatar;
                }else{
                    $user->Avatar      = Config::get('images.base_domain').Config::get('images.url').$user_seeker->Avatar;
                }

                $user->FullName        = $user_seeker->FullName;
                $user->BirthDay        = $user_seeker->BirthDay;
                $user->PhoneNumber     = $user_seeker->PhoneNumber;
                $user->CountryID       = $user_seeker->CountryID;
                $user->Gender          = $user_seeker->Gender;
                $user->CurriculumVitae = $user_seeker->CurriculumVitae;
                $user->Description     = $user_seeker->Description;
                $user->CountryName     = ($this->country->getById($user_seeker->CountryID))?$this->country->getById($user_seeker->CountryID)->Name:"";
                $user->PostalCode      = $user_seeker->PostalCode;
                $user->Description = $user_seeker->Description;
                unset($user->jobSeeker);
                return $this->returnSuccess('Success!', $user);
            }else{
                return $this->returnError(404, 'No Data Response !');
            }
        } catch (Exception $e) {
            return $this->returnError(502, 'Bad Gateway');
        }

    }

    public function getUserDetail($sign, $app_id, $device_type, $user_id){
        try {
            $user = User::find($user_id);
            $user_seeker = $user->jobSeeker;
            if($user && $user_seeker){
                if(substr(trim($user_seeker->Avatar), 0,4) === 'http'){
                    $user->Avatar = $user_seeker->Avatar;
                }else{
                    $user->Avatar          = Config::get('images.base_domain').Config::get('images.url').$user_seeker->Avatar;
                }
                
                $user->FullName        = $user_seeker->FullName;
                $user->BirthDay        = $user_seeker->BirthDay;
                $user->PhoneNumber     = $user_seeker->PhoneNumber;
                $user->CountryID       = $user_seeker->CountryID;
                $user->Gender          = $user_seeker->Gender;
                $user->CurriculumVitae = $user_seeker->CurriculumVitae;
                $user->Description     = $user_seeker->Description;
                $user->CountryName     = ($this->country->getById($user_seeker->CountryID))?$this->country->getById($user_seeker->CountryID)->Name:"";
                $user->PostalCode      = $user_seeker->PostalCode;
                $user->Description = $user_seeker->Description;
                unset($user->jobSeeker);
                return $this->returnSuccess('Success!', $user);
            }else{
                return $this->returnError(404, 'No Data Response !');
            }
        } catch (Exception $e) {
            return $this->returnError(502, 'Bad Gateway');
        }

    }

    public function getLogout($sign, $app_id, $device_type, $user_id){
        try {
            $user = User::find($user_id);
            $user->remember_token = '';
            $user->TokenFirebase = '';
            if($user->save()){
                return $this->returnSuccess('Logout Successfully!');
            }else{
                return $this->returnError(404, 'Logout failed');
            }
        } catch (Exception $e) {
            return $this->returnError(500, 'Bad Gateway');
        }
    }

    public function postAvatarUploadFile(Request $request) {
        try{
            $validator = Validator::make($request->all(), array(
                'Files' => 'required|image',
            ));
            if($validator->fails()){
                $res = array('error'=>$validator->messages()->all());
                return $this->returnError(405,'Fail Validate!', $res);
            }
            //dd(Config::get('images.path_upload'));
            $images = $request->file('Files');
            $filename = time() . '_' . md5($images->getClientOriginalName());
            $fileext = $images->getClientOriginalExtension();
            $images->move(Config::get('images.path_upload'), $filename.'.'.$fileext);
            $jobSeeker = $this->jobSeeker->where('user_id', '=', $request->UserID)->first();
            $jobSeeker->Avatar = $filename.'.'.$fileext;
            $jobSeeker->save();
            $res = array('avatar_name'=>$filename.'.'.$fileext,'img_url'=>Config::get('images.base_domain').Config::get('images.url').$filename.'.'.$fileext);
            return $this->returnSuccess('Upload successfully', $res);
        } catch (Exception $e){
            return $this->returnError(404, 'Upload failed');
        }
    }

    public function postResetPassword(Request $request){
        $validator = Validator::make($request->all(), array(
            'Email' => 'required|email',
        ));
        if($validator->fails()){
            $res = array('error'=>$validator->messages()->all());
            return $this->returnError(405,'The email enterred is incorrect', $res);
        }
        $data = ['a'=>123, 'b'=>234];
        Mail::send('api.sendmail', $data, function($msg){
            $msg->from('vnblues.com@gmail.com', 'abc');
            $msg->to('viet.ptit.17@gmail.com')->subject('This Email Reset Password!');
        });

    }

    public function getListNotification($sign, $app_id, $device_type, $user_id, $api_token){
        try {
            $noti = $this->noti->where('MembershipID', '=', $user_id)->orderBy('id', 'DESC')->get();
            $result = (object)array();
            if($noti){
                foreach ($noti as $key => $value) {
                    $result->id = $value->id;
                    $result->Title = $value->Title;
                    $result->Content = $value->Content;
                    $result->CreateDate = $value->CreateDate;

                }
            }
            return $this->returnSuccess('Success', $noti);
        } catch (Exception $e) {
            return $this->returnError(502, 'Bad GateWay');
        }
    }

    public function postRemoveNotification(Request $request){
    	try {
    		$validator = Validator::make($request->all(), array(
                'id' => 'required|integer',
                'MembershipID' => 'required|integer',
            ));
            if($validator->fails()){
                $res = array('error'=>$validator->messages()->all());
                return $this->returnError(405,'Notification delete failed', $res);
            }
            if($request->id == 0){
                $noti = $this->noti->where('MembershipID', '=', $request->MembershipID)->delete();
            }else{
                $noti = $this->noti->where('MembershipID', '=', $request->MembershipID)->where('id', '=', $request->id)->delete();
            }            
            if($noti) return $this->returnSuccess('Notification deleted successfully');
            else return $this->returnError(404, 'Notification delete failed');
    	} catch (Exception $e) {
    		return $this->returnError(502, 'Bad GateWay');
    	}

    }

    public function getToken(Request $request){
        $result = (object)array();
        try {
            $validator = Validator::make($request->all(), array(
                'UserID' => 'required|integer',
                'Email' => 'required|email',
            ));
            if($validator->fails()){
                $res = array('error'=>$validator->messages()->all());
                return $this->returnError(405,'Fail Validate!');
            }
            $user = $this->user->where('id', '=', $request->UserID)->where('Email', '=', trim($request->Email))->first();
            if($user && !empty($user->remember_token)){
                $result->ApiToken = $user->remember_token;
                return $this->returnSuccess('Success', $result);
            }else{
                return $this->returnError('403', 'Login to Continue');
            }

        } catch (Exception $e) {
            return $this->returnError(502,'Bad Gateway!');
        }
    }

    public function getListEmployee(Request $request){
        try {
            /*$user = JobSeeker::select('*')->where('FullName', 'like', '%' . $request->Name . '%')
                ->join('Country','Country.id','=','JobSeeker.CountryID')->get();*/
            $Shortlist = DB::select('call sp_searchEmployee(?,?,?)',array($request->Name,$request->CategoryID,$request->CompanyID));
            $collection = collect($Shortlist);
            foreach ($collection as $key => $value) {
                if(substr(trim($value->Avatar), 0,4) !== 'http'){
                    $value->Avatar  = Config::get('images.base_domain').Config::get('images.url').$value->Avatar;
                }
            }
            return $this->returnSuccess('Success!', $collection);
        } catch (Exception $e) {
            return $this->returnError(502,'Bad Gateway!');
        }
    }

    public function postForgot(Request $request){
        try {
            $user = $this->user->where('Email', '=', $request->Email)->first();
            if($user){
                $newpass = rand(10000000,99999999);
                $user->Password = Hash::make($newpass);
                $user->save();
                Mail::send('email.forgot', ['newpass' => $newpass], function ($m) use ($newpass, $user) {
                    $m->to($user->Email)->subject('Your New Password');
                });

                return $this->returnSuccess('New password was sent to your email!');
            }else{
                return $this->returnSuccess('Can not send email. Please verify your email!');
            }
        } catch (Exception $e) {
            return $this->returnError(502,'Bad Gateway!');
        }
    }

    public function getListExperience($sign, $app_id, $device_type,Request $request){
        try {
            $listExp = DB::select('SELECT * FROM Experience');
            $collection = collect($listExp);
            return $this->returnSuccess('Success!', $collection);
        } catch (Exception $e) {
            return $this->returnError('500', 'Bad Gateway');
        }
    }

    public function getListTerm($sign, $app_id, $device_type,Request $request){
        try {
            $listExp = DB::select('SELECT * FROM Term');
            $collection = collect($listExp);
            return $this->returnSuccess('Success!', $collection);
        } catch (Exception $e) {
            return $this->returnError('500', "thử lại sau");
        }
    }

    public function getAllNotification($sign, $app_id, $device_type,Request $request){
        try {
            $listNotify = DB::select('SELECT * FROM Notification WHERE CompanyID = ?',array($request->CompanyID));
            $collection = collect($listNotify);
            return $this->returnSuccess('Success!', $collection);
        } catch (Exception $e) {
            return $this->returnError('500', "thử lại sau");
        }
    }

    public function sendPricing(Request $request)
    {
        try {
                Mail::send(['html'=>'company.modules.test_email.sendinvite'], array('user'=>''), function ($message) use ($request){                    
                    $message->to($request->Email, 'Visitor')->subject('Job Posting Packages');
                });
                // User::sendMail('cs@jobnow.com.sg','jobnow2017',$request->Email,array(),'Job Posting Packages.','JobNow Posting Packages.','company.modules.test_email.sendinvite'); 
                return $this->returnSuccess('Email sent successully');

        } catch (Exception $e) {
            return $this->returnError('500', "thử lại sau");
        }
    }

    public function getCreditNumber(Request $request)
    {
        try {
            $user = $this->user->where('id','=',$request->CompanyID)->first();
            if($user)
            {
                $response = array('code' => 200, 'message' => 'Success','result'=>$user->CreditNumber);
                return $response;
            }
            else
            {
                $response = array('code' => 404, 'message' => 'Failed','result'=>0);
                return $response;
            }

        } catch (Exception $e) {
            return $this->returnError('500',"thử lại sau");
        }
    }

    public function getAllPrivacy($sign, $app_id, $device_type,Request $request){
        try {
            $listPrivacy = DB::select('SELECT * FROM Privacy ORDER BY id DESC',array());
            $collection = collect($listPrivacy);
            return $this->returnSuccess('Success!', $collection);
        } catch (Exception $e) {
            return $this->returnError('500', "thử lại sau");
        }
    }

}
