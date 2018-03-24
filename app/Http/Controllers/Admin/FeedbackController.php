<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Validator;
class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = new Feedback;
        if($request->Title) {
            $data = $data->where('Title', 'like', '%'.$request->Title.'%');
        } 
        if($request->Message) {
            $data = $data->where('Message', 'like', '%'.$request->Message.'%');
        }
       
        $data = $data->select('Email','Feedback.id','Title','Message','Feedback.created_at')->join('users','users.id','=','User_id')->paginate(10);

        return view('admin.modules.feedback.index', ['data' => $data])->with('title', 'Phản hồi');
    }

    public function postDelete(Request $request)
    {
        $result = Feedback::find($request->id)->delete();
        if($result == true) {
            return response()->json(['code' => 200]);
        }else{
            return response()->json(['code' => 500]);
        }
    }
}
