<?php

namespace App\Http\Middleware;

use Closure;
use Sentinel;

class BackendMiddleware
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

        if (Sentinel::check()){
            if(!Sentinel::getUser()->inRole('subscriber'))
                return $next($request);
            else
                return redirect('backoffice/login')->with(['error' => 'Restriced for admins only']);;    
        }
        else
            return redirect('backoffice/login');

    }
}
