<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Repositories\Country\CountryRepository;
use App\Http\Requests\CountryRequest;

class CountryController extends Controller
{

    protected $country;

    public function __construct(CountryRepository $model) {
        $this->country = $model;
    }

    public function index(Request $request)
    {
        $data = $this->country;
        if($request->Name) {
            $data = $data->where('Name', 'like', '%'.$request->Name.'%');
        } 
        if($request->PostalCode) {
            $data = $data->where('PostalCode', 'like', '%'.$request->PostalCode.'%');
        } 
        if($request->Description) {
            $data = $data->where('Description', 'like', '%'.$request->Description.'%');
        } 
        $data = $data->paginate(10);
        return view('admin.modules.country.index', ['data' => $data])->with('title', 'Country');
    }

    public function getCreate() 
    {
        return view('admin.modules.country.create')->with('title', 'Create country');
    }

    public function postCreate(CountryRequest $request)
    {
        $input = $request->all();
        $result = $this->country->create($input);
        if($result) {
            return redirect()->route('admin.country.getIndex')->with('messages', 'Country created successfully');
        }else{
            return redirect()->back()->with('messages', 'Has error')->withInput();
        }
    }

    public function getUpdate($id) {
        $data = $this->country->getById($id);
        return view('admin.modules.country.update', ['data' => $data])->with('title', 'Update country');
    }

    public function postUpdate($id, CountryRequest $request)
    {
        $result = $this->country->update($id, $request->all());

        if($result) {
            return redirect()->route('admin.country.getIndex')->with('messages', 'Country updated successfully');
        }else{
            return redirect()->back()->with('messages', 'Has error')->withInput();
        }
    }

    public function postDelete(Request $request)
    {
        $result = $this->country->delete($request->id);
        if($result == true) {
            return response()->json(['code' => 200]);
        }else{
            return response()->json(['code' => 500]);
        }
    }
}
