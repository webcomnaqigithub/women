<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Aimeos (aimeos.org), 2015-2022
 * @package Client
 * @subpackage Html
 */


namespace Aimeos\Admin\JQAdm\Blog;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Support\ViewErrorBag;

/**
 * Default implementation of catalog storenav section HTML clients.
 *
 * @package Client
 * @subpackage Html
 */
class Standard
		extends \Aimeos\Admin\JQAdm\Common\Admin\Factory\Base
		implements \Aimeos\Admin\JQAdm\Common\Admin\Factory\Iface
{
	/**
	 * Adds the required data used in the template
	 *
	 * @param \Aimeos\Base\View\Iface $view View object
	 * @return \Aimeos\Base\View\Iface View object with assigned parameters
	 */
	public function data( \Aimeos\Base\View\Iface $view ) : \Aimeos\Base\View\Iface
	{
		$view->errors = session()->get('errors', app(ViewErrorBag::class));
		return $view;
	}

	/**
	 * Creates a new resource
	 *
	 * @return string|null HTML output
	 */
	public function create() : ?string
	{
		$view = $this->object()->data( $this->view() );

	 

		return $this->render( $view );
	}

	/**
	 * Returns a single resource
	 *
	 * @return string|null HTML output
	 */
	public function get() : ?string
	{ 
		$view = $this->object()->data( $this->view() );

		try
		{
			if( ( $id = $view->param( 'id' ) ) === null )
			{
				$msg = $this->context()->translate( 'admin', 'Required parameter "%1$s" is missing' );
				throw new \Aimeos\Admin\JQAdm\Exception( sprintf( $msg, 'id' ) );
			}
			$blog = Blog::find($view->param( 'id' ));
			$view->blog = $blog;
		}
		catch( \Exception $e )
		{
			$this->report( $e, 'get' );
		}

		return $this->render( $view );
	}


 

	/**
	 * Returns a list of resource according to the conditions
	 *
	 * @return string|null HTML output
	 */
	public function search() : ?string
	{
		$view = $this->view();
		$tplconf = 'admin/jqadm/blog/template-list';
		$default = 'blog/list';
		$view->blogs = Blog::get();
		return $view->render( $view->config( $tplconf, $default ) );
	}

	/**
	 * Returns the rendered template including the view data
	 *
	 * @param \Aimeos\Base\View\Iface $view View object with data assigned
	 * @return string HTML output
	 */
	protected function render( \Aimeos\Base\View\Iface $view ) : string
	{ 
		return $view->render('blog/item');
	}
}
