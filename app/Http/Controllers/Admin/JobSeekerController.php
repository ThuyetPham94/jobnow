<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\JobSeeker;
use App\Repositories\JobSeeker\JobSeekerRepository;
use App\User;
use App\Repositories\User\UserRepository;


class JobSeekerController extends Controller
{
    protected $jobSeeker;
    protected $User;

    public function __construct(JobSeekerRepository $jobSeeker,UserRepository $User) {
        $this->jobSeeker = $jobSeeker;
        $this->User = $User;
    }

    // action index

    public function getIndex(Request $request) {
        $data = $this->jobSeeker;
        if($request->Name) {
            $data = $data->where('FullName', 'LIKE', '%'.$request->Name.'%');
        }
        if($request->Email) {
            $jobSeeker = $request->Email;
            $data = $data->whereHas('user', function($query) use ($jobSeeker) {
                $query->where('Email', 'LIKE', '%'.$jobSeeker.'%');
            });
        }
        $data = $data->where('IsActive', '!=' , 0)->orderBy('id', 'DESC')->paginate(10);
        //dd($data);
        // dd($data);
        return view()->make('admin.modules.jobSeeker.index', ['data' => $data]);
    } 

    public function getView(Request $request) {
        $data = $this->jobSeeker->with(['user'])->where('id', '=', $request->id)->first();
        if($data) {
            return response()->json(['code' => 200, 'result' => $data]);
        }else{
            return response()->json(['code' => 500]);
        }
    }

    public function postDelete(Request $request)
    {
        // $seeker = $this->jobSeeker->getById($request->id);
        // $id_u = $seeker->user->id;
        // $result = $this->jobSeeker->delete($request->id);
        // if($result == true) {
        //     $this->User->delete($id_u);
        //     return response()->json(['code' => 200]);
        // }else{
        //     return response()->json(['code' => 500]);
        // }
    }
}
