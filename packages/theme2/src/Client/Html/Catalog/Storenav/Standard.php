<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Aimeos (aimeos.org), 2015-2022
 * @package Client
 * @subpackage Html
 */


namespace Aimeos\Client\Html\Catalog\Storenav;

use App\Models\User;
use Illuminate\Support\Facades\DB;

/**
 * Default implementation of catalog storenav section HTML clients.
 *
 * @package Client
 * @subpackage Html
 */
class Standard
	extends \Aimeos\Client\Html\Common\Client\Factory\Base
	implements \Aimeos\Client\Html\Common\Client\Factory\Iface
{
	private $tags = [];
	private $expire;
	private $view;


	/**
	 * Returns the HTML code for insertion into the body.
	 *
	 * @param string $uid Unique identifier for the output if the content is placed more than once on the same page
	 * @return string HTML code
	 */
	public function body( string $uid = '' ) : string
	{
		$prefixes = ['f_catid'];
		$config = $this->context()->config();
		$confkey = 'client/html/catalog/storenav';
		if( $html = $this->cached( 'body', $uid, $prefixes, $confkey ) ) {
			return $this->modify( $html, $uid );
		}
		$template = $config->get( 'client/html/catalog/storenav/template-body', 'catalog/storenav/body' ); 
		$view = $this->view = $this->view ?? $this->object()->data( $this->view(), $this->tags, $this->expire );
		$html = $view->render( $template );

		return $this->cache( 'body', $uid, $prefixes, $confkey, $html, $this->tags, $this->expire );
	}


	/**
	 * Returns the HTML string for insertion into the header.
	 *
	 * @param string $uid Unique identifier for the output if the content is placed more than once on the same page
	 * @return string|null String including HTML tags for the header on error
	 */
	public function header( string $uid = '' ) : ?string
	{
		$prefixes = ['f_catid'];
		$config = $this->context()->config();
		$confkey = 'client/html/catalog/storenav';

		if( $html = $this->cached( 'header', $uid, $prefixes, $confkey ) ) {
			return $this->modify( $html, $uid );
		}

		$template = $config->get( 'client/html/catalog/storenav/template-header', 'catalog/storenav/header' );

		$view = $this->view = $this->view ?? $this->object()->data( $this->view(), $this->tags, $this->expire );
		$html = $view->render( $template );

		return $this->cache( 'header', $uid, $prefixes, $confkey, $html, $this->tags, $this->expire );
	}


	/**
	 * Sets the necessary parameter values in the view.
	 *
	 * @param \Aimeos\Base\View\Iface $view The view object which generates the HTML output
	 * @param array &$tags Result array for the list of tags that are associated to the output
	 * @param string|null &$expire Result variable for the expiration date of the output (null for no expiry)
	 * @return \Aimeos\Base\View\Iface Modified view object
	 */
	public function data( \Aimeos\Base\View\Iface $view, array &$tags = [], string &$expire = null ) : \Aimeos\Base\View\Iface
	{
		$context = $this->context();
		$siteid = $context->locale()->getSiteItem()->getSiteId();
		$store_data = User::where('siteid', $siteid)->where('merchant', true)->first();

		$view->store_data = $store_data;

		$orders_paided = DB::table('mshop_order_base_product')->where('siteid', $siteid)->count();
		$view->orders_paided = $orders_paided;

		return parent::data( $view, $tags, $expire );
	}
}
