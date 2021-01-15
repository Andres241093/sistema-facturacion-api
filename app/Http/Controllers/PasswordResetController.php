<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use App\PasswordReset;
use Illuminate\Http\Request;
use App\Http\Requests\PasswordResetRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\PasswordResetMail;
use App\Mail\PasswordResetSuccessMail;
use Illuminate\Support\Str;

class PasswordResetController extends Controller
{
    /**
     * Create token password reset
     *
     * @param  [string] email
     * @return [string] message
     */
    public function create(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
        ]);
        $user = User::where('email', $request->email)->first();
        if (!$user)
            return response()->json([
                'message' => 'Este correo no coincide con nuestro registros'
            ], 404);
        $passwordReset = PasswordReset::updateOrCreate(
            ['email' => $user->email],
            [
                'email' => $user->email,
                'token' => Str::random(60)
            ]
        );
        if ($user && $passwordReset)
        	//MAIL
        	Mail::to($request->email)->send(new PasswordResetMail($passwordReset->token,$user->name));
        return response()->json([
            'message' => 'Te enviamos un correo para cambiar tu contraseña'
        ]);
    }
    /**
     * Find token password reset
     *
     * @param  [string] $token
     * @return [string] message
     * @return [json] passwordReset object
     */
    public function find($token)
    {
        $passwordReset = PasswordReset::where('token', $token)
            ->first();
        if (!$passwordReset)
            return response()->json([
                'message' => 'El enlace es inválido o ya expiró'
            ], 404);
        if (Carbon::parse($passwordReset->updated_at)->addMinutes(720)->isPast()) {
            $passwordReset->delete();
            return response()->json([
                'message' => 'El enlace es inválido o ya expiró'
            ], 404);
        }
        return response()->json($passwordReset);
    }
     /**
     * Reset password
     *
     * @param  [string] email
     * @param  [string] password
     * @param  [string] password_confirmation
     * @param  [string] token
     * @return [string] message
     * @return [json] user object
     */
    public function reset(PasswordResetRequest $request)
    {
        $passwordReset = PasswordReset::where('token', $request->token)->first();
        if (!$passwordReset)
            return response()->json([
                'message' => 'El enlace es inválido o ya expiró'
            ], 404);
        $user = User::where('email', $request->email)->first();
        if (!$user)
            return response()->json([
                'message' => 'El correo no coincide con nuestro registros'
            ], 404);
        $user->password = bcrypt($request->password);
        $user->save();
        $passwordReset->delete();
        //MAIL
        Mail::to($request->email)->send(new PasswordResetSuccessMail($passwordReset));
        return response()->json($user);
    }
}