<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\Job\EloquentJobRepository;
use App\Models\Contact;
class SiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $job;

    public function __construct(EloquentJobRepository $job){
        $this->job = $job;
    }
    public function index()
    {
        $today = Date("20y-m-d");
        $count_job = $this->job->where('IsActive', '!=' , 0)->where('DateExprire','>=',$today)->count();
        return view('frontend.home', compact('count_job'));
    }

    public function postContact(Request $request) {
        $model = new Contact;
        $model->fill($request->all());
        if($model->save()) {
            return redirect()->back()->with(['message' => 'Gửi liên lạc thành công.'])->with('status', 'success');;
        }else{
            return redirect()->back()->with(['message' => 'Gửi liên lạc lỗi.'])->with('status', 'error');;
        }
    }
    
}
