<?php

namespace App\Http\Controllers\Front\Marketplace;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        // $manager = \Aimeos\MShop::create( app( 'aimeos.context' )->get(), 'order' );
		// $search = $manager->filter( false, true )->order( ['-order.ctime', '-order.id'] )->slice( 0, 10 );
		// $orders = $manager->search( $search, ['order/base', 'order/base/address', 'order/base/product'] );

        // $orders = \Aimeos\Controller\Frontend::create( app( 'aimeos.context' )->get(), 'order' )
        //             ->uses( ['product', 'locale/site', 'order/base', 'order/base/address', 'order/base/coupon', 'order/base/product', 'order/base/service'] )
        //             ->sort( '-order.id' )
        //             ->search()->filter(function( $item ) {
        //                 return $item->getStatusDelivery() == 5 ;
        //             });;
        $Notifications = [];
        if(auth()->check()){
            if(auth()->user()->merchant == 0){
                $Notifications = Notification::where('receiver_id', auth()->user()->id)->orderBy('id', 'desc')->get();
            }else{
                $Notifications = Notification::where('sender_id', auth()->user()->siteid)->orderBy('id', 'desc')->get();
            }
        }
        
        return view('front.marketplace.notification', compact('Notifications'));
    }
}