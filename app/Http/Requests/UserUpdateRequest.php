<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\User;
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
            'national_id' => Rule::unique('users')->ignore($request->national_id, 'national_id'),
            'email' => ['required',Rule::unique('users')->ignore($request->email, 'email')],
            'avatar_image' => 'mimes:jpeg,jpg'
        ];
    }
}
