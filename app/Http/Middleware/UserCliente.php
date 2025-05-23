<?php

namespace App\Http\Middleware;

use App\Models\Cliente;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserCliente
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (session()->has('cliente')) {
            $cliente = session('cliente');
            if (Cliente::find($cliente['id'])){
                return $next($request);
            }else{
                session()->flush();
                return redirect()->route('web.cliente');
            }
        }else{
            return redirect()->route('web.cliente');
        }
    }
}
