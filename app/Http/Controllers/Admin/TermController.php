<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Term;
class TermController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = new Term;        
       
        $data = $data->paginate(10);

        return view('admin.modules.term.index', ['data' => $data])->with('title', 'Kỳ hạn và điều kiện');
    }

    public function getCreate()
    {
        return view('admin.modules.term.create');
    }

    public function postCreate(Request $request)
    {
        
        $input = $request->all();



        $result = Term::create($input);
        
        if($result) {
            return redirect()->route('admin.term.getIndex')->with('messages', 'Tạo thành công');
        }else{
            return redirect()->back()->with('messages', 'Has error')->withInput();
        }
    }

    public function getUpdate($id) {        
        $data = Term::find($id);
        return view('admin.modules.term.update', ['data' => $data])->with('title', 'Cập nhật');
    }

    public function postUpdate($id, Request $request)
    {
        //dd($request->all());die();
        $term = Term::where("id",'=',$id)->first();
        $term->Title =$request->Title;
        $term->Description =$request->Description;
        $result = $term->save();

        if($result) {
            return redirect()->route('admin.term.getIndex')->with('messages', 'Cập nhật thành công');
        }else{
            return redirect()->back()->with('messages', 'Has error')->withInput();
        }
    }


    public function postDelete(Request $request)
    {
        $result = Term::where('id','=',$request->id)->delete();
        if($result == true) {
            return response()->json(['code' => 200]);
        }else{
            return response()->json(['code' => 500]);
        }
    }

}
