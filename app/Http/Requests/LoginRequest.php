<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember_me' => 'boolean'
        ];
    }
    public function messages()
    {
        return [
            'email.required' => 'El correo es requerido',
            'email.string' => 'El correo debe ser un campo de tipo texto',
            'email.email' => 'Correo inválido',
            'password.required' => 'La contraseña es requerida',
            'password.string' => 'La contraseña debe ser un campo de tipo texto',
            'remember_me.boolean' => 'El campo recuerdame debe ser de tipo booleano'
        ];  
    }
}
