<?php

namespace App\Http\Controllers\Front;

use Aimeos\Shop\Facades\Shop;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class StoreController extends Controller
{
    public function index(Request $request)
    {
        $manager = \Aimeos\MShop::create( app( 'aimeos.context' )->get(), 'locale/site');
        $filter= $manager->filter( true );
        if($request->key == null){
            $search = $filter->setSortations( [$filter->sort( '-', 'locale.site.id' )] );
            $stores = $manager->search( $search  )->filter(function( $item ) {
                return $item->getStatus() == 1 ;
            });
        }else{
            $filter->add( 'locale.site.label', '~=', $request->key )->setSortations( [$filter->sort( '-', 'locale.site.id' )] );
            $stores = $manager->search( $filter )->filter(function( $item ) {
                return $item->getStatus() == 1 ;
            });
        }






 





        return view('front.store.index', compact('stores'));
    }

    public function show($id)
    {
        $user = User::where('siteid', $id . '.')->first();
        $manager = \Aimeos\MShop::create( app( 'aimeos.context' )->get(), 'locale/site' );
        $store = $manager->search( $manager->filter() );
        return view('front.store.show', compact('user', 'store'));
    }
}
