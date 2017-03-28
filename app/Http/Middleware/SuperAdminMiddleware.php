<?php

namespace App\Http\Middleware;

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Closure;

class SuperAdminMiddleware
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
            if(Sentinel::getUser()->inRole('super-admin'))
                return $next($request);
            else
                return redirect('backoffice/login')->with(['error' => 'Restriced for Super Admins only']);
        }
        else
            return redirect('backoffice/login');
    }
}
