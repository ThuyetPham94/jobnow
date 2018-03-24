<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\CompanyProfile;
use App\Models\CompanySize;
use App\Models\CompanyImage;
use App\Models\Invite;
use App\Models\CompanyReview;
use App\User;
use Auth;
use Hash;
use Mail;
use Input;
use App\Repositories\User\UserRepository;
use App\Repositories\CompanyProfile\CompanyProfileRepository;
use App\Repositories\CompanyReview\CompanyReviewRepository;
use App\Repositories\CompanySize\CompanySizeRepository;
use App\Repositories\CompanyImage\CompanyImageRepository;
use App\Repositories\CompanyIndustry\CompanyIndustryRepository;
use Intervention\Image\ImageManagerStatic as Image;
use Validator;
use App\Models\Location;
use App\Repositories\Location\LocationRepository;
use App\Models\Job;
use App\Repositories\Job\JobRepository;
use App\Models\Currency;
use App\Repositories\Currency\CurrencyRepository;
use App\Models\JobSeeker;
use App\Repositories\JobSeeker\JobSeekerRepository;
use App\Models\Industry;
use App\Repositories\Industry\IndustryRepository;
use App\Models\Country;
use App\Repositories\Country\CountryRepository;
use App\Http\Requests\JobRequest;
use App\Repositories\Skill\SkillRepository;
use App\Repositories\JobSkill\JobSkillRepository;
use App\Models\Feedback;
use App\Repositories\Feedback\FeedbackRepository;
use App\Models\JobSeekerSkill;
use App\Repositories\JobSeekerSkill\JobSeekerSkillRepository;
use App\Models\JobSeekerExperience;
use App\Models\Notification;
use App\Repositories\JobSeekerExperience\JobSeekerExperienceRepository;
//shortlist
use App\Models\Shortlist;
use App\Repositories\Shortlist\ShortlistRepository;
//category
use App\Models\Category;
use App\Repositories\Category\CategoryRepository;
//interview
use App\Models\Interview;
use App\Repositories\Interview\InterviewRepository;

use Config;
use File;
use App\Repositories\JobActstatic\JobActstaticRepository;
use App\Repositories\AppliedJob\AppliedJobRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use App\Models\Term;
use App\Models\Privacy;
use App\Models\JobLevel;
use App\Http\Controllers\NotificationController;
use App\Models\Experience;
use App\Models\EmploymentType;
use Carbon;

class ManageCompanyController extends Controller {

    protected $CompanySize;
    protected $CompanyImage;
    protected $CompanyProfile;
    protected $CompanyReview;
    protected $CompanyIndustry;
    protected $User;
    protected $Location;
    protected $Job;
    protected $Currency;
    protected $Seeker;
    protected $SeekerSkill;
    protected $SeekerExperience;
    protected $Industry;
    protected $Country;
    protected $Skill;
    protected $Feedback;
    protected $JobSkill;
    protected $JobActstatic;
    protected $appliedJob;
    protected $Category;
    protected $Interview;
    protected $Shortlist;
    protected $notify;
    public function __construct(
            CompanySizeRepository $CompanySize,
            CompanyImageRepository $CompanyImage,
            CompanyProfileRepository $CompanyProfile,
            CompanyIndustryRepository $CompanyIndustry,
            UserRepository $User,
            CompanyReviewRepository $CompanyReview,
            LocationRepository $Location,
            JobRepository $Job,
            CurrencyRepository $Currency,
            JobSeekerRepository $Seeker,
            JobSeekerSkillRepository $SeekerSkill,
            JobSeekerExperienceRepository $SeekerExperience,
            IndustryRepository $Industry,
            CountryRepository $Country,
            SkillRepository $Skill,
            FeedbackRepository $Feedback,
            JobSkillRepository $JobSkill,
            JobActstaticRepository $JobActstatic,
            CategoryRepository $category,
            InterviewRepository $Interview,
            ShortlistRepository $Shortlist,
            AppliedJobRepository $appliedJob,
            NotificationController $notify) {
        $this->CompanySize = $CompanySize;
        $this->CompanyImage = $CompanyImage;
        $this->CompanyProfile = $CompanyProfile;
        $this->CompanyIndustry = $CompanyIndustry;
        $this->User = $User;
        $this->CompanyReview = $CompanyReview;
        $this->Location = $Location;
        $this->Job = $Job;
        $this->Currency = $Currency;
        $this->Seeker = $Seeker;
        $this->SeekerSkill = $SeekerSkill;
        $this->SeekerExperience = $SeekerExperience;
        $this->Industry = $Industry;
        $this->Country = $Country;
        $this->Skill = $Skill;
        $this->Feedback = $Feedback;
        $this->JobSkill = $JobSkill;
        $this->Interview = $Interview;
        $this->JobActstatic = $JobActstatic;
        $this->appliedJob = $appliedJob;
        $this->Category = $category;
        $this->Shortlist = $Shortlist;
        $this->notify = $notify;
        //$this->level = array(1=>'Entry Level', 2=>'Experienced (non-manager)', 3=>'Manager', 4=>'Director and above');        
        //dd(User::find('40')->delete());
    }


    private function getMonthData($data){
        $chart_month = array();
        $i = 0;
        for($i=0;$i<12;$i++){
            $chart_month[$i] = 0;
        }
        $i = 0;
        foreach($data as $item){
        $tmp_arr = explode('-',$item->day);
        $current_month = $tmp_arr[1];
       if($i+1 < $current_month){
            $i = $current_month - 1;
        }
        $chart_month[$i] += (int)($item->count);
        }
        return $chart_month;
    }

    public function getIndex() {        

        $chart_interview = Interview::select(DB::raw('count(id) as interview_count'), DB::Raw('DATE(created_at) day'))
                            ->where('CompanyID','=',Auth::user()->companyProfile->id)
                            ->groupBy('day')->orderBy('day', 'DESC')
                            ->skip(0)
                            ->take(10)
                            ->get();
        $chart_job = Job::select(DB::raw('count(id) as job_count'), DB::Raw('DATE(Start_date) day'))
                                ->where('CompanyID','=',Auth::user()->id)
                                ->groupBy('day')->orderBy('day', 'DESC')
                                ->skip(0)
                                ->take(10)
                                ->get();
        // chart month
        $start_year = Date("20y-01-01");
        $start_year_arr = explode("-",$start_year);
        $next_year = $start_year_arr[0] + 1;
        $next_year = $next_year.'-01-01';

        $data_month_job = Job::select(DB::raw('count(id) as count'), DB::Raw('DATE(Start_date) day'),'CompanyID')
                        ->where('CompanyID','=',Auth::user()->id)
                        ->whereDate('Start_date','>=',$start_year)
                        ->whereDate('Start_date','<',$next_year)
                        ->groupBy('day')
                        ->orderBy('day', 'ASC')
                        ->get();

        $data_month_interview = Interview::select(DB::raw('count(id) as count'), DB::Raw('DATE(created_at) day'))
                        ->where('CompanyID','=',Auth::user()->id)
                        ->whereDate('created_at','>=',$start_year)
                        ->whereDate('created_at','<',$next_year)
                        ->groupBy('day')
                        ->orderBy('day', 'ASC')
                        ->get();


        
        $chart_month_job = $this->getMonthData($data_month_job);
        $chart_month_interview = $this->getMonthData($data_month_interview);
        
        // end chart month
        $year = Date("20y");
        $month_arr = ['Jan','Feb','Mar','Apr','May','June','July','Aug','Sep','Oct','Nov','Dec'];
        // end update by hung
        $company = $this->User->where('IsCompany', 1)->get();
        $seeker = $this->User->where('IsCompany', 0)->get();
        $job = $this->Job->where('CompanyID', '=', Auth::user()->id)->get();
        $today = Date("20y-m-d");
        $countHiring = $this->Job->where('DateExprire','>=',$today)
                            ->where('CompanyID','=',Auth::user()->id)
                            ->Where('IsActive', '=',1)
                            ->Where('CompanyID', '=',Auth::user()->id)    
                            ->count();
        $countJob = $this->Job->where('DateExprire','<',$today)
                            ->where('CompanyID','=',Auth::user()->id)
                            ->orWhere('IsActive', '=',0)
                            ->Where('CompanyID', '=',Auth::user()->id)                            
                            ->count();

        $countinterview = Interview::where('CompanyID', '=', Auth::user()->id)->count();
       
        return view()->make('company.modules.index', ['company' => $company, 'seeker' => $seeker, 'job' => $job,'chart_interview'=>$chart_interview,'chart_job'=>$chart_job,"chart_month_job"=>$chart_month_job,'chart_month_interview'=>$chart_month_interview,'year'=>$year,'month_arr'=>$month_arr,'countJob'=>$countJob,'countHiring'=>$countHiring,'count_interview'=>$countinterview])->with('title', 'Dashboard');
    }

    
    public function indexJob()
    {   
        $today = Date("20y-m-d");
        $data = $this->Job->where('DateExprire','>=',$today)
                            ->where('CompanyID','=',Auth::user()->id)
                            ->Where('IsActive', '=',1)
                            ->Where('CompanyID', '=',Auth::user()->id)
                            ->orderBy('id', 'DESC');                            
        // update by hung
        $countJob = $data->count();
        $data = $data->paginate(10);
        $name = (Auth::user()->companyProfile && Auth::user()->companyProfile->Name)?Auth::user()->companyProfile->Name:"Manage";
        return view()->make('company.modules.job.index', ['data' => $data])->with(['title' => $name,'countJob'=>$countJob]);
    }

    //get list of jobs, that have done hiring
    public function getDoneHiring(){
        $today = Date("20y-m-d");
        $data = $this->Job->where('DateExprire','<',$today)
                            ->where('CompanyID','=',Auth::user()->id)
                            ->orWhere('IsActive', '=',0)
                            ->Where('CompanyID', '=',Auth::user()->id);        
        $countJob = $data->count();
        $data= $data->paginate(10);
        $name = (Auth::user()->companyProfile && Auth::user()->companyProfile->Name)?Auth::user()->companyProfile->Name:"Manage";
        return view()->make('company.modules.job.list_done', ['data' => $data])->with(['title' => $name,'countJob'=>$countJob]);
    }

    //extend the job when it is exprire
    public function extend($id)
    {        
        if(Auth::user()->CreditNumber >0 ){
            //$job = $this->Job->getById($id);
            $today = date('Y-m-d');
            $date = date('Y-m-d', strtotime($today .' + 7 days'));

            $input['DateExprire'] = $date;
            $input['IsActive'] = 1;
            $user['CreditNumber'] = Auth::user()->CreditNumber - 0.5;

            $this->Job->update($id,$input);
            $this->User->update(Auth::user()->id,$user);
            Auth::user()->CreditNumber = $user['CreditNumber'];
            return redirect()->back()->with('message', 'Gia hạn thành công!');
        }else{
            return redirect()->back()->with('message', 'Bạn không đủ Tín dụng để mở rộng Job. Vui lòng mua thêm Tín dụng!');
        }
    }

    //end
    // end update by hung
    public function account(){
        $user = Auth::user();
        $companySize = $this->CompanySize->getAll();
        $Industry= $this->Industry->getAll();
        $industryID = $this->CompanyIndustry->where('CompanyID','=',Auth::user()->id)->first();
        //dd($user->companyImage);
        $name = (Auth::user()->companyProfile && Auth::user()->companyProfile->Name) ? Auth::user()->companyProfile->Name : "Manage";
        return view()->make('company.modules.account.index', ['user' => $user, 'companySize' => $companySize,'Industry'=>$Industry,'industryID'=>$industryID])->with('title', $name);
    }

    public function postUpdate(Request $request) {
        $input = $request->all();
        //dd($input);die();
        $valid = Validator::make($request->all(), array(
                    'Name' => 'required',
                    'Address' => 'required',                    
                    'ContactNumber' => 'required',
                    'CompanySizeID' => 'required',                    
                    'IndustryID'  => "required",
                    'Website'  => "required",
                    'FaceBookPage'  => "required",
                    'Overview' => "required",
                    'WhyJoinUs' => "required",   
        ));

        //dd($request->all());die();

        if ($valid->fails()) {

            return redirect()->back()->withErrors($valid)->with('message', 'Các trường yêu cầu !');
        }

        if (!empty($request->file('Logo'))) {
            $logo = time() . '-' . md5($request->file('Logo')->getClientOriginalName()) . '.' . $request->file('Logo')->getClientOriginalExtension();
            $input['Logo'] = $logo;
            Image::make($request->file('Logo'))->save(Config::get('images.image_company_url_logo') . $logo);
        }
        if (!empty($request->file('CompanyImage')[0])) {
            for ($i = 0; $i < count($request->file('CompanyImage')); $i++) {
                $name = time() . '-' . md5($request->file('CompanyImage')[$i]->getClientOriginalName()) . '.' . $request->file('CompanyImage')[$i]->getClientOriginalExtension();

                $this->CompanyImage->create([
                    'CompanyID' => Auth::user()->id,
                    'ImageUrl' => $name
                ]);

                //Image::make($request->file('CompanyImage')[$i])->resize(600, 750)->save(Config::get('images.company_image_url').$name);
                Image::make($request->file('CompanyImage')[$i])->save(Config::get('images.company_image_url') . $name);
            }
        }

        if ($request->CoverImage) {
            $com_image = $this->CompanyImage->where('id', $request->CoverImage)->first();
            $input['CoverImage'] = $com_image->ImageUrl;
        } else {
            unset($input['CoverImage']);
        }
        //dd(Auth::user()->companyProfile->id);
        $result = $this->CompanyProfile->update(Auth::user()->companyProfile->id, $input);
        $industry_s = $this->CompanyIndustry->where('CompanyID','=',Auth::user()->id)->first();
        $this->CompanyIndustry->update($industry_s->id,[
                                        'CompanyID'=>Auth::user()->id,
                                        'IndustryID'=>$request->IndustryID
                                        ]);
        if ($result) {
            return redirect()->back()->with('message', 'Hô sơ được cập nhật thành công')->with('status', 'success');
        } else {
            return redirect()->back()->with('message', 'Update lỗi !')->with('status', 'error');
        }
    }

    // change mail

    public function postChangeMail(Request $request) {
        $valid = Validator::make($request->all(), [
                    'Password' => 'required',
                    'Email' => 'required|email',
                    'Re_Email' => 'required'
        ]);

        if ($valid->fails()) {
            return redirect()->back()->withErrors($valid)->with('message', 'Các trường yêu cầu!')->with('status', 'warning')->with('event', 'change-mail');
        }
        //dd(Auth::user()->Password);
        $user = $this->User->where('id', '!=', Auth::user()->id)->where('Email', $request->Email)->first();
        if (!$user) {
            if (Hash::check($request->Password, Auth::user()->Password)) {
                $user = $this->User->getById(Auth::user()->id);
                $user->Email = $request->Email;
                $user->save();
                return redirect()->back()->with('message', 'Thay đổi email thành công')->with('status', 'success');
            } else {
                return redirect()->back()->with('message', 'Email / mật khẩu đã nhập không chính xác')->with('status', 'warning')->with('event', 'change-mail');
            }
        } else {
            return redirect()->back()->with('message', 'Email / mật khẩu đã nhập không chính xác')->with('status', 'success')->with('event', 'change-mail');
        }
    }

    // search resume

    public function interview(Request $request) {
        $data = new Interview;
        if ($request->keywork) {
            $data = $data->where('Content', 'like', '%' . $request->keywork . '%');          
        }
        $data = $data::select('Interview.*','JobSeeker.FullName','JobSeeker.id as user_id','users.Email')
                ->where('CompanyID','=',Auth::user()->id)
                ->join('JobSeeker','JobSeeker.user_id','=','JobSeekerID')     
                ->join('users','users.id','=','JobSeekerID')           
                ->paginate(10);
        //dd($data);die();
        return view()->make('company.modules.interview.index', ['data' => $data])->with('title','Danh sách phỏng vấn');
    }

    public function getCreateJob() {

        $CreditNumber = Auth::user()->CreditNumber;
        if($CreditNumber <= 0){
            return redirect()->route('public.company.index')->withInput()->with('message', 'Rất tiếc, bạn không có đủ tín dụng. Vui lòng mua tín dụng công việc để tiến hành công việc đăng')->with('status', 'error')->with('credit',$CreditNumber);
        }

        $location = $this->Location->getAll();
        $industry = $this->Industry->getAll();
        $employment = EmploymentType::all();
        $skill = $this->Skill->getAll();
        $experience = Experience::all();
        $joblevel = JobLevel::all();
        $currency = $this->Currency->where('IsActive', '=', 1)->get();
        $name = (Auth::user()->companyProfile && Auth::user()->companyProfile->Name) ? Auth::user()->companyProfile->Name : "Manage";

        return view()->make('company.modules.job.create', ['location' => $location, 'currency' => $currency, 'industry' => $industry, 'skill' => $skill,'joblevel'=>$joblevel,'experience'=>$experience,'employment'=>$employment])->with('title', $name);
    }

    public function postCreateJob(JobRequest $request) {    

        $input = $request->all();
        $valid = Validator::make($request->all(), array(
                    'Title' => 'required',                    
                    'JobLevelID' => 'required',
                    'IndustryID' => 'required',
                    'Description' => 'required',
                    'Requirement' => 'required',
                    'IsActive' => 'required',                    
                    'Start_date' => 'required',                    
                    'Skill'     => 'required'
        ));
        if ($valid->fails()) {
            return redirect()->back()->withErrors($valid)->with('message', 'các trường yêu cầu !');
        }
        //dd($input);die();
        $input['CompanyID'] = Auth::user()->id;
        $input['Level'] = 1;
        $input['CreateDate'] = \Carbon\Carbon::now();
        $input['CurrencyID'] = 3;
        $skill = null;
        if(count($input['Skill']) > 0){
            for ($i = 0 ; $i < count($input['Skill']) ;$i ++) {
                if($i == count($input['Skill'])-1){
                    $skill .=$input['Skill'][$i];
                }else{
                    $skill .=$input['Skill'][$i].',';
                }
            }
        }
        
        
        $input['SkillList'] = $skill;
        $CreditNumber = Auth::user()->CreditNumber;
        $credit = 'no';
        $result = null;        
        if($CreditNumber >= 1){
            $today=date('Y-m-d');
            if(Auth::user()->IsTrial == 1 ){
                $next_date= date('Y-m-d', strtotime($today. ' + 30 days'));
                $input['DateExprire'] = $next_date;
            }else{
                $next_date= date('Y-m-d', strtotime($today. ' + 30 days'));
                $input['DateExprire'] = $next_date;
            }


            $result = $this->Job->create($input);
            $arr = array();
            $arr['CreditNumber'] = $CreditNumber - 1;
            $this->User->update(Auth::user()->id,$arr);
            Auth::user()->CreditNumber = $CreditNumber - 1;
            $credit = 'yes';
        }else{
            $credit = 'no';
        }
        
        if ($result) {
            if ($request->Skill && $request->Skill != '') {
                foreach ($request->Skill as $key => $value) {
                    $check_job_skill = $this->JobSkill->where('JobID', '=', $result->id)->where('SkillID', '=', $value)->first();
                    if (!$check_job_skill)
                        $this->JobSkill->create(['JobID' => $result->id, 'SkillID' => $value]);
                }
            }
            $this->JobActstatic->create(['JobID' => $result->id]);                       
            return redirect()->route('public.company.index')->with('message', 'Job đã đăng thành công. Bạn đã sử dụng 1 tín dụng cho công việc này')->with('status', 'success')->with('credit',$credit);
        }else {
            return redirect()->route('public.company.index')->withInput()->with('message', 'Rất tiếc, bạn không có đủ tín dụng. Vui lòng mua tín dụng công việc để tiến hành công việc đăng')->with('status', 'error')->with('credit',$credit);
        }
    }

    public function getUpdateJob(Request $request) {
        $experience = Experience::all();
        $job = $this->Job->getById($request->id);
        $employment = EmploymentType::all();
        $location = $this->Location->getAll();
        $industry = $this->Industry->getAll();
        $joblevel = JobLevel::all();
        $currency = $this->Currency->where('IsActive', '=', 1)->get();
        $name = (Auth::user()->companyProfile && Auth::user()->companyProfile->Name) ? Auth::user()->companyProfile->Name : "Manage";
        return view()->make('company.modules.job.update', ['location' => $location, 'currency' => $currency, 'job' => $job, 'industry' => $industry,'joblevel'=>$joblevel,'experience'=>$experience,'employment'=>$employment])->with('title', $name);
    }

    public function postUpdateJob(JobRequest $request) {
        $input = $request->all();
        // dd($input);
        $valid = Validator::make($request->all(), array(
                    'Title' => 'required',
                    'WorkingHours' => 'required',
                    'JobLevelID' => 'required',
                    'IndustryID' => 'required',
                    // 'LocationID' => 'required',
                    'FromSalary' => 'required',
                    'ToSalary' => 'required',
                    //'CurrencyID' => 'required',
                    'Description' => 'required',
                    'Requirement' => 'required',
                    'IsActive' => 'required',
        ));
        if ($valid->fails()) {
            return redirect()->back()->withErrors($valid)->with('message', 'Fields is required !');
        }

        $input['CompanyID'] = Auth::user()->id;
        $input['CurrencyID'] = 3;
        $input['End_date']  = date('Y-m-d', strtotime($request->Start_date. ' + 30 days'));
        
        if (!isset($input['IsDisplaySalary'])) {
            $input['IsDisplaySalary'] = 0;
        }
        $result = $this->Job->update($input['id'], $input);
        if ($result) {            
            return redirect()->route('public.company.job.index')->with('message', 'Đã cập nhật thành công !')->with('status', 'success');
        } else {
            return redirect()->back()->withInput()->with('message', 'Cập nhật công việc không thành công !')->with('status', 'error');
        }
    }

    public function postDeleteJob(Request $request) {
        $job = $this->Job->getById($request->id);
        $job->appliedJob()->detach();
        $job->savedJob()->detach();
        $this->JobActstatic->where("JobID", $job->id)->delete();
        $this->JobSkill->where("JobID", $job->id)->delete();
        $result = $this->Job->delete($request->id);
        $count = $this->Job->where('CompanyID','=',Auth::user()->id)->count();
        if ($result == true) {
            return response()->json(['code' => 200,'count'=>$count]);
        } else {
            return response()->json(['code' => 500]);
        }
    }

    // get login

    public function getLogin() {
        $country = $this->Country->getAll();
        $companySize = $this->CompanySize->getAll();
        return view()->make('company.modules.home', ['country' => $country, 'companySize' => $companySize])->with('title','login');
    }

    public function postLogin(Request $request) {
        $remember = false;
        if ($request->Check == 1) {
            $remember = true;
        }
        if (Auth::attempt(['Email' => $request->Email, 'Password' => $request->Password], $remember) OR Auth::attempt(['Username' => $request->Email, 'password' => $request->Password], $remember)) {
            if (Auth::user()->IsCompany == 1) {
                return redirect()->route('public.company.index');
            } else {
                Auth::logout();
                return redirect()->back()->with('message', 'Bạn không được phép')->with('status', 'error');
            }
        } else {
            return redirect()->back()->with('message', 'Mật khẩu hoặc Email sai')->with('status', 'error');
        }
    }

    // register

    public function getRegister() {
        $companySize = $this->CompanySize->getAll();
        $industry = $this->Industry->getAll();
        return view()->make('company.modules.register', ['companySize' => $companySize, 'industry' => $industry])->with('title','Register');
    }

    public function getCompanyRegister() {
        $companySize = $this->CompanySize->getAll();
        $industry = $this->Industry->getAll();
        return view()->make('company.modules.register', ['companySize' => $companySize, 'industry' => $industry])->with('title','Company Register');
    }

    public function postCompanyregister(Request $request) {
        //dd($request->all());
        $valid = Validator::make($request->all(), [
                    'Email' => 'required|email|unique:users',
                    'Password' => 'required|min:8',
                    're_password' => 'required|same:Password',
                    'IndustryID' => 'required',
                    'CompanySizeID' => 'required',
                    'Name' => 'required',
                    'ContactNumber' => 'required|min:9',
        ]);        
        if ($valid->fails()) {            
            return redirect()->back()->withInput()->withErrors($valid);
        }       
        $user = new User;
        $user->Email = $request->Email;
        $user->IsCompany = 1;
        $user->Password = Hash::make($request->Password);
        if ($user->save()) {
            $input = $request->all();
            $input['CompanyID'] = $user->id;
            $input['IsActive'] = 1;

            //insert industry            
            $this->CompanyIndustry->create($input);
            //end 

            $company = $this->CompanyProfile->create($input);
            if ($company) {                
                
                try {
                     Mail::send(['html'=>'company.modules.test_email.mail_employer'], array('user'=>Input::get('Name')), function ($message){                    
                    $message->to(Input::get('Email'), 'Visitor')->subject('Chào mừng tới jobnow!');
                    });              
                } catch (Exception $e) {
                                  
                }              
               
                //return 'oke';
                return redirect()->route('public.company.getLogin')->with('message', 'Đăng ký thành công')->with('status', 'success');
            } else {
                $user->delete();
                return redirect()->back()->with('message', 'Đăng ký lỗi')->with('status', 'error');
            }
        }
    }

    // view contact

    public function viewContact($id) {
        $seeker = $this->Seeker->getById($id);
        return view()->make('company.modules.job.contact', ['data' => $seeker])->with('title','Chi tiết liên lạc');
    }

    public function postDeleteImageCompany(Request $request) {
        $id = $request->id;
        $res_img = $this->CompanyImage->getById($id);
        
        if ($res_img) {
            $company = $this->CompanyProfile->where('CompanyID','=',Auth::user()->id)->first();
            if ($res_img->ImageUrl == $company->CoverImage) {
                $company->CoverImage = '';
                $company->save();
            }
            File::delete(public_path() . '/' . Config::get('images.company_image_url') . $res_img->ImageUrl);
        }
        $res = $this->CompanyImage->delete($id);
        if ($res)
            return response()->json(['code' => 200]);
        else
            return response()->json(['code' => 500]);
    }

    public function getApplycants(Request $request, $id) {
        $res = $this->appliedJob->where('JobID', '=', $id)->paginate(10);
        return view('company.modules.job.showapplycant', compact('res'));
    }

    public function setInterview(Request $request) {
        //echo date('Y-m-d H:i', strtotime($request->InterviewDate));die();
        $valid = Validator::make($request->all(), [
                    'InterviewDate' => 'required',
                    //'Location' => 'required',
                    'Content' => 'required|max:14500'
        ]);
        if ($valid->fails()) {
            return redirect()->back()->withInput()->withErrors($valid)->with('message', 'Các trường yêu cầu !')->with('status', 'error');
        }
        // echo date('m/d/Y', strtotime($request->InterviewDate));

        $input = $request->all();
        $input['InterviewDate'] = date('Y-m-d H:i', strtotime($input['InterviewDate']));
        $input['CompanyID'] = Auth::user()->companyProfile->id;
        $input['Status'] = 1;        
        $model = new Interview;
        $model->fill($input);
        if ($model->save()) {
            return redirect()->back()->with('sended', 'success');
        } else {
            return redirect()->back();
        }       
    }        

    //lấy interview     
    public function getEditInterviewShortlist(Request $request) {
        $interview = Interview::select('Interview.*','JobSeeker.FullName')->where('Interview.id','=',$request->id)
                ->join('JobSeeker','JobSeeker.user_id','=','JobSeekerID')
                ->get();          
        if (count($interview) >0) {
            $interview[0]['InterviewDate'] = date('d-m-Y', strtotime($interview[0]['InterviewDate']));
            return response()->json(['code'=>200,'interview'=>$interview]);
        } else {
            return response()->json(['code' => 500]);
        }
    }


    //nếu chưa có thì thêm interview nếu có thì cập nhật
    public function editSetInterviewShortlist(Request $request) {
        //dd($request);
        $valid = Validator::make($request->all(), [
                    'InterviewDate' => 'required',                    
                    'Content' => 'required'
        ]);
        if ($valid->fails()) {
            return redirect()->back()->withInput()->withErrors($valid)->with('message', 'Fields is required !')->with('status', 'error');
        }
        $input = $request->all();
        $input['InterviewDate'] = date('Y-m-d  H:i', strtotime($input['InterviewDate']));
        $input['CompanyID'] = Auth::user()->id;
        $input['Status'] = 1;        
        $model = Interview::find($input['id']);
        $jobseeker = $this->Seeker->where('user_id','=',$model->JobSeekerID)
                                    ->join('users','users.id','=','JobSeeker.user_id')
                                    ->first();

        $this->notify->setNotificationInterview(Auth::user()->id,$model->JobSeekerID,0,'Lời mời phỏng vấn ',' Tôi muốn mời các bạn tham dự cuộc phỏng vấn',1,0,0,$input['id']);

        Mail::send(['html'=>'company.modules.test_email.send_interview'], array('company'=>Auth::user()->companyProfile->Name,'datetime'=>$input['InterviewDate'],'Name'=>$jobseeker->FullName,'Title'=>$input['Title'],'Location'=>$input['Location'],'Manage'=>$input['ContactName'],'Start_time'=>$input['Start_time'],'End_time'=>$input['End_time']), function ($message)  use ($jobseeker){
                    $message->to($jobseeker->Email, 'Visitor')->subject('Lời mời / Phỏng vấn '.Auth::user()->companyProfile->Name.' Cho vị trí '.Input::get('Title'));

            });

        $model->fill($input);
        
        if ($model->save()) {
            return redirect()->back()->with('message', 'Phỏng vấn cập nhật thành công')->with('status', 'success');
        } else {
            return redirect()->back()->with('message', 'Cập nhật lỗi !')->with('status', 'error');
        }
    }
    //delete interview

    public function delInterview(Request $request) {
        $interview = Interview::find($request->id);
        if ($interview) {
            $interview->delete();
            return redirect()->back()->with('message', 'Phỏng vấn đã được xoá thành công')->with('status', 'success');
        } else {
            return redirect()->back()->with('message', 'Xóa lỗi !')->with('status', 'error');
        }
    }

    public function rejectInterview(Request $request) {
        $interview = Interview::select('Interview.*','JobSeeker.FullName','users.id as userID','users.Email')
                        ->join('JobSeeker','JobSeeker.user_id','=','JobSeekerID')
                        ->join('users','users.id','=','JobSeekerID')                                                
                        ->where('Interview.id','=',$request->id)->first();    
        //dd($interview);die();                    
        if ($interview) {       

            /*
            select job title
             */
            $title = Notification::select('Job.Title')
                        ->where('InterviewID','=',$interview->id)
                        ->where('IsCompany','=',1)
                        ->where('JobID','>',0)
                        ->Join('Job','Job.id','=','Notification.JobID')
                        ->first();

            //dd($title->Title);die();

            $interview->IsReject = 1;
            $interview->save();
            Mail::send(['html'=>'company.modules.test_email.rejectInterview'], array('companyName'=>Auth::user()->companyProfile->Name,'username'=>$interview->FullName,'jobTitle'=>$title->Title), function ($message){
            $message->to(Input::get('Email'), 'Visitor')->subject('obNow-Ứng tuyển của bạn '.Auth::user()->companyProfile->Name );
            });

            return redirect()->back()->with('message', 'Phỏng vấn bị từ chối thành công')->with('status', 'success');
        } else {
            return redirect()->back()->with('message', 'Xóa lỗi !')->with('status', 'error');
        }
    }

    /*  Code update 
      Author: Thuyet
     */

    public function privacy() {
        return view()->make('company.modules.setting.privacy',['privacy'=>Privacy::all()])->with('title','privacy');
    }

    public function websetting() {
        return view()->make('company.modules.setting.websetting', ['user' => Auth::user()])->with('title','websetting');
    }

    public function credit() {
        //dd(Config::get('mail'));die();
        $invite = Invite::select('*')->where('User_id','=',Auth::user()->id)->get();
        return view()->make('company.modules.setting.credit',['invite'=>$invite])->with('title','credit');
    }
    
    function updateCredit(Request $request) {
        $rules = [
            'Email' => 'required',
        ];
        $message = [
            'Email.required' => 'Fields is required',
            'Email.email' => 'The wrong format email'
        ];
        $valid = Validator::make($request->all(), $rules, $message);
        if ($valid->fails()) {
            return redirect()->back()->withInput()->withErrors($valid)->with('message', 'Các trường yêu cầu !')->with('status', 'error');
        } else {
            $input = $request->all();
            $email = $this->User->where('Email','=',$input['Email'])->get();
            
            if(count($email) == 0){
                $input['User_id'] = Auth::user()->id;
                $input['Status'] = 0;
                Invite::create($input);
            }
            return redirect('ManageCompany/credit');
        }
    }

    public function feedback() {        
        return view()->make('company.modules.setting.feedback')->with('title','Phản hồi');
    }

    public function postfeedback(Request $request) {
        $rules = [
            'Title' => 'required',
            'Message' => 'required|max:14500'
        ];
        $message = [
            'Title.required' => 'Fields is required',
            'Message.required' => 'Fields is required ',
            'Message.max' => 'You have 14500 character remainings',
        ];
        $valid = Validator::make($request->all(), $rules, $message);
        if ($valid->fails()) {
            return redirect()->back()->withInput()->withErrors($valid)->with('message', 'Các trường yêu cầu !')->with('status', 'error');
        } else {
            $input = $request->all();
            $input['User_id'] = Auth::user()->id;
            $this->Feedback->create($input);

            Mail::send(['html'=>'company.modules.test_email.sendfeedback'], array('title1'=>Input::get('Title'),'message1'=>Input::get('Message')), function($message){
                $message->from(Auth::user()->Email,'Feedback about jobnow');
                $message->to('cs@jobnow.com.sg', 'Visitor')->subject('Feedback');
            });

            return view()->make('company.modules.setting.feedback', ['status' => 'success'])->with('title','Feedback');
        }
    }

    public function detailinterview(Request $request) {
        $seeker = $this->Seeker->getById($request->id);               
        
        $interview = Interview::select('Interview.id')
                        ->where('Interview.JobSeekerID','=',$seeker['user_id'])
                        ->where('Interview.CompanyID','=',Auth::user()->id)
                        ->first();
        
        $date = date('Y', strtotime($seeker['BirthDay']));
        $now = date('Y', strtotime(Carbon\Carbon::now()));
        //dd($now);die();
        //$diff = $date->diffInDays($now);        
        $seeker['year_diff'] = $now - $date;
        
        if($seeker['Avatar'] == null){
            $seeker['type'] = 'none';
        }else if(strpos($seeker['Avatar'],'http')){
            $seeker['type'] = 'link';
        }else{
            $seeker['type'] = 'file';
        }
        
        $country = $this->Country->getById($seeker->CountryID);
        if(count($country) >0){
            $seeker['CountryName'] = $country['Name'];
        }else{
            $seeker['CountryName'] = 'None country';
        }
        $seeker['Skill'] = $this->SeekerSkill->where('JobSeekerID', '=', $seeker->id)
                ->join('Skill', 'Skill.id', '=', 'JobSeekerSkill.SkillID')
                ->get(['Name']);
        $seeker['Experience'] = $this->SeekerExperience->where('JobSeekerID', '=', $seeker->id)
                ->get(['CompanyName', 'Description']);        
        return view()->make('company.modules.interview.detail', ['seeker' => $seeker,'interview_id'=>$interview->id])->with('title','detail interview');
    }

    public function shortlist() {
        //$category = new Category;
        $category = $this->Category->where('CompanyID','=',Auth::user()->id)->get();
        $c = collect($category);
        foreach($c as &$item){
            $item->Shortlist = Shortlist::select('*','Job.Title','Job.id','Notification.InterviewID')
                    ->join('Job','Job.id','=','ShortList.JobID')
                    ->join('Notification','Notification.JobID','=','Job.id') 
                    ->where('CategoryID','=',$item->id)                                       
                    ->get();
            foreach(collect($item->Shortlist) as &$item1){
                $item1->detail = $this->Seeker
                        ->where('user_id','=',$item1->UserID)
                        ->join('Country','Country.id','=','CountryID')
                        ->get();
                 $check = null;
//                dd($item1->detail);die();
                if(count($item1->detail) > 0){
                    if(strpos("$item1->detail[0]['Avatar']",'http')){
                        $check = 'link';
                    }else if("$item1->detail[0]['Avatar']" == null){
                        $check = 'none';
                    }else{
                        $check = 'avatar';
                    }
                    $item1->detail[0]['check'] = $check;
                }
            }
        }  
        //dd($c);die   ;    
        
        return view()->make('company.modules.shortlist.index', ['category' => $c])->with('title','Shortlist');
    }

    // update by hung

    //end update by hung

    public function addemployee($id) {

        $job = $this->Job->where('CompanyID','=',Auth::user()->id)->get();    

        $user = DB::select('call sp_searchEmployeeWeb(?,?)',array('',Auth::user()->id));        
        
        foreach($user as $item){
            $short = Shortlist::select('*')->where('UserID','=',$item->user_id)->where('CategoryID','=',$id)->where('JobID','=',$item->JobID)->get();
            if(count($short) >0){
                $item->exist = 'true';
            }else{
                $item->exist = 'false';
            }
        }

        $country = $this->Country->getAll();
        return view()->make('company.modules.interview.add',['country'=>$country,'categoryID'=>$id,'user'=>$user])->with('title','Add employee');
    }
    
    
    public function AddShortlist(Request $request){
        $status = $this->Shortlist->create($request->all());        
        if ($status) {
            return response()->json(['code'=>200]);
        } else {
            return response()->json(['code' => 500]);
        }
    }
    
    public function SearchEmployee(Request $request){ 
        $job = $this->Job->where('CompanyID','=',Auth::user()->id)->get(); 
        if($request->name == null){
            $request->name = '';
        }              
        $user = DB::select('call sp_searchEmployeeWeb(?,?)',array($request->name,Auth::user()->id));        
        foreach($user as $item){
            $short = Shortlist::select('*')->where('UserID','=',$item->user_id)->where('CategoryID','=',$request->CategoryID)->where('JobID','=',$item->JobID)->get();
            if(count($short) >0){
                $item->exist = 'true';
            }else{
                $item->exist = 'false';
            }
        }
        if ($user) {
            return response()->json(['code' => 200,'user'=>$user]);
        } else {
            return response()->json(['code' => 500]);
        }
    }

    public function invitecredit() {
        return view()->make('company.modules.setting.invitecredit')->with('title','Mời tham gia');
    }

    public function AddCategory(Request $request) {
        if(!isset(Auth::user()->id)){
            return view('public.company.getLogin')->with('message','Danh mục cập nhật thành công.');
        }else{
            $input = $request->all();

             $valid = Validator::make($request->all(), [
                    'Name' => 'required',                    
            ]);            
            if ($valid->fails()) {            
                return redirect()->back()->withInput()->withErrors($valid)->with('message', 'Vui lòng điền vào trường này')->with('status', 'error');;
            }

            $input['CompanyID'] = Auth::user()->id;
            
            $this->Category->create($input);
            return redirect()->back();
        }
    }

    public function getInterviewSeeker(Request $request) {
        $interview = Interview::select('*')->where('JobSeekerID','=',$request->id)->first();
        if ($interview) {
            return response()->json($interview);
        } else {
            return response()->json(['code' => 500]);
        }
    }

    //update by hung

    //update phonenumber
    public function updatePhone(Request $request){
        //$user = $this->User->getById($request->id);
        $company = $this->CompanyProfile->getById(Auth::user()->CompanyProfile->id);
        $company->ContactNumber = $request->Phone;
        //$user->Phone = $request->Phone;
        $data = $company->save();
        if($data){
            return response()->json(['code' => 200,'message'=>'Đã cập nhật điện thoại thành công!']);
        }else{
            return response()->json(['code' => 500,'message'=>'Đã cập nhật điện thoại lỗi!']);
        }

    }

    //delete a shortlist category
    public function deleteShortlistCategory(Request $request){
        $category = Category::find($request->id);
        if($category){
            Shortlist::where("CategoryID","=",$request->id)->delete();
            $category->delete();
            return response()->json(['code' => 200,'message','Đã xóa danh mục']);
        }else{
            return response()->json(['code' => 500,'message','Xóa lỗi']);
        }
    }

    public function updateShortlistCategory(Request $request){
        $category = Category::find($request->id);
        $category->Name = $request->Name; 

        //dd($request->id);die();

        if($category->save()){
            return redirect('ManageCompany/shortlist')->with('message', 'Đã cập nhật thành công');
        }else{
            return redirect()->back()->with('message', 'Updated failse !')->with('status', 'error');
        }

    }

    // public function invite(){
    //     Mail::send(['html'=>'company.modules.setting.invitecredit'], array('id_inviter'=>Auth::user()->id,''), function($message){
    //         $message->to('bkerpham94@gmail.com', 'Visitor')->subject('Visitor Feedback!');
    //     }); 
    // }

    // public function getInvite(){
    //     return view("company.modules.test_email.mail_input");
    // }
    public function postInvite(Request $request){
         $valid = Validator::make($request->all(), [
                    'Email' => 'required|email|unique:Invite',
                    'CompanyName'=>'required',
                    'FirstName'=>'required',
                    'LastName'=>'required',
        ]);
        //dd($valid->fails());
        if ($valid->fails()) {
            //dd($valid);
            return redirect()->back()->withInput()->withErrors($valid)->with('message', 'Email đã tồn tại rồi')->with('status', 'error');;
        }
        //die();
        $companyProfile = CompanyProfile::select("Name")->where("CompanyID", '=',Auth::user()->id)->first();
        $user = $companyProfile->Name;
        $invite = new Invite;
        $invite->FirstName = $request->FirstName;
        $invite->LastName = $request->LastName;
        $invite->CompanyName = $request->CompanyName;
        $invite->Email = $request->Email;
        $invite->User_id = Auth::user()->id;
        $invite->Status = 0;
        $invite->save();
                
        try {
            Mail::send(['html'=>'company.modules.test_email.mail_content'], array('id_inviter'=>Auth::user()->id,'user'=>$user,'company'=>Input::get('CompanyName'),'email'=>md5($request->Email)), function($message){
                $message->to(Input::get("Email"), 'Visitor')->subject('lời mời từ jobnow');
            });
        } catch (Exception $e) {
            return redirect()->back()->withInput()->withErrors($valid)->with('message', 'gửi email lỗi')->with('status', 'error');;
        }
        
        return redirect("ManageCompany/credit");
    }

    // public function testInvite(){
    //     return view('company.modules.test_email.mail_employer');
    // }

    //confirm invite
    public function confirmInvite(Request $request){
        $invite = Invite::where("User_id",'=',$request->company_id)->get();
        $mail = "";
        foreach($invite as $item){
            $tmp = md5($item->Email);
            if($tmp == $request->code){
                echo $tmp;
                $mail = $item->Email;
                break;
            }
        }
        //if search successful
        if($mail != ""){
            $invite = Invite::where("Email",'=',$mail)->first();
            if($invite->Status == 0){

                $credit = Auth::user()->CreditNumber + 2 ;
                $input = array();
                $input['CreditNumber'] = $credit;

                $this->User->update(Auth::user()->id,$input);
                Auth::user()->CreditNumber = $credit;

                $invite->Status = $request->a;
                $invite->save();
            }
        }
        return redirect("ManageCompany/auth/login");
    }
    // end update by hung
    
    function downloadCV($file){
        $file1 = public_path()."/uploads/cv/".$file;
        //dd($file1);die();
        return Response()->download($file1);
    }

    public function term()
    {        
        return view()->make('company.modules.setting.term',['term'=>Term::all()])->with('title','Term of condition');
    }

    public function checkout()
    {        
        return view()->make('company.modules.payment.payment')->with('title','checkout');
    }

    //send package
    public function postPackage(Request $request)
    {   
        try {
            Mail::send(['html'=>'company.modules.test_email.sendinvite'], array(), function($message){                
                $message->to(Input::get("Email"), 'Visitor')->subject('Gói bài đăng của JobNow.');
            });
            return redirect()->back()->with('message','Email đã được gửi thành công
');
        } catch (Exception $e) {
            
        }
        return redirect("ManageCompany/invitecredit");
    }    

}
