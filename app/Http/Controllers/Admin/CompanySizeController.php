<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\CompanySize;
use App\Repositories\CompanySize\CompanySizeRepository;
use App\Http\Requests\CompanySizeRequest;

class CompanySizeController extends Controller
{

    protected $companysize;

    public function __construct(CompanySizeRepository $model) {
        $this->companysize = $model;
    }

    public function index(Request $request)
    {

        $data = $this->companysize;
        if($request->Name) {
            $data = $data->where('Name', 'like', '%'.$request->Name.'%');
        } 
        if($request->Description) {
            $data = $data->where('Description', 'like', '%'.$request->Description.'%');
        } 
        $data = $data->paginate(10);
        return view('admin.modules.companysize.index', ['data' => $data])->with('title', 'Quy mô công ty');

    }

    public function getCreate() 
    {
        return view('admin.modules.companysize.create')->with('title', 'Tạo quy mô công ty');
    }

    public function postCreate(CompanySizeRequest $request)
    {
        $input = $request->all();
        $result = $this->companysize->create($input);
        if($result) {
            return redirect()->route('admin.companysize.getIndex')->with('messages', 'Tạo thành công');
        }else{
            return redirect()->back()->with('messages', 'Có lỗi xảy ra')->withInput();
        }
    }

    public function getUpdate($id) {
        $data = $this->companysize->getById($id);
        return view('admin.modules.companysize.update', ['data' => $data])->with('title', 'Cập nhật quy mô ');
    }

    public function postUpdate($id, CompanySizeRequest $request)
    {

        $result = $this->companysize->update($id, $request->all());

        if($result) {
            return redirect()->route('admin.companysize.getIndex')->with('messages', 'Cập nhật thành công');
        }else{
            return redirect()->back()->with('messages', 'Có lỗi xảy ra')->withInput();
        }
    }



    public function postDelete(Request $request)
    {
        $result = $this->companysize->delete($request->id);
        if($result == true) {
            return response()->json(['code' => 200]);
        }else{
            return response()->json(['code' => 500]);
        }
    }
}
