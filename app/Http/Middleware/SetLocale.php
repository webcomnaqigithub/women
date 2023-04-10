<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

class SetLocale
{
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle(Request $request, Closure $next)
	{ 
		if(( $locale = $request->segment( 1 ) ) !== null && preg_match( '/^[a-zA-Z]{2}(\_[a-zA-Z]{2})?$/', $locale )) {
			app()->setLocale(  $locale); 
		}

		return $next($request);
	}
}
