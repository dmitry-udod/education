<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class StoreAdminRole extends FormRequest
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
        $id = $this->route()->parameter('role');
        $updateId = empty($id) ? '' : ",$id";

        return [
            'display_name' => 'required|unique:roles,display_name' . $updateId,
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
            'display_name.required' => 'Назва обов\'язкове поле',
            'display_name.unique' => 'Роль с такою назвою вже присутня',
        ];
    }
}
