<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
class UserUpdateRequest extends FormRequest
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

            'national_id' => 'unique:users,national_id,'.$request->id,
            'email' => 'required|unique:users,email,'.$request->id,
            'avatar_image' => 'mimes:jpeg,jpg'
        ];
    }
}
