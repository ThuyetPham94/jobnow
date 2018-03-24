<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class NotificationRequest extends Request
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
            'Title'=> 'required',
            'Content'=> 'required',
            //'MembershipID' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'Title.required'=>'Title not be empty',
            'Content.required'=>'Content not be empty'
            //'Membership.required'=>'Membership not be empty'
        ];

    }
}
