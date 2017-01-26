<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class StoreUserRequest extends FormRequest
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
        $id = $this->route()->parameter('user');
        $updateId = empty($id) ? '' : ',' . $id;
        $passwordValidator = empty($id) ? 'required' : '';

        return [
            'name' => 'required',
            'password' => $passwordValidator,
            'email' => 'required|email|unique:users,email' . $updateId,
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'email.required' => 'Email обов\'язкове поле',
            'email.unique' => 'Email вже є в системi',
            'email.email' => 'Помилковий формат',
        ];
    }
}
