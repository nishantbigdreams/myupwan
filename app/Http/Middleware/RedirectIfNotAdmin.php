<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfNotAdmin
{
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @param  string|null  $guard
	 * @return mixed
	 */
	public function handle($request, Closure $next, $guard = 'admin')
	{
	    switch($guard){
        case 'admin':
            if (Auth::guard($guard)->check()) {
                return redirect()->route('admin.home');
            }
        break;

        default:
            if (Auth::guard($guard)->check()) {
                return redirect('/');
            }
        break;
    }
    return $next($request); //<-- this line :)
	}
}