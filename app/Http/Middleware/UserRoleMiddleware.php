<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use JWTAuth;
use App\Models\User;


class UserRoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    public function handle(Request $request, Closure $next, ...$roles)
    {
        $roles = collect($roles);
        $user_role = User::ROLES[
            JWTAuth::parseToken()->authenticate()->type
        ];

        if($roles->contains($user_role))
        {
            return $next($request);
        }else{
            return response()->json([
                'message' => 'Acceso no autorizado para usuario del tipo '.$user_role
            ],401);
        }

    }
}
