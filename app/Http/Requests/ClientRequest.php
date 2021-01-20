<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
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
            'name' => 'required|string',
            'dni' => 'required|string|unique:clients',
            'address' => 'required|string',
            'phone' => 'required|string'
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'El nombre es requerido',
            'name.string' => 'El nombre debe ser un campo de tipo texto',
            'dni.required' => 'La cédula es requerida',
            'dni.string' => 'La cédula debe ser un campo de tipo texto',
            'dni.unique' => 'La cédula ya está registrada',
            'address.string' => 'La dirección debe ser un campo de tipo texto',
            'address.required' => 'La dirección es requerida',
            'phone.string' => 'El teléfono debe ser un campo de tipo texto',
            'phone.required' => 'El teléfono es requerido'
        ];  
    }
}
