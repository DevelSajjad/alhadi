<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminOrModMiddleware
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
      if (Auth::user()) {
        $user = Auth::user();
        if($user->type == "admin" || $user->type == "moderator") {
          return $next($request);
        }
      }
      return redirect()->route('admin.login');
    }
}
