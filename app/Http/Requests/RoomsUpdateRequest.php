<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


use Illuminate\Http\Request;

class RoomsUpdateRequest extends FormRequest
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
    public function rules(Request $request)
    {
        
        return [
            'number'=> 'min:4|unique:rooms,number,'.$request->id  ,
            'price'=>'required|numeric'
        ];
    }
}
