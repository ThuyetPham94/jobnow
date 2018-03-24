<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\Shortlist\ShortlistRepository;
use App\Models\Shortlist;
use Illuminate\Support\Facades\DB;
use Config;
class ShortlistController extends ApiBaseController
{
    protected $Shortlist;

    public function __construct(ShortlistRepository $Shortlist){
        $this->Shortlist = $Shortlist;
    }

    public function getShortlist($sign, $app_id, $device_type,Request $request){
        try {
          
            //$Shortlist = $this->Shortlist->where('CategoryID','=',$request->CategoryID)->orderBy('id', 'ASC')->get();
            
            $Shortlist = DB::select('call sp_getShortList(?)',array($request->CategoryID)); 
            $collection = collect($Shortlist);
            foreach ($collection as $key => $value) {
                if(substr(trim($value->Avatar), 0,4) !== 'http'){
                    $value->Avatar  = Config::get('images.base_domain').Config::get('images.url').$value->Avatar;
                }
            }
            return $this->returnSuccess('Success!', $collection);
        } catch (Exception $e) {
            return $this->returnError('500', "Thử lại sau");
        }
    }

    public function addShortlist(Request $request){
        try {            
            $JobUpdate = $this->Shortlist
                                ->where('CategoryID','=',$request->CategoryID)
                                ->where('UserID','=',$request->UserID)->first();
            if($JobUpdate == null)
            {
                $result = $this->Shortlist->create($request->all());
                if($result) return $this->returnSuccess('Shortlist added successfully');
            }
            return $this->returnError(404, 'The employee already exists!');
        } catch (Exception $e) {
            return $this->returnError('500', "Thử lại sau");
        }
        
    }

    public function deleteShortlist(Request $request){
        try {            
            $JobDelete = $this->Shortlist
                                ->where('CategoryID','=',$request->CategoryID)
                                ->where('UserID','=',$request->UserID)->delete();
            if($JobDelete) return $this->returnSuccess('Category deleted successfully');
            return $this->returnError(404,"Thử lại sau");
        } catch (Exception $e) {
            return $this->returnError('500',"Thử lại sau");
        }
        
    }
}
