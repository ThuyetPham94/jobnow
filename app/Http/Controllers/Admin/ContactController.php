<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Contact;
use Validator;
class ContactController extends Controller
{
    
    public function index(Request $request)
    {
        $data = new Contact;
        if($request->Name) {
            $data = $data->where('Name', 'like', '%'.$request->Name.'%');
        } 
        if($request->Email) {
            $data = $data->where('Description', 'like', '%'.$request->Email.'%');
        }
        if($request->PhoneNumber) {
            $data = $data->where('Description', 'like', '%'.$request->PhoneNumber.'%');
        } 
        $data = $data->paginate(10);

        return view('admin.modules.contact.index', ['data' => $data])->with('title', 'Lien hệ');
    }

    public function getView(Request $request) {
        $data = Contact::find($request->id);
        return view('admin.modules.contact.view', ['data' => $data])->with('title', $data->Subject);
    }

    public function postDelete(Request $request)
    {
        $result = Contact::find($request->id)->delete();
        if($result == true) {
            return response()->json(['code' => 200]);
        }else{
            return response()->json(['code' => 500]);
        }
    }
}
