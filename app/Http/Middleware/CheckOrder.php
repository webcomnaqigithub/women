<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Route;

class CheckOrder 
{
 
    public function handle($request, Closure $next)
    { 
        $order = \Aimeos\MShop::create( app( 'aimeos.context' )->get(), 'order/base' )->get(Route::current()->parameters['id']);
        // dd(auth()->user()->id , $order);
        if(auth()->user()->merchant == 0 && auth()->user()->id != $order['order.base.customerid']){
            abort(404);
        }
        // else{
        //     $user = auth()->user();
        //     $site = \Aimeos\MShop::create( app( 'aimeos.context' )->get(false), 'locale/site' )
        //             ->get(current( array_reverse( explode( '.', trim( $user->siteid, '.' ) ) ) ));
                    
        //     if(auth()->user()->merchant == 1 && $site->code != $order['order.base.sitecode']){
        //         abort(404);
        //     }
        // }
        return $next($request);
    }
}
