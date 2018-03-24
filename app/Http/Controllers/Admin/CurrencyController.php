<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Repositories\Currency\CurrencyRepository;
use App\Http\Requests\CurrencyRequest;

class CurrencyController extends Controller
{
    protected $currency;

    public function __construct(CurrencyRepository $model) {
        $this->currency = $model;
    }

    public function index(Request $request)
    {
        $data = $this->currency;
        if($request->Name) {
            $data = $data->where('Name', 'like', '%'.$request->Name.'%');
        } 
        if($request->Symbol) {
            $data = $data->where('Symbol', 'like', '%'.$request->Symbol.'%');
        } 
        if($request->Description) {
            $data = $data->where('Description', 'like', '%'.$request->Description.'%');
        }
        $data = $data->paginate(10);
        return view('admin.modules.currency.index', ['data' => $data])->with('title', 'Currency');
    }

    public function getCreate() 
    {
        return view('admin.modules.currency.create')->with('title', 'Create currency');
    }

    public function postCreate(CurrencyRequest $request)
    {
        $input = $request->all();
        $result = $this->currency->create($input);
        if($result) {
            return redirect()->route('admin.currency.getIndex')->with('messages', 'Currency created successfully');
        }else{
            return redirect()->back()->with('messages', 'Has error')->withInput();
        }
    }

    public function getUpdate($id) {
        $data = $this->currency->getById($id);
        return view('admin.modules.currency.update', ['data' => $data])->with('title', 'Update currency');
    }

    public function postUpdate($id, CurrencyRequest $request)
    {
        $result = $this->currency->update($id, $request->all());

        if($result) {
            return redirect()->route('admin.currency.getIndex')->with('messages', 'Currency updated successfully');
        }else{
            return redirect()->back()->with('messages', 'Has error')->withInput();
        }
    }

    public function postDelete(Request $request)
    {
        $result = $this->currency->delete($request->id);
        if($result == true) {
            return response()->json(['code' => 200]);
        }else{
            return response()->json(['code' => 500]);
        }
    }
}
