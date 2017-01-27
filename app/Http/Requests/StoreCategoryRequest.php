<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class StoreCategoryRequest extends FormRequest
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
        $id = $this->route()->parameter('category');
        $updateId = empty($id) ? '' : ',' . $id;

        return [
            'name' => 'required',
            'order' => 'required',
            'slug' => 'required|unique:categories,slug' . $updateId,
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
            'name.required' => 'Назва обов\'язкове поле',
            'order.required' => 'Сортування обов\'язкове поле',
            'slug.required' => 'URL обов\'язкове поле',
            'slug.unique' => 'URL вже є в системi',
        ];
    }
}
