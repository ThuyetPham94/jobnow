<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class SkillRequest extends Request
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
            'Name'=> 'required',
            'IndustryID'=>'required|integer'
        ];
    }

    public function messages()
    {
        return [
            'Name.required'=>'Name skill not be empty',
            'IndustryID.required'=>'Industry not be empty',
            'IndustryID.integer'=>'Industry must be integer',
        ];

    }
}
