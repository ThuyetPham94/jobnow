<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Job;
use App\User;
use DB;
class HomeController extends Controller
{
    public function getIndex() {
        $company = User::where('IsCompany', 1)->get();
        $seeker = User::where('IsCompany', 0)->get();
        $job = Job::where('IsActive', 1)->get();
        $chart_company = User::select(DB::raw('count(id) as company_count'), DB::Raw('DATE(created_at) day'))->where('IsCompany', 1)->groupBy('day')->orderBy('day', 'DESC')->skip(0)->take(10)->get();
        $chart_seeker = User::select(DB::raw('count(id) as seeker_count'), DB::Raw('DATE(created_at) day'))->where('IsCompany', 0)->groupBy('day')->orderBy('day', 'DESC')->skip(0)->take(10)->get();
        $chart_job = Job::select(DB::raw('count(id) as job_count'), DB::Raw('DATE(created_at) day'))->groupBy('day')->orderBy('day', 'DESC')->skip(0)->take(10)->get();
        return view()->make('admin.modules.index' ,['company' => $company, 'seeker' => $seeker, 'job' => $job, 'chart_company'=>$chart_company, 'chart_job'=>$chart_job,'chart_seeker'=>$chart_seeker])->with('title', 'Dashboard');
    }
}
