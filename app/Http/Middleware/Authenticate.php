<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if(isset($guards)){
            foreach ($guards as $guard) {
                if (Auth::guard($guard)->check()) {
    
                    if($guard === 'pacientes'){
                        return redirect()->route('pacientes.index');
                    }
                    return redirect()->route('home');
                    // return redirect(RouteServiceProvider::HOME);
                }
            }
        }
        
        if (! $request->expectsJson()) {
                if($request->routeIs('pacientes.*')){
                    return route('pacientes.login');
                }
                return route('login');
            }

// ORIGINAL
        // if (! $request->expectsJson()) {
        //     return route('login');

        
        // }

    }
}
