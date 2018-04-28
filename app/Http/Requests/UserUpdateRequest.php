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
        $id = $this->route('user');
        $user = User::find($id);
        return [

            'national_id' => ['nullable',Rule::unique('users')->ignore($user->national_id, 'national_id')],
            'email' => ['required',Rule::unique('users')->ignore($user->email, 'email')],
            'avatar_image' => 'mimes:jpeg,jpg'
        ];
    }
}
