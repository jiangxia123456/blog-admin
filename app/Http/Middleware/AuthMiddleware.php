<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        //验证
        if(empty($_SESSION["username"])){
            dd("无权限");
        }

        $username = $_SESSION["username"];

        if(empty($_SESSION[$username])){
            dd("无权限");
        }

        return $next($request);
    }
}
