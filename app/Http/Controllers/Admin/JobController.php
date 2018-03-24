<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Repositories\Job\JobRepository;
use App\Repositories\Location\LocationRepository;
use App\Repositories\Skill\SkillRepository;
use App\Repositories\Industry\IndustryRepository;
use App\Repositories\Currency\CurrencyRepository;
use App\Repositories\User\UserRepository;
use App\Repositories\CompanyProfile\CompanyProfileRepository;
use App\Repositories\JobSkill\JobSkillRepository;
use App\Repositories\JobActstatic\JobActstaticRepository;
use Validator;
use DB;


class JobController extends Controller
{
    protected $Job;
    protected $Location;
    protected $Skill;
    protected $Currency;
    protected $Industry;
    protected $user;
    protected $JobSkill;
    protected $JobActstatic;
    public function __construct(JobRepository $Job,
                                LocationRepository $Location,
                                SkillRepository $Skill,
                                CurrencyRepository $Currency,
                                IndustryRepository $Industry,
                                UserRepository $User, 
                                JobSkillRepository $JobSkill, 
                                JobActstaticRepository $JobActstatic,
                                CompanyProfileRepository $CompanyProfile
                                ) {
        $this->Job = $Job;
        $this->Location = $Location;
        $this->Skill = $Skill;
        $this->Currency = $Currency;
        $this->Industry = $Industry;
        $this->User = $User;
        $this->JobSkill = $JobSkill;
        $this->JobActstatic = $JobActstatic;
        $this->CompanyProfile = $CompanyProfile;
    }

    // action index

    public function getIndex(Request $request) {        
        $data = DB::table('Job')
            ->join('CompanyProfile', 'CompanyProfile.CompanyID', '=', 'Job.CompanyID')            
            ->select('Job.*', 'CompanyProfile.Name');        
        if($request->Title) {
            $data = $data->where('Title', 'LIKE', '%'.$request->Title.'%');
        }
        if($request->Company) {
            $company = $request->Company;
            $data = $data->where('CompanyProfile.Name','Like','%'.$company.'%');                
        }
        $data = $data->paginate(10);        
        return view()->make('admin.modules.job.index', ['data' => $data]);
    } 

    public function getView(Request $request) {
        $data = $this->Job->where('id', '=', $request->id)->first();
        $company = $this->CompanyProfile->where('CompanyID','=',$data->CompanyID)->first();
        $data->CompanyName = $company->Name;
        if($data) {
            return response()->json(['code' => 200, 'result' => $data]);
        }else{
            return response()->json(['code' => 500]);
        }
    }

    public function postDelete(Request $request)
    {
        $result = $this->Job->delete($request->id);        
        if($result == true) {
            return response()->json(['code' => 200]);
        }else{
            return response()->json(['code' => 500]);
        }
    }

    public function getCreate(){
        $company = $this->User->where('IsCompany','=', 1)->get();
        $location = $this->Location->getAll();
        $industry = $this->Industry->getAll();
        $skill    = $this->Skill->getAll();
        $currency = $this->Currency->where('IsActive' , '=' , 1)->get();
        $name = 'Create Job';
        return view()->make('admin.modules.job.create', ['company'=>$company, 'location' => $location,'currency' => $currency, 'industry' => $industry, 'skill'=>$skill])->with('title' , $name);
    }

    public function postCreate(Request $request) {
        $input = $request->all();
        //dd($input);
        $valid = Validator::make($request->all(), array(
            'Title' => 'required',
            'Position' => 'required',
            'Level' => 'required',
            'IndustryID' => 'required',
            'LocationID' => 'required',
            /*                'FromSalary' => 'required',
                            'ToSalary' => 'required',*/
            'CurrencyID' => 'required',
            'Description' => 'required',
            'Requirement' => 'required',
            'IsActive' => 'required',
            'Latitude' => 'required',
            'Longitude' => 'required',
        ));
        if($valid->fails()){
            return redirect()->back()->withErrors($valid)->with('message', 'Yêu cầu điền đầy đủ các trường');
        }
        $input['CreateDate'] = \Carbon\Carbon::now();
        $result = $this->Job->create($input);
        if ($result) {
            if($request->Skill && $request->Skill != ''){
                foreach ($request->Skill as $key => $value) {
                    $check_job_skill = $this->JobSkill->where('JobID', '=', $result->id)->where('SkillID','=',$value)->first();
                    if(!$check_job_skill)
                        $this->JobSkill->create(['JobID'=>$result->id, 'SkillID'=>$value]);
                }
            }
            $this->JobActstatic->create(['JobID'=>$result->id]);
            return redirect()->back()->with('message', 'Post job success !')->with('status', 'success');
        }else{
            return redirect()->back()->withInput()->with('message', 'Post job failse !')->with('status', 'error');
        }

    }
}
