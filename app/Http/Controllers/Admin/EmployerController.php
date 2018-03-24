<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\CompanyProfile;
use App\Repositories\CompanyProfile\CompanyProfileRepository;

class JobSeekerController extends Controller
{
    protected $company;

    public function __construct(CompanyProfile $company) {
        $this->company = $company;
    }

    // action index

    public function getIndex(Request $request) {
        $data = $this->company;
        if($request->Name) {
            $data = $data->where('Name', 'LIKE', '%'.$request->Name.'%');
        }
        if($request->ContactNumber) {
            $data = $data->where('ContactNumber', 'LIKE', '%'.$request->Name.'%');
        }
        if($request->ContactName) {
            $data = $data->where('ContactName', 'LIKE', '%'.$request->ContactName.'%');
        }
        if($request->Email) {
            $company = $request->Email;
            $data = $data->whereHas('users', function($query) use ($company) {
                $query->where('Email', 'LIKE', '%'.$company.'%');
            });
        }
        $data = $data->where('IsActive', '!=' , 0)->orderBy('id', 'DESC')->paginate(10);
        // dd($data);
        return view()->make('admin.modules.company.index', ['data' => $data]);
    } 

    public function getView(Request $request) {
        $data = $this->company->with(['company','currency'])->where('id', '=', $request->id)->first();
        if($data) {
            return response()->json(['code' => 200, 'result' => $data]);
        }else{
            return response()->json(['code' => 500]);
        }
    }

    public function postDelete(Request $request)
    {
        $result = $this->company->delete($request->id);
        // $result->appliedcompany()->detach();
        if($result == true) {
            return response()->json(['code' => 200]);
        }else{
            return response()->json(['code' => 500]);
        }
    }
}
