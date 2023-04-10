<?php

namespace Aimeos\Client\Html\Common\Decorator;

use Illuminate\Support\Facades\DB;

class StoreProductFilter 
        extends \Aimeos\Client\Html\Common\Decorator\Base
        implements \Aimeos\Client\Html\Common\Decorator\Iface
{
    public function data( \Aimeos\Base\View\Iface $view, array &$tags = [], string &$expire = null ) : \Aimeos\Base\View\Iface
	{
        // $sub_categories = \Aimeos\MShop::create( app('aimeos.context')->get(), 'catalog' )->getTree(2)->getChildren();
        $sub_categories = DB::table('mshop_catalog')->where('level', 2)->get();
        $attributes = \Aimeos\Controller\Frontend::create( app('aimeos.context')->get(), 'attribute' )
                        ->uses( ['product'] )->type( 'size' )->compare( '!=', 'attribute.type', ['date', 'price', 'text'] )
                        ->sort( 'position' )->slice( 0, 10000 )->search();
		$view->sub_categories = $sub_categories;
		$view->attributes = $attributes;
        
		return parent::data( $view, $tags, $expire );	
    }
}