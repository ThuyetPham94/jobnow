<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\SkillRequest;
use App\Http\Controllers\Controller;
use App\Repositories\Skill\SkillRepository;
use App\Repositories\Industry\IndustryRepository;
class SkillController extends Controller
{
    protected $skill;
    protected $industry;

    public function __construct(SkillRepository $skill, IndustryRepository $industry){
        $this->skill = $skill;
        $this->industry = $industry;
    }
    public function index(Request $request)
    {
        $data = $this->skill;
        if($request->Name) {
            $data = $data->where('Name', 'like', '%'.$request->Name.'%');
        } 
        if($request->Industry) {
            $data = $data->where('IndustryID', '=', $request->Industry);
        }
        if($request->Description) {
            $data = $data->where('Description', 'like', '%'.$request->Description.'%');
        }
        $data = $data->paginate(10);
        $industry = $this->industry->getAll();
        return view('admin.modules.skill.index', ['data' => $data, 'industry'=>$industry])->with('title', 'Kỹ năng');
    }

    public function getCreate() {
        $industry = $this->industry->getAll();
        return view('admin.modules.skill.create', ['industry'=>$industry])->with('title', 'Tạo kỹ năng');
    }

    public function postCreate(SkillRequest $request)
    {
        $input = $request->all();
        $result = $this->skill->create($input);
        if($result) {
            return redirect()->route('admin.skill.getIndex')->with('messages', 'Tạo kỹ năng thành công');
        }else{
            return redirect()->back()->with('messages', 'Có lỗi xảy ra')->withInput();
        }
    }

    public function getUpdate($id) {
        $data = $this->skill->getById($id);
        $industry = $this->industry->getAll();
        return view('admin.modules.skill.update', ['data' => $data, 'industry'=>$industry])->with('title', 'Cập nhật kỹ năng');
    }

    public function postUpdate($id, SkillRequest $request)
    {
        $result = $this->skill->update($id, $request->all());

        if($result) {
            return redirect()->route('admin.skill.getIndex')->with('messages', 'Cập nhật kỹ năng thành công');
        }else{
            return redirect()->back()->with('messages', 'Có lỗi xảy ra')->withInput();
        }
    }

    public function postDelete(Request $request)
    {
        $result = $this->skill->delete($request->id);
        if($result == true) {
            return response()->json(['code' => 200]);
        }else{
            return response()->json(['code' => 500]);
        }
    }
}
