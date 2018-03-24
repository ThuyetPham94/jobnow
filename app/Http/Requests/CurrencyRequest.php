<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CurrencyRequest extends Request
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
            'Symbol'=> 'required',
        ];
    }
    public function messages()
    {
        return [
            'Name.required'=>'Name country not be empty',
            'Symbol.required'=>'Symbol not be empty'
        ];

    }
}
