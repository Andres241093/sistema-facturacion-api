<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
//Mail
use Illuminate\Support\Facades\Mail;
use App\Mail\ConfirmationMail;
//To generate activation_token
use Illuminate\Support\Str;
use JWTAuth;

class AuthController extends Controller
{
    public function signUp(UserRequest $request)
    {

        $user = new User([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => bcrypt($request->password),
            'type'     => User::ROLES['employee'],
            'activation_token'  => Str::random(60)
        ]);
        Mail::to($request->email)->send(new ConfirmationMail($user));
        $user->save();

        return response()->json([
            'message' => 'Usuario creado exitosamente'
        ], 201);
    }

    public function login(LoginRequest $request)
    {

        $credentials = request(['email', 'password']);

        if (!$token = JWTAuth::attempt($credentials))
            return response()->json([
                'message' => 'Credenciales incorrectas'
            ], 401);

        return response()->json([
            'token' => $token
        ]);
    }

    public function confirmEmail($token)
    {
        $user = User::where('activation_token', $token)->first();
        if (!$user) {
            return response()->json(['message' => 'El token de activación es inválido'], 404);
        }
        $user->active = true;
        $user->activation_token = '';
        $user->save();
        return $user;
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return response()->json([
            'message' => 'Sesión finalizada'
        ]);
    }

    public function user(Request $request)
    {
        return response()->json($request->user());
    }
}
