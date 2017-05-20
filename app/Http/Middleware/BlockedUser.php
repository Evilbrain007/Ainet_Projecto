<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class BlockedUser
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
        if (Auth::check() && Auth::user()->blocked == true) {
            Auth::logout();
            $message = ['message_error' => 'A sua conta foi bloqueada. Não é permitido o acesso. Por favor, contacte o administrador.'];
            return redirect()->route('home')->with($message);
        }

        return $next($request);
    }
}
