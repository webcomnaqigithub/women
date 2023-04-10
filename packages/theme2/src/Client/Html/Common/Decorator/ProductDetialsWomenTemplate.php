<?php

namespace Aimeos\Client\Html\Common\Decorator;

use App\Models\Review;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\DocBlock\Tags\Uses;

class ProductDetialsWomenTemplate 
        extends \Aimeos\Client\Html\Common\Decorator\Base
        implements \Aimeos\Client\Html\Common\Decorator\Iface
{
    public function data( \Aimeos\Base\View\Iface $view, array &$tags = [], string &$expire = null ) : \Aimeos\Base\View\Iface
	{
 
        $context = $this->context();
		// $manager = \Aimeos\MShop::create( $context, 'order' );
		// $view->order_number = $manager->search( $manager->filter() )->count();

		$product = \Aimeos\Controller\Frontend::create( $context, 'product' )->resolve( $view->param( 'd_name' ) );

		// ----------------Order Count----------------
		$view->order_number = DB::table('mshop_order_base_product')->where('prodid', $product->getId())->count();
		// ----------------Order Count----------------

		$user = User::where('siteid', $product->getSiteId())->first();
		$site = \Aimeos\MShop::create($context, 'locale/site' )->get(current( array_reverse( explode( '.', trim( $user->siteid, '.' ) ) ) ));
		$view->context = $context;
		$view->user = $user;
		$view->site = $site;

		// --------------------get current store products-----------
		$store_products = \Aimeos\Controller\Frontend::create( $context, 'product' )->compare('==', 'product.siteid', $product->getSiteId())->uses(['catalog','media', 'price'])->search();
		$view->store_products = $store_products;
		// --------------------get current store products-----------

		// --------------------get related products-----------------
		$cat= DB::table('mshop_product_list')->where('parentid', $product->getId())->where('domain', 'catalog')->first();
		$related_products = \Aimeos\Controller\Frontend::create( $context, 'product' )->uses( ['catalog', 'media', 'price'] )->category($cat->refid)->search();
		$view->related_products = $related_products;
		// --------------------get related products-----------------
 
		// ---------------------get the reviews----------------------
		if($view->param('sort') == 'ctime' || $view->param('sort') == 'rating'){
			$reviews= DB::table('mshop_review')->where('refid', $product->getId())->orderBy($view->param('sort'), 'desc')->get();
		}else{
			$reviews= DB::table('mshop_review')->where('refid', $product->getId())->orderBy('ctime', 'desc')->get();
		}
		$view->reviews = $reviews;

		$ratings = Review::where('refid', $product->getId())->select('rating', DB::raw('count(id) as count'))->groupBy('rating')->get();
		$view->ratings = $ratings; 
		// ---------------------get the reviews----------------------
		
		return parent::data( $view, $tags, $expire );	
    }
}