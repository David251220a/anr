<?php

namespace App\Http\Middleware;

use Closure;

class Nivel_4
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
        $id_rol = auth()->user()->id_rol;
        
        if($id_rol == 4){
            
            return redirect()->route('consulta.integrante_mesa');
        
        }        

        return $next($request);
    }
}
