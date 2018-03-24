<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Repositories\Job\JobRepository;
use App\Models\Skill;
use App\Models\JobLevel;
use App\Repositories\Skill\SkillRepository;
use App\Models\Location;
use App\Repositories\Location\LocationRepository;

use App\Models\CompanyIndustry;
use App\Models\Experience;
use App\Repositories\CompanyIndustry\CompanyIndustryRepository;

use App\Models\Interview;
use App\Repositories\Interview\InterviewRepository;

use App\Repositories\Industry\IndustryRepository;
use App\Repositories\AppliedJob\AppliedJobRepository;
use App\Repositories\CompanyProfile\CompanyProfileRepository;
use App\Http\Controllers\NotificationController;
use App\Repositories\JobSeeker\JobSeekerRepository;
use Auth;

class JobController extends Controller
{
    protected $Job;
    protected $Skill;
    protected $Location;
    protected $Industry;
    protected $appliedJob;
    protected $level_name;
    protected $company_industry;
    protected $companyprofile;
    protected $notify;
    protected $interview;
    protected $JobSeeker;
    public function __construct(
        JobRepository $Job,
        SkillRepository $Skill,
        LocationRepository $Location, 
        IndustryRepository $Industry,
        AppliedJobRepository $appliedJob,
        CompanyProfileRepository $companyprofile,
        CompanyIndustryRepository $company_industry,
        NotificationController $notify,
        InterviewRepository $interview,
        JobSeekerRepository $JobSeeker) {
        $this->Job        = $Job;
        $this->Skill      = $Skill;
        $this->Location   = $Location;
        $this->Industry   = $Industry;
        $this->appliedJob = $appliedJob;
        $this->companyprofile = $companyprofile;
        $this->company_industry = $company_industry;
        $this->level_name = array(1=>'Entry Level', 2=>'Experienced (non-manager)', 3=>'Manager', 4=>'Director and above');
        $this->notify = $notify;
        $this->JobSeeker = $JobSeeker;
        $this->interview = $interview;
    }

    public function index(Request $request)
    {
        $today = Date("20y-m-d");
        $data = $this->Job;                
        $skills = $this->Skill->where('IsActive', '=', 1)->get();
        $locations = $this->Location->where('IsActive', '=', 1)->get();
        $experience = Experience::all();
        $industry = $this->Industry->getAll();
        if($request->Title) {
            $data = $data->where('Title', 'LIKE', '%'.$request->Title.'%');
        }
        if($request->Industry) {
            $data = $data->where('IndustryID', '=', $request->Industry);
        }

        if($request->FromSalary) {
            $data = $data->where('FromSalary', '>=', $request->FromSalary);
        }

        $data = $data->where('IsActive', '!=' , 0)->where('DateExprire','>=',$today);
        $count = $data->count();
        if($request->skill) {
            $input_skill = $request->skill;
            $data = $data->whereHas('skill', function ($query) use ($input_skill) {
                $query->where(function ($q) use ($input_skill) {
                    foreach ($input_skill as $value) {
                        $q->orWhere('SkillID', '=', $value);
                    } 
                });
            });
        }

        if($request->experience){
            $input_experience = $request->experience;
            $data = $data->where(function ($query)  use ($input_experience)  {
                foreach ($input_experience as $value) {
                    $query->orWhere('ExperienceID', '=',$value);
                }
            });
        }

        if($request->location) {
            $input_location = $request->location;
            $data = $data->where(function ($query)  use ($input_location)  {
                foreach ($input_location as $value) {
                    $query->orWhere('LocationID', '=',$value);
                }
            });
        }
        if($request->level) {
            $input_level = $request->level;
            $data = $data->where(function ($query)  use ($input_level)  {
                foreach ($input_level as $value) {
                    $query->orWhere('Level', '=',$value);
                }
            });
        }
        if($request->Date) {
            $data = $data->orderBy('created_at', $request->Date);
        }else{
            $data = $data->orderBy('id', 'DESC');
        }        

        if($request->ajax()) {
            $data = $data->paginate(10);
            foreach ($data as $key => $value) {
                $data_company = $this->companyprofile->where('CompanyID', '=', $value->CompanyID)->first();
                $value->company_info = $data_company;
                $value->joblevel = JobLevel::select('Name')->where('JobLevel.id','=',$value->JobLevelID)->first()->Name;
            }
            return view()->make('frontend.modules.job.ajax', ['data' => $data, 'level_name' => $this->level_name])->render();
        }else{
            $data = $data->paginate(10);
            foreach ($data as $key => $value) {
                $data_company = $this->companyprofile->where('CompanyID', '=', $value->CompanyID)->first();
                $value->company_info = $data_company;
                $value->joblevel = JobLevel::select('Name')->where('JobLevel.id','=',$value->JobLevelID)->first()->Name;
            }

            return view()->make('frontend.modules.job.index', ['data' => $data,'count'=>$count,'experience'=>$experience])->with('skills' , $skills)->with('locations' , $locations)->with('industry' , $industry)->with('level_name' , $this->level_name);
        }
    }

    public function getDetail($id, $name) {
        
        $data = $this->Job->getById($id);
        // dd($data->company->companyImage->first());
        $check = 0;
        if(!empty(Auth::user())) {
            foreach (Auth::user()->appliedJob as $value) {
                if ($value->id == $data->id) {
                    $check = 1;
                    break;
                }else{
                    $check = 0;
                }
            }
        }else{
            $check = 0;
        }
        $data['company'] = $this->companyprofile->where('CompanyID','=',$data['CompanyID'])->first();
        $data['company']['industry'] = $this->company_industry->where('CompanyID','=',$data['company']['id']);
        $data['company']['industry'] = $this->Industry->getById($data['company']['IndustryID']);
        
        $skill = explode(',',$data->SkillList);
        //dd(count($skill));die;
        $arr = array();
        for ($i=0; $i < count($skill) ; $i++) { 
            $arr[]= Skill::find($skill[$i])->Name;
        }
        $data['Category'] = $arr;
        
        $data['joblevel'] = JobLevel::find($data['JobLevelID']);
        $data['applied'] = $this->appliedJob->where('JobID','=',$id)
                                ->join('JobSeeker','JobSeeker.user_id','=','AppliedJob.JobSeekerID')
                                ->join('users','users.id','=','AppliedJob.JobSeekerID')
                                ->get(['JobSeeker.FullName','AppliedJob.created_at','users.Email']);
        $data['Experience'] = Experience::select('Name')
                                        ->where('Experience.id','=',$data->ExperienceID)
                                        ->first();
        //dd($data);die();
        if($data) {
            return view()->make('frontend.modules.job.detail', ['data' => $data, 'check' => $check]);
        }else{
            abort(404);
        }
    }
    
    public function postSaved(Request $request) {
        if(!empty(Auth::user())){
            $job = $request->idJob;
            $check = Auth::user()->savedJob()->where('JobID','=',$job)->get();
            // /dd($check);
            if(count($check)) {
                Auth::user()->savedJob()->detach($job);
            }else{
                Auth::user()->savedJob()->attach($job);
            }
            $count = Auth::user()->savedJob()->where('JobSeekerID','=',Auth::user()->id)->count();
            return response()->json(['code' => 200,'count'=>$count]);
        }else{
            return response()->json(['code' => 500]);
        }
    }


    public function postApplyJob(Request $request) {
        if(!empty(Auth::user())){
            $job = $request->idJob;
            $check = Auth::user()->appliedJob()->where('JobID','=',$job)->get();
            if(count($check)) {
                Auth::user()->appliedJob()->detach($job);
            }else{
                Auth::user()->appliedJob()->attach($job);
            }
            $count = Auth::user()->appliedJob()->where('JobSeekerID','=',Auth::user()->id)->count();
            return response()->json(['code' => 200,'count'=>$count]);
        }else{
            return response()->json(['code' => 500]);
        }
    }

    public function postApplied(Request $request) {
        if(!empty(Auth::user())){
            $job = $request->idJob;
            $check = Auth::user()->appliedJob()->where('JobID','=',$job)->get();
            
            if(count($check)) {
                return response()->json(['code' => 500, 'message' => 'Bạn đã ứng tuyển công việc này']);
            }else{
                Auth::user()->appliedJob()->attach($job);
            }
            $data = $this->Job->getById($job);
            $JobS = $this->JobSeeker->where('user_id', '=', Auth::user()->id)->first();

            $this->notify->setNotificationInterview($data->CompanyID,Auth::user()->id,$job,'Apply Job',$JobS ->FullName.' Muốn ứng tuyển công việc của bạn',2,0,1,0);

            
            $input = array();
            $input['CompanyID'] = $data['CompanyID'];
            $input['JobSeekerID'] = Auth::user()->id;
            $input['InterviewDate'] = Date("20y-m-d");
            $input['Status'] = 4;
            //create interview
            $this->interview->create($input);
            //end


            return response()->json(['code' =>200,'message' => 'Áp dụng thành công']);
        }else{
            return response()->json(['code' =>500, 'message' => 'Ứng tuyển lỗi']);
        }
    }

    //get skill

    public function getSkill(Request $request) {
        if($request->id) {
            $skills = $this->Skill->where('IndustryID', '=', $request->id)->get();
        }else{
            $skills = $this->Skill->getAll();
        }
        if($skills) {
            return response()->json(['result' => $skills]);
        }else{
            return response()->json(['result' => null]);
        }
    }
    
}
