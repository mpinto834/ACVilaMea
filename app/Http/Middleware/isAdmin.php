<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Verifica primeiro se existe um usuário autenticado
        if (!auth()->check()) {
            return redirect('login');
        }
        
        // Verifica se o usuário tem role = 2 (admin)
        if (auth()->user()->role === 2) {
            return $next($request);
        }
        
        return redirect('/')->with('error', 'Você não tem acesso de administrador.');
    }
}
