<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

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
      $routeName = $request->route()->getName();
      $user = Auth::user();
      if (Auth::user()) {
        $user = Auth::user();
        if($user->type == "customer") {
          return $next($request);
        }
      } elseif ($user == null && $routeName == "customer.proceed.to.payment") {
        return $next($request);
      }
      return redirect()->route('login');
    }
}
