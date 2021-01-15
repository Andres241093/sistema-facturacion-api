<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PasswordResetRequest extends FormRequest
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
          'email' => 'required|string|email',
          'password' => 'required|string|confirmed',
          'token' => 'required|string'
      ];
    }
    public function messages()
    {
        return [
            'email.required' => 'El correo es requerido',
            'email.string' => 'El correo debe ser un campo de tipo texto',
            'email.email' => 'Correo inválido',
            'password.required' => 'La contraseña es requerida',
            'password.confirmed' => 'Las contraseñas no coinciden',
            'password.string' => 'La contraseña debe ser un campo de tipo texto',
            'token.required' => 'El token es requerido',
            'token.string' => 'El token debe ser un campo de tipo texto'
        ];
    }
}
