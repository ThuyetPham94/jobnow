<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\LocationRequest;
use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Repositories\Location\LocationRepository;

class LocationController extends Controller
{

    protected $location;

    public function __construct(LocationRepository $model) {
        $this->location = $model;
    }

    public function index(Request $request)
    {
        $data = $this->location;
        if($request->Name) {
            $data = $data->where('Name', 'like', '%'.$request->Name.'%');
        } 
        if($request->ZipCode) {
            $data = $data->where('ZipCode', 'like', '%'.$request->ZipCode.'%');
        } 
        $data = $data->paginate(10);
        return view('admin.modules.location.index', ['data' => $data])->with('title', 'Danh sách các huyện');
    }

    public function getCreate() {
        return view('admin.modules.location.create')->with('title', 'Tạo mới');
    }

    public function postCreate(LocationRequest $request)
    {
        $input = $request->all();
        $input['CountryID'] = 1;
        $result = $this->location->create($input);
        if($result) {
            return redirect()->route('admin.location.getIndex')->with('messages', 'Tạo huyện thành công');
        }else{
            return redirect()->back()->with('messages', 'Có lỗi xảy ra')->withInput();
        }
    }

    public function getUpdate($id) {
        $data = $this->location->getById($id);
        return view('admin.modules.location.update', ['data' => $data])->with('title', 'Cập nhật');
    }

    public function postUpdate($id, LocationRequest $request)
    {
        $result = $this->location->update($id, $request->all());

        if($result) {
            return redirect()->route('admin.location.getIndex')->with('messages', 'Cập nhật thành công');
        }else{
            return redirect()->back()->with('messages', 'Có lỗi xảy ra')->withInput();
        }
    }

    public function postDelete(Request $request)
    {
        $result = $this->location->delete($request->id);
        if($result == true) {
            return response()->json(['code' => 200]);
        }else{
            return response()->json(['code' => 500]);
        }
    }
}
