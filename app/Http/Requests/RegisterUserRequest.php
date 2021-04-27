<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\CheckExistingUser;

class RegisterUserRequest extends FormRequest
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
            'name' => 'required',
            'email'      => ['required','email',new CheckExistingUser],
            'address'    => 'required',
            'password'   => 'required|same:confirm_password',
            'mobile_number' => 'required|numeric',
            'confirm_password'   => '',
        ];
    }
}
