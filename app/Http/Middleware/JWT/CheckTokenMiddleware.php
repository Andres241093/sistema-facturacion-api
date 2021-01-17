<?php

namespace App\Http\Middleware\JWT;

use Closure;
use Illuminate\Http\Request;
use JWTAuth;

class CheckTokenMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
       if(JWTAuth::getToken() === NULL)
       {
        return response()->json([
                'message' => 'El Token es requerido'
            ],401);
       }else{
        return $next($request);
       }
    }
}
