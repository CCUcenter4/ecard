<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class ManagerAuth
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
        $user = Auth::user();
        if($user && $user->role == 'manager') {
            return $next($request);
        }else {
            return redirect()->intended('manager/login');
        }
    }
}
