<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Aimeos (aimeos.org), 2015-2022
 * @package Client
 * @subpackage Html
 */


namespace Aimeos\Client\Html\Account\Editaddress;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ViewErrorBag;

/**
 * Default implementation of account storenav section HTML clients.
 *
 * @package Client
 * @subpackage Html
 */
class Standard
extends \Aimeos\Client\Html\Common\Client\Factory\Base
implements \Aimeos\Client\Html\Iface
{
	private $tags = [];
	private $expire;
	private $view;

	public function body( string $uid = '' ) : string
	{
		$prefixes = ['f_catid'];
		$config = $this->context()->config();
		$confkey = 'client/html/account/editaddress';
		if( $html = $this->cached( 'body', $uid, $prefixes, $confkey ) ) {
			return $this->modify( $html, $uid );
		}
		$template = $config->get( 'client/html/account/editaddress/template-body', 'account/editaddress/body' );
		$view = $this->view = $this->view ?? $this->object()->data( $this->view(), $this->tags, $this->expire );
		$html = $view->render( $template );

		return $this->cache( 'body', $uid, $prefixes, $confkey, $html, $this->tags, $this->expire );
	}

	public function header( string $uid = '' ) : ?string
	{
		$prefixes = ['f_catid'];
		$config = $this->context()->config();
		$confkey = 'client/html/account/editaddress';

		if( $html = $this->cached( 'header', $uid, $prefixes, $confkey ) ) {
			return $this->modify( $html, $uid );
		}

		$template = $config->get( 'client/html/account/editaddress/template-header', 'account/editaddress/header' );
		$view = $this->view = $this->view ?? $this->object()->data( $this->view(), $this->tags, $this->expire );
		$html = $view->render( $template );

		return $this->cache( 'header', $uid, $prefixes, $confkey, $html, $this->tags, $this->expire );
	}

	public function data( \Aimeos\Base\View\Iface $view, array &$tags = [], string &$expire = null ) : \Aimeos\Base\View\Iface
	{
        $context = $this->context();
		$view->addressCountries = $view->config( 'client/html/checkout/standard/address/countries', [] );


		$customer = \Aimeos\MShop::create( $this->context(), 'customer/address' )->get($view->param('id'));
		$view->customer = $customer;

		$view->errors = session()->get('errors', app(ViewErrorBag::class));
		return parent::data( $view, $tags, $expire );
	}
}
