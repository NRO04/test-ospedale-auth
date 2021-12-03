<?php

namespace App\Http\Middleware\JWT;

use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth as JWTAuth;

class JwtMiddleware
{

    const EXCEPTIONS = [
        "TokenInvalidException", "Token is Invalid",
        "TokenExpiredException", "Token is Expired",
    ];

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        try {
            JWTAuth::parseToken()->authenticate();
        } catch (\Exception $e) {
            return response()->json(
                [
                    "status" => self::EXCEPTIONS[$this->getClassName($e)] ?? "Authentication Error, Token is not found."
                ]);
        }

        return $next($request);
    }

    public function getClassName($event)
    {
        //Transform to array where it found
        $class = explode('\\', get_class($event));
        //returns class name
        return array_pop($class);
    }
}
