<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\Category\CategoryRepository;
use Illuminate\Support\Facades\DB;

class CategoryController extends ApiBaseController
{
    protected $Category;

    public function __construct(CategoryRepository $Category){
        $this->Category = $Category;
    }

    public function addCategory(Request $request) {
        try {
            $input = $request->all();
            $result = $this->Category->create($input);
            if($result) return $this->returnSuccess('Tạo thành công');
                return $this->returnError(404, "Thử lại sau");
        } catch (Exception $e) {
            return $this->returnError(500, "Thử lại sau");
        }
    }

    public function getListCategory($sign, $app_id, $device_type,Request $request){
        try {
            //$CompanySize = $this->Category->where('CompanyID','=',$request->CompanyID)->orderBy('id', 'ASC')->get();
            $CompanySize = DB::select('call sp_getCategoryByCompanyID(?)',array($request->CompanyID)); 
            return $this->returnSuccess('Success!', $CompanySize);
        } catch (Exception $e) {
            return $this->returnError('500', "Thử lại sau");
        }
    }

    public function updateCategory(Request $request) {
            try {
                $result = $this->Category->Where('id','=',$request->CategoryID)->first();
                $result->Name = $request->Name;
                $result->save();
                return $this->returnSuccess('Category updated successfully');
            } catch (Exception $e) {
                return $this->returnError(500, "Thử lại sau");
            }
        }

    public function deleteCategory(Request $request) {
            try {
                DB::select('DELETE FROM ShortList WHERE CategoryID = ?',array($request->CategoryID)); 
                $this->Category->Where('id','=',$request->CategoryID)->delete();
                return $this->returnSuccess('Category deleted successfully');
            } catch (Exception $e) {
                return $this->returnError(500, "Thử lại sau");
            }
        }
}
