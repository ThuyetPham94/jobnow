<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\CompanyProfileRequests;
use App\Http\Controllers\Controller;
use App\User;
use App\Models\CompanyProfile;
use App\Models\Job;
use App\Repositories\CompanyProfile\CompanyProfileRepository;
use App\Repositories\User\UserRepository;

class CompanyProfileController extends Controller
{
    protected $companyprofile;
    protected $user;

    public function __construct(CompanyProfileRepository $model, UserRepository $user) {
        $this->companyprofile = $model;
        $this->user = $user;
    }

    public function index(Request $request)
    {
        $data = $this->companyprofile;

        if($request->Name){
            $data = $data->where('Name', 'LIKE', '%'.$request->Name.'%');
        }
        if($request->Email){
            $email = $request->Email;
            $data = $data->whereHas('users', function($query) use ($email) {
                $query->where('Email', '=', $email);
            });
        }
        if($request->ContactName){
            $data = $data->where('ContactName', 'LIKE', '%'.$request->ContactName.'%');
        }
        if($request->ContactPhone){
            $data = $data->where('ContactPhone', 'LIKE', '%'.$request->ContactPhone.'%');
        }
        $data = $data->where('IsActive', '=', 1)->orderBy('id', 'DESC')->paginate(10);
        return view('admin.modules.companyprofile.index', ['data' => $data])->with('title', 'Công ty');
    }

    public function getView(Request $request) {
        $data = $this->companyprofile->with(['users','companySize'])->where('id', '=', $request->id)->first();
        if($data) {
            return response()->json(['code' => 200, 'result' => $data]);
        }else{
            return response()->json(['code' => 500]);
        }
    }

    public function getCreate() 
    {
        $list_user = $this->user->where('IsCompany', '=', 1)->get();
        return view('admin.modules.companyprofile.create')->with('title', 'Create companyprofile')->with('list_user', $list_user);
    }

    public function postCreate(Request $request)
    {
        $input = $request->all();
        $result = $this->companyprofile->create($input);
        if($result) {
            return redirect()->route('admin.companyprofile.getIndex')->with('messages', 'Company profile created successfully');
        }else{
            return redirect()->back()->with('messages', 'Has error')->withInput();
        }
    }

    public function getUpdate($id) {
        $data = $this->companyprofile->getById($id);
        $list_user = $this->user->where('IsCompany', '=', 1)->get();
        return view('admin.modules.companyprofile.update', ['data' => $data])->with('title', 'Update company profile')->with('title', 'Create companyprofile')->with('list_user', $list_user);
    }

    public function postUpdate($id, Request $request)
    {
        $result = $this->companyprofile->update($id, $request->all());

        if($result) {
            return redirect()->route('admin.companyprofile.getIndex')->with('messages', 'Company profile updated successfully');
        }else{
            return redirect()->back()->with('messages', 'Has error')->withInput();
        }
    }

    public function postDelete(Request $request)
    {
        $company = $this->companyprofile->getById($request->id);
        $id_u = $company->users->id;
        $result = $this->user->delete($id_u);
        if($result == true) {
            $this->user->delete($id_u);
            return response()->json(['code' => 200]);
        }else{
            return response()->json(['code' => 500]);
        }
    }
}
