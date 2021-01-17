<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'name' => 'required|string|unique:categories'
        ];
    }
    public function messages()
    {
        return [
            'name.unique' => 'La categoría ya existe',
            'name.required' => 'El nombre es requerido',
            'name.string' => 'El nombre debe ser un campo de tipo texto'
        ];  
    }
}
