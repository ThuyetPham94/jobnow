<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use Auth;
use App\Repositories\User\UserRepository;
use App\Repositories\JobSeeker\JobSeekerRepository;
use App\Repositories\Country\CountryRepository;
use Mockery\CountValidator\Exception;
use User;
use Config;
use Validator;
use App\Models\JobSeekerExperience;
use App\Models\JobSeeker;
use App\Models\SavedJob;
use App\Models\AppliedJob;
use App\Models\Skill;
use App\Repositories\Skill\SkillRepository;

use App\Models\CompanyProfile;
use App\Repositories\CompanyProfile\CompanyProfileRepository;
use App\Repositories\SavedJob\SavedJobRepository;
use App\Repositories\AppliedJob\AppliedJobRepository;
use App\Repositories\JobSeekerExperience\JobSeekerExperienceRepository;
use App\Repositories\JobSeekerSkill\JobSeekerSkillRepository;
use App\Repositories\Notification\NotificationRepository;
use Intervention\Image\ImageManagerStatic as Image;
use App\Models\Interview;

class MyProfileController extends Controller
{
    protected $user;
    protected $seeker;
    protected $country;
    protected $saveJob;
    protected $appliedJob;
    protected $experince;
    protected $Skill;
    protected $JobSeekerSkill;
    protected $Noti;
    protected $CompanyProfile;
    public function __construct(UserRepository $model,CompanyProfileRepository $CompanyProfile,SkillRepository $Skill, JobSeekerRepository $seeker,CountryRepository $country, SavedJobRepository $saveJob, AppliedJobRepository $appliedJob, JobSeekerExperienceRepository $experince,JobSeekerSkillRepository $JobSeekerSkill, NotificationRepository $Noti) {
        $this->user = $model;
        $this->seeker = $seeker;
        $this->country = $country;
        $this->saveJob = $saveJob;
        $this->appliedJob = $appliedJob;
        $this->experince = $experince;
        $this->Skill = $Skill;
        $this->JobSeekerSkill = $JobSeekerSkill;
        $this->Noti = $Noti;
        $this->CompanyProfile = $CompanyProfile;
    }

    public function index()
    {
        $country = $this->country->getAll();
        $data = Auth::user();
        //dd($data);die();
        $data->CurriculumVitae = $this->seeker->where('user_id','=',Auth::user()->id)->first()->CurriculumVitae;
        //dd($data);die();
        $skill = Skill::select('id', 'Name')->get();
        return view()->make('frontend.modules.profile.index', ['data' => $data, 'country' => $country, 'skill'=>$skill]);
    }

    public function postUpdate(UserRequest $request) {
        //dd($request->all());
        $input = $request->all();
        $date = date("Y-m-d", strtotime($request->day."-".$request->mouth."-".$request->year));
        $input['BirthDay'] = $date;
        unset($input['day']);
        unset($input['mouth']);
        unset($input['year']);
        if($request->hasFile('CurriculumVitae')){
            $cv = $request->file('CurriculumVitae');
            $cv_name = time() . '_' . md5($cv->getClientOriginalName());
            $cv_ext = $cv->getClientOriginalExtension();
            if(strtolower($cv_ext) == 'pdf' || strtolower($cv_ext) == 'docx' || strtolower($cv_ext) == 'doc' || strtolower($cv_ext) == 'jpg'){
                $cv->move(Config::get('images.path_cv_upload'), $cv_name.'.'.$cv_ext);
                $url_cv = $cv_name.'.'.$cv_ext;
                unset($input['CurriculumVitae']);
                unset($input['cv']);
                $input['CurriculumVitae'] = $url_cv;
            }else{
                return redirect()->back()->with(['message'=>'Định dạng CV không thành công. Tải lên tệp pdf, doc, docx'])->with('status', 'error');
            }
            
        }
        $user = $this->user->where('id', '!=', Auth::user()->id)->where('Email', '=', $request->Email)->first();
        if(!empty($user)){
            return redirect()->back()->with(['message' => 'Email đã tồn tại, hãy thử lại.'])->with('status', 'error');
        }else {
            $user_update = $this->user->update(Auth::user()->id, $input);
            $seeker_update = $this->seeker->update(Auth::user()->jobseeker->id, $input);
            if($user_update AND $seeker_update) {
                return redirect()->back()->with(['message' => 'Cập nhật thành công.'])->with('status', 'success');
            }
        }
    }

    // get save job

    public function getSaveJob() {
        $count = $this->saveJob->where('JobSeekerID','=',Auth::user()->id)->count();
        $list_saveJob = SavedJob::select('*')->where('JobSeekerID','=',Auth::user()->id)
                                ->join('Job','Job.id','=','JobID')
                                ->paginate(10);
        foreach ($list_saveJob as$value) {
            $value->CompanyID = $this->CompanyProfile->where('CompanyID','=',$value->CompanyID)->get(['id','Logo','Name'])->first();
        }
        //dd($list_saveJob);die();
        return view()->make('frontend.modules.profile.saveJob', ['list_saveJob' => $list_saveJob,'count'=>$count])->with('title','Job saved');
    }

    // get applied job

    public function getAppliedJob() { 
        $count = $this->appliedJob->where('JobSeekerID','=',Auth::user()->id)->count();
        $list_appliedJob = $this->appliedJob->where('JobSeekerID','=',Auth::user()->id)
                                ->join('Job','Job.id','=','JobID')                                
                                ->paginate(10);
        foreach ($list_appliedJob as$value) {
            $value->CompanyID = $this->CompanyProfile->where('CompanyID','=',$value->CompanyID)->get(['id','Logo','Name'])->first();
        }
        //dd($list_appliedJob);die();     
        return view()->make('frontend.modules.profile.appliedJob', ['list_appliedJob' => $list_appliedJob,'count'=>$count])->with('title','Job applied');
    }

    //delete experince

    public function getDeleteEx(Request $request) {
        $model = $this->experince->getById($request->id)->delete();
        if($model) {
            return response()->json(['code' => 200, 'message' => 'Kinh nghiệm đã xóa thành công']);
        }else{
            return response()->json(['code' => 500, 'message' => 'Kinh nghiệm xóa lỗi']);
        }
    }
    public function postCreateEx(Request $request) {
        $valid = Validator::make($request->all(), [
            'CompanyName' => 'required',
            'PositionName' => 'required',
            'Description' => 'required',
        ]);
        if ($valid->fails()) {
            return response()->json(['code' => 500, 'message' => 'Các trường được yêu cầu']);
        }
        $input = $request->all();
        $input['JobSeekerID'] = Auth::user()->id;
        //dd($input);die();
        $model = $this->experince->create($input);
        if($model) {
            return response()->json(['code' => 200,'message'=>'Kinh nghiệm cập nhật thành công', 'data' => view()->make('frontend.modules.profile.ex', ['val' => $model])->render()]);
        }else{
            return response()->json(['code' => 500, 'message' => 'Thêm lỗi']);
        }
    }

    // create skill

    public function postCreateSkill(Request $request) {        
        try{           
            if($request->Skill != ''):
                foreach ($request->Skill as $value) {
                    $skill = $this->Skill->where('id', '=', $value)->first();
                    if($skill){
                        $check_seeker_skill = $this->JobSeekerSkill->where('JobSeekerID', '=', Auth::user()->id)->where('SkillID','=',$skill->id)->first();
                        //dd($check_seeker_skill);
                        if(!$check_seeker_skill)
                        $res = $this->JobSeekerSkill->create(['JobSeekerID'=>Auth::user()->id, 'SkillID'=>$skill->id]);

                        //$create = $this->Skill->create(['Name' => $value]);
                        //Auth::user()->jobseekerskill()->attach($create->id);
                    }
                }
            endif;
            return response()->json(['code' => 200, 'message' => 'Kỹ năng được cập nhật thành công ']);
        } catch (Exception $e){
            return response()->json(['code' => 502, 'message' => 'Bad Gateway']);
        }

    }

    public function postRemoveSkill(Request $request){
        $id = $request->id;
        if($id && Auth::user()->id){
            $res = $this->JobSeekerSkill->where('JobSeekerID', '=', Auth::user()->id)->where('SkillID','=',$id)->delete();
            if($res) return response()->json(['code' => 200, 'message' => 'Skill removed successfully']);
            else return response()->json(['code' => 500, 'message' => 'Error']);
        }else{
            return response()->json(['code' => 500, 'message' => 'Error']);
        }
    }

    public function postAvatar(Request $request) {
        $valid = Validator::make($request->all(), [
            'Avatar' => 'required|mimes:jpeg,jpg,png,JPEG,JPG,PNG'
        ]);

        if ($valid->fails()) {
            return response()->json(['code' => 500, 'message' => 'Hình ảnh phải đúng định dạng (jpeg,jpg,png)']);
        }

        if(!empty($request->file('Avatar'))){
            // echo $request->file('Avatar')->getClientOriginalName();
            $Avatar = time() .'-'. $request->file('Avatar')->getClientOriginalName();
            $input['Avatar'] = $Avatar;
            Image::make($request->file('Avatar'))->save('uploads/images/'.$Avatar);
            $result = $this->seeker->update(Auth::user()->jobSeeker->id, $input);
            if($result) {
                return response()->json(['code' => 200, 'message' => 'Đã cập nhật thành công ảnh hồ sơ', 'data' => $input['Avatar']]);
            }else{
                return response()->json(['code' => 500, 'message' => 'Update lỗi']);
            }
        }else{
            return response()->json(['code' => 500, 'message' => 'Yêu cầu không phải là tệp']);
        }
    }

    public function getInterview() {
        //dd(Auth::user()->id);die();
        $data = Interview::select('Interview.*','CompanyProfile.Name')
                    ->join('CompanyProfile','CompanyProfile.CompanyID','=','Interview.CompanyID')
                    ->where('JobSeekerID', '=' , Auth::user()->id)                    
                    ->get();     
        //dd($data);die();   
        return view()->make('frontend/modules/profile/interview', ['data' => $data]);
    }

    // get detail

    public function getDetail(Request $request) {
        $data = Interview::select('Interview.*','CompanyProfile.Name')
                            ->where('Interview.id','=', $request->id)
                            ->join('CompanyProfile','CompanyProfile.CompanyID','=','Interview.CompanyID')
                            ->get();
        //dd($data);die();
        return response()->json($data);
    }

    // set status

    public function setStatus(Request $request) {
        $interview = Interview::find($request->id);
        if($interview) {
            $interview->Status = $request->Status;
            if($interview->save()) {
                return response()->json(['code' => 200]);
            }else{
                return response()->json(['code' => 500]);
            }
        }else{
            return response()->json(['code' => 500]);
        }
    }

    public function removeNotification(Request $request){       
    }
}
