<?php

namespace Aimeos\Client\Html\Common\Decorator;

use App\Models\User;

class BasketWomenStore 
        extends \Aimeos\Client\Html\Common\Decorator\Base
        implements \Aimeos\Client\Html\Common\Decorator\Iface
{
    public function data( \Aimeos\Base\View\Iface $view, array &$tags = [], string &$expire = null ) : \Aimeos\Base\View\Iface
	{
        $context = $this->context();
// dd($view->param( 'b_prod'));
		// $product = \Aimeos\Controller\Frontend::create( $context, 'product' )->resolve( $view->param( 'b_prod' ) );

        // $user = User::where('siteid', $product->getSiteId())->first();
		// $site = \Aimeos\MShop::create($context, 'locale/site' )->get(current( array_reverse( explode( '.', trim( $user->siteid, '.' ) ) ) ));
		// $view->context = $context;
		// $view->user = $user;
		// $view->site = $site;

        return parent::data( $view, $tags, $expire );	
    }
}