<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use App\User;
use Validator;
use App\Repositories\User\UserRepository;
use App\Models\JobSeeker;
use App\Models\Job;
use App\Models\JobSeekerExperience;
use App\Models\JobSeekerSkill;
use App\Models\Interview;
use App\Models\CompanyImage;
use App\Models\CompanyIndustry;
use App\Models\CompanyReview;
use App\Models\Notification;
use App\Models\Shortlist;
use App\Models\AppliedJob;
use App\Models\Category;
use App\Models\SavedJob;
use App\Models\JobActstatic;
use App\Models\JobSkill;
use App\Repositories\JobSeeker\JobSeekerRepository;
use App\Models\CompanyProfile;
use App\Repositories\CompanyProfile\CompanyProfileRepository;
use App\Models\CompanySize;
use App\Repositories\CompanySize\CompanySizeRepository;


class UserController extends Controller
{
    
    protected $User;
    protected $Company;
    protected $JobSeeker;
    protected $CompanySize;

    public function __construct(UserRepository $user, JobSeekerRepository $JobSeeker,CompanyProfileRepository $Company,CompanySizeRepository $CompanySize) {
        $this->User = $user;
        $this->Company = $Company;
        $this->JobSeeker = $JobSeeker;
        $this->CompanySize = $CompanySize;
    }

    public function getIndex(Request $request) {
        //dd(User::COMPANY);
        $data = $this->User;
        if($request->Email) {
            $data = $data->where('Email', 'LIKE', '%'.$request->Email.'%');
        }
        if($request->FullName) {
            $FullName = $request->FullName;
            $data = $data->whereHas('jobSeeker', function ($query) use ($FullName) {
                $query->where('FullName', 'LIKE', '%'.$FullName.'%');
            });
        }
        if($request->Name) {
            $Name = $request->Name;
            $data = $data->whereHas('companyProfile', function ($query) use ($Name) {
                $query->where('Name', 'LIKE', '%'.$Name.'%');
            });
        }
        if($request->Permission != null) {            
            $data = $data->where('IsCompany', '=', $request->Permission);
        }

        $data = $data->paginate(10);        
        return view()->make('admin.modules.user.index', ['data' => $data])->with('title', 'Người dùng');
    }

    public function getLogin() {
        return view()->make('admin.modules.login');
    }

    public function postLogin(Request $request) {
        $remember = false;
        if($request->Check == 1) {
            $remember = true;
        }
        if(Auth::attempt(['Email' => $request->Email, 'password' => $request->Password], $remember) OR Auth::attempt(['Username' => $request->email, 'password' => $request->Password], $remember)) {
            if(Auth::user()->IsCompany > 1){
                return redirect()->route('admin.home');
            }else{
                Auth::logout();
                return redirect()->route('admin.auth.getLogin')->with('error', 'Bạn không đủ quyền');
            }
        }else{
            return redirect()->back()->with('error', 'Password hoặc email sai');
        }
    }

    // create user

    public function getCreate() {
        return view()->make('admin.modules.user.create')->with('title', 'Tạo người dùng');
    }

    public function postCreate(Request $request) {
        $valid = Validator::make($request->all(), [
            'Email' => 'required|unique:users,Email|email',
            'Password' => 'required|min:8',
            'Re_Password' => 'required|same:Password',
        ]);
        if($valid->fails()){
            return redirect()->back()->withErrors($valid)->with('messages', 'Các trường yêu cầu !');
        }
        $input = $request->all();
        $input['Password'] = bcrypt($input['Password']);
        $user = $this->User->create($input);
        
        if($user) {
            return redirect()->route('admin.user.getIndex')->with('messages', 'Admin created successfully !');
        }else{
            return redirect()->back()->with('messages', 'Error !');
        }
    }

    // createa user seeker

    public function getCreateSeeker() {
        return view()->make('admin.modules.user.seeker')->with('title', 'Create User Seeker');
    }

    public function postCreateSeeker(Request $request) {
        $valid = Validator::make($request->all(), [
            'Email' => 'required|unique:users,Email|email',
            'Password' => 'required|min:8',
            'Re_Password' => 'required|same:Password',
            'FullName' => 'required',
            'IsActive' => 'required'
        ]);
        if($valid->fails()){
            return redirect()->back()->withErrors($valid)->with('messages', 'Fields is required !');
        }
        $input = $request->all();
        $input['Password'] = bcrypt($input['Password']);
        $input['IsCompany'] = 0;
        $user = $this->User->create($input);
        
        if($user) {
            $input['user_id'] = $user->id;
            $company = $this->JobSeeker->create($input);
            if($company){
                return redirect()->route('admin.user.getIndex')->with('messages', 'User seeker created successfully !');
            }else{
                return redirect()->back()->withInput()->with('messages', 'Error !');
            }
        }else{
            return redirect()->back()->withInput()->with('messages', 'Error !');
        }
    }

    // create user company

    public function getCreateCompany() {
        $companySize = $this->CompanySize->getAll();
        return view()->make('admin.modules.user.company', ['companySize' => $companySize])->with('title', 'Create User Company');
    }

    public function postCreateCompany(Request $request) {
        $valid = Validator::make($request->all(), [
            'Email' => 'required|unique:users,Email|email',
            'Password' => 'required|min:8',
            'Re_Password' => 'required|same:Password',
            'Name' => 'required',
            'IsActive' => 'required'
        ]);
        if($valid->fails()){
            return redirect()->back()->withErrors($valid)->with('messages', 'Fields is required !');
        }
        $input = $request->all();
        $input['Password'] = bcrypt($input['Password']);
        $input['IsCompany'] = 1;
        $user = $this->User->create($input);
        
        if($user) {
            $input['CompanyID'] = $user->id;
            $company = $this->Company->create($input);
            if($company){
                return redirect()->route('admin.user.getIndex')->with('messages', 'User company created successfully !');
            }else{
                return redirect()->back()->withInput()->with('messages', 'Error !');
            }
        }else{
            return redirect()->back()->withInput()->with('messages', 'Error !');
        }
    }

    // get update
    public function getUpdate($id) {

    }
    // post update
    public function postUpdate($id, Request $request) {

    }
    // get view
    public function getView($id) {
        $data = $this->User->getById($id);
        //dd($data->jobSeeker);
        return view()->make('admin.modules.user.view',['data' => $data])->with('title', 'Xem chi tiết');
    }
    // post delete

    public function postDelete(Request $request) {
        $user = $this->User->getById($request->id);
        if($user->IsCompany == 0){
            AppliedJob::where('JobSeekerID','=',$request->id)->delete();
            CompanyReview::where('JobSeekerID','=',$request->id)->delete();
            Notification::where('JobSeekerID','=',$request->id)->delete();           
            Interview::where('JobSeekerID','=',$request->id)->delete();
            JobSeekerSkill::where('JobSeekerID','=',$request->id)->delete();
            JobSeekerExperience::where('JobSeekerID','=',$request->id)->delete();
            JobSeeker::where('user_id','=',$request->id)->delete();
            SavedJob::where('JobSeekerID','=',$request->id)->delete();
            Shortlist::where('UserID','=',$request->id)->delete();
        }else if($user->IsCompany == 1){
            $category = Category::where('CompanyID','=',$request->id)->get();
            foreach ($category as $key => $value) {
                Shortlist::where('CategoryID','=',$value->id)->delete();
            }
            Category::where('CompanyID','=',$request->id)                        
                        ->delete();
            CompanyImage::where('CompanyID','=',$request->id)->delete();
            CompanyIndustry::where('CompanyID','=',$request->id)->delete();
            CompanyProfile::where('CompanyID','=',$request->id)->delete();
            CompanyReview::where('CompanyID','=',$request->id)->delete();
            Interview::where('CompanyID','=',$request->id)->delete();
            Notification::where('Notification.CompanyID','=',$request->id);
            Notification::where('Notification.JobSeekerID','=',$request->id)->delete();             

            $job = Job::where('CompanyID','=',$request->id)->get();
            foreach ($job as $key => $value) {
                JobActstatic::where('JobActstatic.JobID','=',$value->id)->delete();
                SavedJob::where('SavedJob.JobID','=',$value->id)->delete();
                AppliedJob::where('AppliedJob.JobID','=',$value->id)->delete();
                JobSkill::where('JobSkill.JobID','=',$value->id)->delete();
            }
            Job::where('CompanyID','=',$request->id)->delete();

            //Shortlist::where('UserID','=',$request->id)->delete();
        }
        $result = $this->User->delete($request->id);
        if($result == true) {
            return response()->json(['code' => 200]);
        }else{
            return response()->json(['code' => 500]);
        }
    }   
}
