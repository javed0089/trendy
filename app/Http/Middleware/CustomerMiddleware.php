<?php

namespace App\Http\Middleware;

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Closure;
use Illuminate\Support\Facades\Session;

class CustomerMiddleware
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
            if(Sentinel::getUser()->inRole('subscriber')){
                //dd(Sentinel::getUser());
                return $next($request);
            }
            else{
                Session::put('oldUrl', $request->url());
                return redirect()->route('frontend.login')->with(['error' => 'Restriced for customers only']);;    
            }
        }
        else{
            Session::put('oldUrl', $request->url());
            return redirect()->route('frontend.login');
        }
    }
}
