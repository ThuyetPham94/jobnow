<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Industry;
use App\Repositories\Industry\IndustryRepository;
use App\Http\Requests\IndustryRequest;

class IndustryController extends Controller
{
    protected $industry;

    public function __construct(IndustryRepository $model) {
        $this->industry = $model;
    }

    public function index(Request $request)
    {
        $data = $this->industry;
        if($request->Name) {
            $data = $data->where('Name', 'like', '%'.$request->Name.'%');
        } 
        if($request->Description) {
            $data = $data->where('Description', 'like', '%'.$request->Description.'%');
        } 
        $data = $data->paginate(10);
        return view('admin.modules.industry.index', ['data' => $data])->with('title', 'Ngành nghề');
    }

    public function getCreate() 
    {
        return view('admin.modules.industry.create')->with('title', 'Tạo ngành nghề');
    }

    public function postCreate(IndustryRequest $request)
    {
        $input = $request->all();
        $result = $this->industry->create($input);
        if($result) {
            return redirect()->route('admin.industry.getIndex')->with('messages', 'Tạo mới thành công');
        }else{
            return redirect()->back()->with('messages', 'Có lỗi xảy ra')->withInput();
        }
    }

    public function getUpdate($id) {
        $data = $this->industry->getById($id);
        return view('admin.modules.industry.update', ['data' => $data])->with('title', 'Cập nhật ngành nghề');
    }

    public function postUpdate($id, IndustryRequest $request)
    {
        $result = $this->industry->update($id, $request->all());

        if($result) {
            return redirect()->route('admin.industry.getIndex')->with('messages', 'Cập nhật thành công');
        }else{
            return redirect()->back()->with('messages', 'Có lỗi xảy ra')->withInput();
        }
    }

    public function postDelete(Request $request)
    {
        $result = $this->industry->delete($request->id);
        if($result == true) {
            return response()->json(['code' => 200]);
        }else{
            return response()->json(['code' => 500]);
        }
    }
}
