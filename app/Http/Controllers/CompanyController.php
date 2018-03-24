<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Repositories\Location\LocationRepository;
use App\Models\Job;
use App\Repositories\Job\JobRepository;
use App\Models\Currency;
use App\Repositories\Currency\CurrencyRepository;
use Auth;
use App\Models\CompanyProfile;
use App\Repositories\CompanyProfile\CompanyProfileRepository;
use App\Repositories\CompanyImage\CompanyImageRepository;
use App\Repositories\CompanyIndustry\CompanyIndustryRepository;
use App\Repositories\Industry\IndustryRepository;
use App\Models\AppliedJob;
use App\Repositories\AppliedJob\AppliedJobRepository;
use App\Repositories\CompanyReview\CompanyReviewRepository;


class CompanyController extends Controller
{
   	protected $Location;
   	protected $Job;
   	protected $Currency;
    protected $CompanyProfile;
    protected $CompanyReview;
    protected $AppliedJob;
    protected $CompanyImage;
    protected $CompanyIndustry;
    protected $Industry;
   	public function __construct(
        LocationRepository $Location,
        JobRepository $Job,
        CurrencyRepository $Currency,
        CompanyProfileRepository $CompanyProfile,
        CompanyReviewRepository $CompanyReview,
        AppliedJobRepository $AppliedJob,
        CompanyImageRepository $CompanyImage,
        CompanyIndustryRepository $CompanyIndustry,
        IndustryRepository $Industry
        ) {
           $this->Location       = $Location;
           $this->Job            = $Job;
           $this->Currency       = $Currency;
           $this->CompanyProfile = $CompanyProfile;
           $this->CompanyReview  = $CompanyReview;
           $this->AppliedJob     = $AppliedJob;
           $this->CompanyImage   = $CompanyImage;
           $this->CompanyIndustry= $CompanyIndustry;
           $this->Industry       = $Industry;
   	}

    public function index()
    {
        $count = $this->CompanyProfile->getAll()->count();
        return view()->make('frontend.modules.company.profile', ['total' => $count]);
    }

    // get Detail 

    public function getDetail($id, $name,Request $request) {
        $today = Date("20y-m-d");
        $data = $this->CompanyProfile->getById($id);
        
        $count = $this->Job->where('CompanyID','=',$data->CompanyID)
                            ->whereDate('DateExprire', '>=' ,$today)
                            ->where('IsActive','=',1)
                            ->count();
        
        $companyIndustry = $this->CompanyIndustry->where('CompanyID','=',$data->CompanyID)->first();
        
        if($companyIndustry != null){
            $industry = $this->Industry->getById($companyIndustry->IndustryID);
            $data['industry'] = $industry->Name;
        }else{
            $data['industry'] = '';
        }
        $data['job'] = $this->Job->where('CompanyID','=',$data->CompanyID)
                                    ->whereDate('DateExprire', '>=' ,$today)
                                    ->where('IsActive','=',1)
                                    ->paginate(10);
        $data['image'] = $this->CompanyImage->where('CompanyID','=',$data->CompanyID)->get();
        //dd($data);die();
        if($request->ajax()){
            $data['job'] = $this->Job
                            ->where('CompanyID','=',$data->CompanyID)
                            ->whereDate('DateExprire', '>=' ,$today)
                            ->where('IsActive','=',1)
                            ->paginate(10);
            return view()->make('frontend.modules.company.ajax',['data' => $data]);
        }else{
            return view()->make('frontend.modules.company.index',['data' => $data,'count'=>$count]);
        }
    }

    // review

    public function postReview(Request $request) {
        //dd($request->all());
        if(!empty(Auth::user())){
            if(Auth::user()->IsCompany == 0){
                $input = $request->all();
                $input['JobSeekerID'] = Auth::user()->jobseeker->id;
                                                
                $result = $this->CompanyReview->create($input);
                
                $count = $this->CompanyProfile->getById($input['CompanyID']);
                
                if($result) {
                    return response()->json(['code' => 200,'count'=>view()->make('frontend.modules.company.star',['data'=>$count])->render(), 'html' => view()->make('frontend.modules.company.review', ['item' => $result])->render()]);
                }else{
                    return response()->json(['code' => 500, 'message' => 'Bạn hông thể đăng đánh giá']);
                }
            }else{
                return response()->json(['code' => 500, 'message' => 'Tài khoản của bạn không thể đăng bài đánh giá']);
            }
        }else{
            return response()->json(['code' => 500, 'message' => 'Bạn chưa đăng nhập']);
        }
    }

    public function search(Request $request) {
        $data = $this->CompanyProfile->where('Name', 'LIKE', '%'.$request->keywork.'%')->where('IsActive', '=', 1)->get();
        //dd($data);
        return view()->make('frontend.modules.company.search', ['data' => $data]);
    }
    
    public function getReview(Request $request) {
        $review = $this->CompanyReview->getById($request->id);
        if($review) {
            return response()->json(['code' => 200, 'result' => $review]);
        }else{
            return response()->json(['code' => 500]);
        }
    }

    public function postEditReview(Request $request) {
        $review = $this->CompanyReview->update($request->id, $request->all());
        if($review) {
            //$review->update()
            return response()->json(['code' => 200, 'result' => $review]);
        }else{
            return response()->json(['code' => 500]);
        }
    }
    
    public function delReview(Request $request) {
        $review = $this->CompanyReview->delete($request->id);
        if($review) {
            return response()->json(['code' => 200]);
        }else{
            return response()->json(['code' => 500]);
        }
    }
}
