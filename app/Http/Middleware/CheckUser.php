<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Route;

class CheckUser 
{
    public function handle($request, Closure $next)
    {

        if( auth()->user()->id == request()->get('usid') || auth()->user()->id == Route::current()->parameters['usid'])
        {
            return $next($request);
        }else{
            abort(404);
        }
    }
}
