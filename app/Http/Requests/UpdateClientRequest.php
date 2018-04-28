<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClientRequest extends FormRequest
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
        $client = $this->route('client');
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users'.( $client ? (',email,' . $client->id) :  ''),
            'mobile' => 'required|string|size:11',
            'gender' =>'required|in:female,male',
            'national_id' =>'required|integer',
            'avatar_image.*' => 'mimes:jpg,jpeg',
        ];
    }
}
