<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\JobLevel;
class JobLevelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = new JobLevel;        
       
        $data = $data->paginate(10);
        //dd($data);die();
        return view('admin.modules.joblevel.index', ['data' => $data])->with('title', 'Cấp bậc công việc');
    }

    public function getCreate()
    {
        return view('admin.modules.joblevel.create');
    }

    public function postCreate(Request $request)
    {
        
        $input = $request->all();

        $result = JobLevel::create($input);
        
        if($result) {
            return redirect()->route('admin.joblevel.getIndex')->with('messages', 'Tạo thành công');
        }else{
            return redirect()->back()->with('messages', 'Has error')->withInput();
        }
    }

    public function getUpdate($id) {        
        $data = JobLevel::find($id);
        return view('admin.modules.joblevel.update', ['data' => $data])->with('title', 'Cập nhật');
    }

    public function postUpdate($id, Request $request)
    {
        //dd($request->all());die();
        $joblevel = JobLevel::where("id",'=',$id)->first();
        $joblevel->Name =$request->Title;        
        $result = $joblevel->save();
        if($result) {
            return redirect()->route('admin.joblevel.getIndex')->with('messages', 'Cập nhật thành công');
        }else{
            return redirect()->back()->with('messages', 'Has error')->withInput();
        }
    }


    public function postDelete(Request $request)
    {
        $result = JobLevel::where('id','=',$request->id)->delete();
        if($result == true) {
            return response()->json(['code' => 200]);
        }else{
            return response()->json(['code' => 500]);
        }
    }

}
