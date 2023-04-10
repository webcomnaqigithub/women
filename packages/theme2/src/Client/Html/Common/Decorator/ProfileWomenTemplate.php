<?php

namespace Aimeos\Client\Html\Common\Decorator;

use App\Models\UserAddress;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ViewErrorBag;

class ProfileWomenTemplate 
        extends \Aimeos\Client\Html\Common\Decorator\Base
        implements \Aimeos\Client\Html\Common\Decorator\Iface
{
    public function data( \Aimeos\Base\View\Iface $view, array &$tags = [], string &$expire = null ) : \Aimeos\Base\View\Iface
	{
        $context = $this->context();
		$manager = \Aimeos\MShop::create( $context, 'index' );
		$searchz = $manager->filter(true );
		$searchz->setSortations( [$searchz->sort( '-', 'product.id' )] );
		$products = $manager->search( $searchz, ['text', 'price', 'media', 'attribute', 'product', 'catalog','product/property']  );
		$view->products = $products;
		$view->products_total = $products->count();

		$view->categories = DB::table('mshop_catalog')->where('status', 1)->where('level', 1)->get();

		// $view->categories = \Aimeos\MShop::create( $context, 'catalog' )->getTree()->getChildren()->filter(function( $item ) {
		// 	return $item->getStatus() == 1 ;
		// 	});

		// ----- Orders-------------------------
		$domains = ['product', 'locale/site', 'order/base', 'order/base/address', 'order/base/coupon', 'order/base/product', 'order/base/service'];
		if(auth()->user()->merchant == 0){
			$view->historyItems = \Aimeos\Controller\Frontend::create( $this->context(), 'order' )
			->uses($domains)
			->sort( '-order.id' )
			->search();
		}else{
			$aa = DB::table('mshop_order_base_product')->where('siteid', $this->context()->locale()->getSiteId())->pluck('baseid') ;
			$managerx = \Aimeos\MShop::create( $this->context(), 'order' );
			$searchx = $managerx->filter(true, false );
			$searchx->setConditions( $searchx->compare( '==', 'order.base.id', $aa ) );
			$searchx->setSortations( [$searchx->sort( '-', 'order.id' )] );
			$view->historyItems = $managerx->search( $searchx, $domains);
		} 
		$view->errors = session()->get('errors', app(ViewErrorBag::class));
		// ----- Orders-------------------------

		// ---- User addresses ----------------
		$user_addresses = UserAddress::where('parentid', auth()->user()->id)->get();
		$view->user_addresses = $user_addresses;
		// ---- User addresses ----------------

		// ------ get financial movements --------
		$paided_amount = DB::table('mshop_order_base')->where('customerid', auth()->user()->id)->sum('price');
		$view->paided_amount = $paided_amount;
		// ------ get financial movements --------
		
		return parent::data( $view, $tags, $expire );	
    }
}