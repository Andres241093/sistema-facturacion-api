<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string'
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'El nombre es requerido',
            'email.required' => 'El correo es requerido',
            'password.required' => 'La contraseña es requerida',
            'name.string' => 'El nombre debe ser un campo de tipo texto',
            'email.string' => 'El correo debe ser un campo de tipo texto',
            'password.string' => 'La contraseña debe ser un campo de tipo texto',
            'email.email' => 'Correo inválido',
            'email.unique' => 'El correo ya está registrado'
        ];  
    }
}
