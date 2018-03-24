<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use Hash;
use Mail;
use Input;
use App\Models\JobSeeker;
use Validator;
use App\Repositories\User\UserRepository;

class UserController extends Controller
{
    protected $user;

    public function __construct(UserRepository $user) {
        $this->user = $user;
    }

    public function postLogin(Request $request) {

        $regis = $this->getData('api/v1/users/postLogin',$request->all());
        $c_regis =json_decode($regis);
        //dd($c_regis);die();
        if($c_regis->code == 200) {
            $user = $this->user->getById($c_regis->result->id);
            if($user->IsCompany > 0){
                return redirect()->back()->with('message' , 'Bạn không đủ quyền')->with('status', 'error');
            } else {
                Auth::login($user);
                return redirect()->back();
            }
        }else{
            return redirect()->back()->with('message' , $c_regis->message)->with('status', 'error');
        }
    }

    public function postForgot(Request $request){
        $valid = Validator::make($request->all(), array(
            'Email' => 'required|email'
        ));
        if ($valid->fails()) {
            return redirect()->back()->withInput()->with('errors', $valid->errors()->all());
        }

        $user = $this->user->where('Email', '=', $request->Email)->first();
        if($user){
            $newpass = rand(10000000,99999999);
            $user->Password = Hash::make($newpass);
            $user->save();
            Mail::send('email.forgot', ['newpass' => $newpass], function ($m) use ($newpass, $user) {                    
                    $m->to($user->Email)->subject('Mật khẩu mới của bạn !');
                });

            return redirect()->route('public.home')->with('message' , 'Vui lòng kiểm tra email để lấy lại mật khẩu ');
        }else{
            return redirect()->route('public.home')->with('message' , 'Email hoặc mật khẩu không đúng.Vui lòng kiểm tra lại')->with('status','error');
        }
    }

    public function seekerPostRegister(Request $request)
    {
        $valid = Validator::make($request->all(), array(
            'FullName' => 'required',
            'PhoneNumber' => 'required|numeric|min:9',
            'Email' => 'required|email|unique:users,Email',
            'Password' => 'required|min:8',
            'Check' => 'required'
        ));
        
        if ($valid->fails()) {            
            return redirect()->back()->withInput()->with('errors', $valid->errors()->all());
        }
        $user  = $this->user->where('Email','=',$request->Email)->first();
        if(!empty($user)){
            return redirect()->back()->with(['error' => 'Chú ý.Email này đã được đăng ký rồi']);
        }else{
            $input = $request->all();
            $input['IsCompany'] = 0;
            $input['IsActive'] = 1;
            $regis = $this->getData('api/v1/users/postRegister',$input);
            $c_regis =json_decode($regis);
            
            Mail::send(['html'=>'company.modules.test_email.mail_candidate'], array('user'=>Input::get('FullName')), function ($message){
                    $message->to(Input::get('Email'), 'Visitor')->subject('Chào mừng tới jobnow!');
                });
            
            if($c_regis->code == 200) {
                $user  = $this->user->where('Email','=',$request->Email)->first();
                Auth::login($user);
                return redirect()->route('public.home')->with('message' , $c_regis->message);
            }else{
                return redirect()->back()->with('message' , $c_regis->message);
            }
        }
    }

    // facebook
    public function loginFB() {
        return Socialite::driver('facebook')->redirect();
    }
    public function callback() {
        $user = Socialite::with('facebook')->user();
        $input = [
            'FullName' => $user->name,
            'Email' => $user->email,
            'Avatar' => $user->avatar,
            'FB_id' => $user->id,
        ];
        $regis = $this->getData('api/v1/users/postRegisterSocialite',$input);
        $c_regis =json_decode($regis);
        if($c_regis->code == 200) {
            
                $user  = $this->user->where('Email','=',$c_regis->result->Email)->first();
                Auth::login($user);
                return redirect()->route('public.home')->with('message' , $c_regis->message)->with('status', 'success');            
        }else{
            return redirect()->back()->with('message' , $c_regis->message)->with('status', 'error');
        }
    }

    public function postChangePass(Request $request) {
        $valid = Validator::make($request->all(), [
            'Old_Password' => 'required',
            'Password' => 'required|min:6',
            'Re_Password' => 'required'
        ]);

        if($valid->fails()){
            return redirect()->back()->withErrors($valid)->with('message', 'Các trường yêu cầu!')->with('status', 'warning')->with('event', 'change-pass');
        }

        if(Hash::check($request->Old_Password,Auth::user()->Password)) {
            $user = User::find(Auth::user()->id);
            //dd($user);
            $user->Password = bcrypt($request->Password);
            if($user->save()){
                return redirect()->back()->with('message' , 'Thay đổi mật khẩu thành công')->with('status', 'success');
            }else{
                return redirect()->back()->with('message' , 'Failse!')->with('status', 'error')->with('event', 'change-pass');
            }
        }else{
            return redirect()->back()->with('message' , 'Mật khẩu sai')->with('status', 'warning')->with('event', 'change-pass');
        }
        
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('public.home');
    }
    
}
