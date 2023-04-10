<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Route;

class CheckContext 
{
    public function handle($request, Closure $next)
    {
        $user = auth()->user();
        $site = \Aimeos\MShop::create( app( 'aimeos.context' )->get(false), 'locale/site' )
                ->get(current( array_reverse( explode( '.', trim( $user->siteid, '.' ) ) ) ));
        if( $site->code != Route::current()->parameters['site'])
        {
            abort(404);
        }
        return $next($request);
    }
}
