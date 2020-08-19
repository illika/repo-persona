<?php

namespace App\Http\Middleware;

use Closure;

class VerificarEdad
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
        if (!$request->fecha_nacimiento) {
            return $next($request);
        }
        $fecha = explode("/",$request->fecha_nacimiento);
        
        $fecha_a = $fecha[2]."-".$fecha[1]."-".$fecha[0]; 
        $tiempo = strtotime($fecha_a);
        $ahora = time(); 
        $edad = ($ahora-$tiempo)/(60*60*24*365.25); 
        $edad = floor($edad); 

        if ($edad >= 18) {
            return $next($request);
        } else {
            return redirect()->back()->with("msg","Debes ser mayor de edad");
        }
        
    }
}
