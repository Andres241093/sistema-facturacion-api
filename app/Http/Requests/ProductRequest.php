<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'description'     => 'required|string|unique:products',
            'price'    => 'required|integer',
            'id_category' => 'required|integer'
        ];
    }
    public function messages()
    {
        return [
            'description.required'     => 'La descripción es requerida',
            'description.string'     => 'La descripción debe ser un campo de tipo texto',
            'description.unique'     => 'Ya existe un producto con la misma descripción',
            'price.required'    => 'El precio es requerido',
            'price.integer'    => 'El precio debe ser un campo de tipo entero',
            'id_category.required'    => 'La categoria es requerida',
            'id_category.integer'    => 'La categoria debe ser un campo de tipo entero'
        ];  
    }
}
