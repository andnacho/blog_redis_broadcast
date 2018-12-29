<?php

namespace App\Http\Middleware;

use Closure;

class CheckUsersRoles
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
        // $roles = func_get_args(); //Devuelve un array con todos los parametro de la función

        // $roles = array_slice($roles, 2); //quita las dos primeras variables
     
        $roles = array_slice(func_get_args(), 2);
                    
        if(auth()->user()->hasRoles($roles))
        {
        return $next($request);
        } 
    

        return redirect('/');
           
    }
}
