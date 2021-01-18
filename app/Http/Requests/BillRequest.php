<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BillRequest extends FormRequest
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
            "id_user"=>  "required|integer",
            "total"=>  "required|integer",
            "date"=>  "required|date",
            "products"=>  "required"
        ];
    }
    public function messages()
    {
        return [
            'id_user.integer' => 'El id de usuario debe ser un número entero',
            'id_user.required' => 'El usuario es requerido',
            'total.required' => 'El total es requerido',
            'total.integer' => 'El total debe ser de tipo entero',
            "date.required"=>  "La fecha es requerida",
            "date.date"=>  "Formato de fecha inválido",
            "products.required"=>  "Los productos son requeridos"
        ];  
    }
}
