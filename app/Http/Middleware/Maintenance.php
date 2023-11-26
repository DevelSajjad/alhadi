<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;

class Maintenance
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
      if($request->is('dashboard*') || $request->is('maintenance') || $request->is('xadmin')){
        return $next($request);
      }else{
        return new RedirectResponse(url('/maintenance'));
      }
    }
}
