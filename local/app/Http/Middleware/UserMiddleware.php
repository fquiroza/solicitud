<?php

namespace App\Http\Middleware;
use Illuminate\Http\Request;
use Closure;

class UserMiddleware
{
    //Funcion busca si se esta logeado para asi dar permisos para ingresar
    public function handle($request, Closure $next)
    {
        if ($request->session()->has('name')) {

            return $next($request);

        }else{

            return redirect()->route('login');
        }

        
    }
}
