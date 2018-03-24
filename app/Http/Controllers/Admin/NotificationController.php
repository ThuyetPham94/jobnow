<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Repositories\Notification\NotificationRepository;
use App\Repositories\JobSeeker\JobSeekerRepository;
use App\Repositories\CompanyProfile\CompanyProfileRepository;
use App\Http\Requests\NotificationRequest;
use App\Repositories\User\UserRepository;
use Validator;
class NotificationController extends Controller
{
    protected $notification;
    protected $jobseeker;
    protected $user;
    protected $company;
    public function __construct(NotificationRepository $model, UserRepository $user,JobSeekerRepository $jobseeker,
        CompanyProfileRepository $company) {
        $this->notification = $model;
        $this->user = $user;
        $this->jobseeker = $jobseeker;
        $this->company = $company;
    }

    public function index(Request $request)
    {
        $data = $this->notification;
        if($request->Name) {
            $data = $data->where('Name', 'like', '%'.$request->Name.'%');
        } 
        if($request->Description) {
            $data = $data->where('Description', 'like', '%'.$request->Description.'%');
        } 
        $data = $data->paginate(10);

        return view('admin.modules.notification.index', ['data' => $data])->with('title', 'Thông báo');
    }

    public function getCreate() 
    {
        $JobSeeker = $this->jobseeker->getAll();
        $company = $this->company->getAll();
        $user = $this->user->getAll();
        return view('admin.modules.notification.create', ['user' => $user,'JobSeeker'=>$JobSeeker,'company'=>$company])->with('title', 'Tạo thông báo');
    }

    public function postCreate(NotificationRequest $request)
    {
        // $valid = Validator::make($request->all(), [
        //     'User' => 'required',
        // ]);
        // if ($valid->fails()) {
        //     return response()->json(['code' => 500, 'message' => 'Fields required']);
        // }
        $input = $request->all();
        // foreach ($request->User as $key => $value) {
        //     //$input['MembershipID'] = $value;
            
        // }
        $result = $this->notification->create($input);
        
        if($result) {
            return redirect()->route('admin.notification.getIndex')->with('messages', 'Tạo thông báo thành công');
        }else{
            return redirect()->back()->with('messages', 'Có lỗi xảy ra')->withInput();
        }
    }

    public function getUpdate($id) {
        $JobSeeker = $this->jobseeker->getAll();
        $company = $this->company->getAll();
        
        $data = $this->notification->getById($id);        
        return view('admin.modules.notification.update', ['data' => $data,'JobSeeker'=>$JobSeeker,'company'=>$company])->with('title', 'Cập nhật thông báo');
    }

    public function postUpdate($id, NotificationRequest $request)
    {
        
        $input = $request->all();        
        $check_user = $this->notification->where('id', '=', $id)->first();
            if($check_user){
                $result = $this->notification->update($id, $request->all());
            }else{                                
                $result = $this->notification->create($input);
            }
        

        if($result) {
            return redirect()->route('admin.notification.getIndex')->with('messages', 'Cập nhật thành công');
        }else{
            return redirect()->back()->with('messages', 'Có lỗi xảy ra')->withInput();
        }
    }

    public function postDelete(Request $request)
    {
        $result = $this->notification->delete($request->id);
        if($result == true) {
            return response()->json(['code' => 200]);
        }else{
            return response()->json(['code' => 500]);
        }
    }
}
