<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Privacy;
class PrivacyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
       
    }

    public function index()
    {
        $data = new Privacy;        
       
        $data = $data->paginate(10);

        return view('admin.modules.privacy.index', ['data' => $data])->with('title', 'Chính sách');
    }

    public function getCreate()
    {
        return view('admin.modules.privacy.create');
    }

    public function postCreate(Request $request)
    {
        
        $input = $request->all();



        $result = Privacy::create($input);
        
        if($result) {
            return redirect()->route('admin.privacy.getIndex')->with('messages', 'Tạo thành công');
        }else{
            return redirect()->back()->with('messages', 'Has error')->withInput();
        }
    }

    public function getUpdate($id) {        
        $data = Privacy::find($id);
        return view('admin.modules.privacy.update', ['data' => $data])->with('title', 'Cập nhật');
    }

    public function postUpdate($id, Request $request)
    {
        //dd($request->all());die();
        $privacy = Privacy::where("id",'=',$id)->first();
        $privacy->Title =$request->Title;
        $privacy->Description =$request->Description;
        $result = $privacy->save();

        if($result) {
            return redirect()->route('admin.term.getIndex')->with('messages', 'Cập nhật thành công');
        }else{
            return redirect()->back()->with('messages', 'Has error')->withInput();
        }
    }


    public function postDelete(Request $request)
    {
        $result = Privacy::where('id','=',$request->id)->delete();
        if($result == true) {
            return response()->json(['code' => 200]);
        }else{
            return response()->json(['code' => 500]);
        }
    }

}
