<?php

namespace App\Http\Controllers\Front\Marketplace;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends BaseController
{
    public function index()
    {   
        // $categories = \Aimeos\Controller\Frontend::create(app( 'aimeos.context' )->get(), 'catalog' )->uses(  ['text', 'media'] )
        // ->getTree()->getChildren();
        // $product = \Aimeos\MShop::create( app( 'aimeos.context' )->get(), 'catalog' )->getManager();
        // dd($categories);

        $active_cats = DB::table('mshop_catalog')->where('status', 1)->where('parentid', '!=', 0)->get('id'); 
        foreach($active_cats as $item){
            $sub_categoriess[] = \Aimeos\MShop::create( $this->context(), 'catalog' )->get($item->id, ['text', 'media']);
        }
//  dd($sub_categoriess[0]->getListRefItem('text') );
        $cntl1 = \Aimeos\Controller\Frontend::create( app( 'aimeos.context' )->get(), 'product' )
        ->category( 2, 'default', 1)->uses( ['text', 'price', 'media', 'attribute', 'product', 'catalog','product/property'] );
        $best_seller_products = $cntl1->search( );

        $cntl2 = \Aimeos\Controller\Frontend::create( app( 'aimeos.context' )->get(), 'product' )
        ->category( 13, 'default', 1)->uses( ['text', 'price', 'media', 'attribute', 'product', 'catalog','product/property']  );
        $best_offer_products = $cntl2->search( );

        $cntl3 = \Aimeos\Controller\Frontend::create( app( 'aimeos.context' )->get(), 'product' )
        ->category( 14, 'default', 1)->uses( ['text', 'price', 'media', 'attribute', 'product', 'catalog','product/property']  );
        $featured_products = $cntl3->search( );

        $sliders = Slider::where('status', 1)->get();
        // dd($best_seller_products->slice(1,10),$best_offer_products->slice(1,10),$featured_products->slice(1,10));
        return view('front.marketplace.home', compact( 'best_seller_products', 'best_offer_products', 'featured_products', 'sub_categoriess', 'sliders') );
    }
}
