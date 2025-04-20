<?php

namespace App\Http\Middleware;

use App\Helper\JWTToken;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthenticationMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $token = $request->cookie('postoken');

        $result = JWTToken::verifyToken($token);
        $email = $result->email;
        $id = $result->id;

        if ($result == "unauthorized") {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        else{
            $request->headers->set('email',$email);
            $request->headers->set('id',$id);
            return $next($request);
        }
    }
}
