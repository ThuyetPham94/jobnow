<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UserRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // 'FullName'        => 'required',
            // 'Gender'          => 'required',
            // 'Email'           => 'required|email',
            // 'PhoneNumber'     => 'required',
            // 'Country'         => 'required',
            // 'Description'     => 'required',
            // 'CurriculumVitae' => 'required'
        ];
    }
    
    // public function messages()
    // {
    //     // return [
    //     //     'Name.required'=>'Name country not be empty',
    //     //     'PostalCode.required'=>'Symbol not be empty',
    //     //     'Description.required'=>'Description not be empty'
    //     // ];

    // }
}
