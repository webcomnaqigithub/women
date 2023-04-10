<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Aimeos (aimeos.org), 2016-2022
 */

$enc = $this->encoder();

$target = $this->request()->getTarget();
$searchTarget = $this->config( 'admin/jqadm/url/search/target' );
$cntl = $this->config( 'admin/jqadm/url/search/controller', 'Jqadm' );
$action = $this->config( 'admin/jqadm/url/search/action', 'search' );
$config = $this->config( 'admin/jqadm/url/search/config', [] ) + ['absoluteUri' => true];


/** admin/jsonadm/url/options/target
 * Destination of the URL where the controller specified in the URL is known
 *
 * The destination can be a page ID like in a content management system or the
 * module of a software development framework. This "target" must contain or know
 * the controller that should be called by the generated URL.
 *
 * @param string Destination of the URL
 * @since 2016.04
 * @category Developer
 * @see admin/jsonadm/url/options/controller
 * @see admin/jsonadm/url/options/action
 * @see admin/jsonadm/url/options/config
 */
$jsonTarget = $this->config( 'admin/jsonadm/url/options/target' );

/** admin/jsonadm/url/options/controller
 * Name of the controller whose action should be called
 *
 * In Model-View-Controller (MVC) applications, the controller contains the methods
 * that create parts of the output displayed in the generated HTML page. Controller
 * names are usually alpha-numeric.
 *
 * @param string Name of the controller
 * @since 2016.04
 * @category Developer
 * @see admin/jsonadm/url/options/target
 * @see admin/jsonadm/url/options/action
 * @see admin/jsonadm/url/options/config
 */
$jsonCntl = $this->config( 'admin/jsonadm/url/options/controller', 'Jsonadm' );

/** admin/jsonadm/url/options/action
 * Name of the action that should create the output
 *
 * In Model-View-Controller (MVC) applications, actions are the methods of a
 * controller that create parts of the output displayed in the generated HTML page.
 * Action names are usually alpha-numeric.
 *
 * @param string Name of the action
 * @since 2016.04
 * @category Developer
 * @see admin/jsonadm/url/options/target
 * @see admin/jsonadm/url/options/controller
 * @see admin/jsonadm/url/options/config
 */
$jsonAction = $this->config( 'admin/jsonadm/url/options/action', 'options' );

/** admin/jsonadm/url/options/config
 * Associative list of configuration options used for generating the URL
 *
 * You can specify additional options as key/value pairs used when generating
 * the URLs, like
 *
 *  admin/jsonadm/url/options/config = array( 'absoluteUri' => true )
 *
 * The available key/value pairs depend on the application that embeds the e-commerce
 * framework. This is because the infrastructure of the application is used for
 * generating the URLs. The full list of available config options is referenced
 * in the "see also" section of this page.
 *
 * @param string Associative list of configuration options
 * @since 2016.04
 * @category Developer
 * @see admin/jsonadm/url/options/target
 * @see admin/jsonadm/url/options/controller
 * @see admin/jsonadm/url/options/action
 */
$jsonConfig = $this->config( 'admin/jsonadm/url/options/config', [] );


/** admin/jqadm/navbar
 * List of JQAdm client names shown in the navigation bar of the admin interface
 *
 * You can add, remove or reorder the links in the navigation bar by
 * setting a new list of client resource names.
 * In the configuration files of extensions, you should only add entries using
 * one of these lines:
 *
 *  'myclient' => 'myclient',
 *  'myclient-subclient' => 'myclient/subclient',
 *
 * The key of the new client must be unique in the extension configuration so
 * it's not overwritten by other extensions. Don't use slashes in keys (/)
 * because they are interpreted as keys of sub-arrays in the configuration.
 *
 * @param array List of resource client names
 * @since 2017.10
 * @category Developer
 * @see admin/jqadm/navbar-limit
 */
$navlist = map( $this->config( 'admin/jqadm/navbar', [] ) )->ksort();

foreach( $navlist as $key => $navitem )
{
	$name = is_array( $navitem ) ? ( $navitem['_'] ?? current( $navitem ) ) : $navitem;

	if( !$this->access( $this->config( 'admin/jqadm/resource/' . $name . '/groups', [] ) ) ) {
		$navlist->remove( $key );
	}
}


$resource = $this->param( 'resource', 'dashboard' );
$site = $this->param( 'site', 'default' );
$lang = $this->param( 'locale' );

$params = ['resource' => $resource, 'site' => $site];
$extParams = ['site' => $site];

if( $lang ) {
	$params['locale'] = $extParams['locale'] = $lang;
}


$pos = $navlist->pos( function( $item, $key ) use ( $resource ) {
	return is_array( $item ) ? in_array( $resource, $item ) : !strncmp( $resource, $item, strlen( $item ) );
} );
$before = $pos > 0 ? $navlist->slice( $pos - 1, 1 )->first() : null;
$before = is_array( $before ) ? $before['_'] ?? reset( $before ) : $before;
$after = $pos < count( $navlist ) ? $navlist->slice( $pos + 1, 1 )->first() : null;
$after = is_array( $after ) ? $after['_'] ?? reset( $after ) : $after;


?>
<div class="aimeos" lang="<?= $this->param( 'locale' ) ?>" data-url="<?= $enc->attr( $this->url( $jsonTarget, $jsonCntl, $jsonAction, array( 'site' => $site ), [], $jsonConfig ) ) ?>">

	<nav class="main-sidebar">
		<div class="sidebar-wrapper">

			<a class="logo" target="_blank" href="<?= airoute('aimeos_home') ?>">
                <img src="http://store.mynet.net/front/images/logo/Logo.png" alt="" title="" style="width:150px;margin: 17px 0 0 28px;">
            </a>

			<ul class="sidebar-menu" style="margin-top: 5rem;">
				<li class="menuitem-dashboard <?php if(request()->segment(6) == 'dashboard') : ?> active <?php endif?>">
					<a class="item-group" href="/<?= app()->getLocale() ?>/admin/default/jqadm/search/dashboard?locale=en" title="dashboard (Ctrl+Alt+L)" data-ctrlkey="l">
						<i class="icon"></i>
						<span class="title">Dashboard</span>
					</a>
				</li>
				<li class="menuitem-catalog <?php if(request()->segment(6) == 'product') : ?> active <?php endif?>">
					<a class="item-group" href="/<?= app()->getLocale() ?>/admin/default/jqadm/search/product?locale=en" title="product (Ctrl+Alt+L)" data-ctrlkey="l">
						<i class="icon"></i>
						<span class="title">Products</span>
					</a>
				</li>
				<li class="menuitem-attribute <?php if(request()->segment(6) == 'attribute') : ?> active <?php endif?>">
					<a class="item-group" href="/<?= app()->getLocale() ?>/admin/default/jqadm/search/attribute?locale=en" title="attribute (Ctrl+Alt+L)" data-ctrlkey="l">
						<i class="icon"></i>
						<span class="title">Attributes</span>
					</a>
				</li>
				<li class="menuitem-attribute <?php if(request()->segment(6) == 'type' && request()->segment(7) == 'attribute') : ?> active <?php endif?>">
					<a class="item-group" href="/<?= app()->getLocale() ?>/admin/default/jqadm/search/type/attribute?locale=en" title="attribute type (Ctrl+Alt+L)" data-ctrlkey="l">
						<i class="icon"></i>
						<span class="title">Attribute Types</span>
					</a>
				</li>
				<li class="menuitem-catalog <?php if(request()->segment(6) == 'catalog') : ?> active <?php endif?>">
					<a class="item-group" href="/<?= app()->getLocale() ?>/admin/default/jqadm/search/catalog?locale=en" title="catalog (Ctrl+Alt+L)" data-ctrlkey="l">
						<i class="icon"></i>
						<span class="title">Categories</span>
					</a>
				</li>
				<li class="menuitem-order <?php if(request()->segment(6) == 'order') : ?> active <?php endif?>">
					<a class="item-group" href="/<?= app()->getLocale() ?>/admin/default/jqadm/search/order?locale=en" title="order (Ctrl+Alt+L)" data-ctrlkey="l">
						<i class="icon"></i>
						<span class="title">Orders</span>
					</a>
				</li>
				<li class="menuitem-catalog <?php if(request()->segment(6) == 'cms') : ?> active <?php endif?>">
					<a class="item-group" href="/<?= app()->getLocale() ?>/admin/default/jqadm/search/cms?locale=en" title="cms (Ctrl+Alt+L)" data-ctrlkey="l">
						<i class="icon"></i>
						<span class="title">Static Pages</span>
					</a>
				</li>
				<li class="menuitem-users <?php if(request()->segment(6) == 'customer') : ?> active <?php endif?>">
					<a class="item-group" href="/<?= app()->getLocale() ?>/admin/default/jqadm/search/customer?locale=en" title="customer (Ctrl+Alt+L)" data-ctrlkey="l">
						<i class="icon"></i>
						<span class="title">Customers</span>
					</a>
				</li>
				<li class="menuitem-locale <?php if(request()->segment(6) == 'locale') : ?> active <?php endif?>">
					<a class="item-group" href="/<?= app()->getLocale() ?>/admin/default/jqadm/search/locale?locale=en" title="locale (Ctrl+Alt+L)" data-ctrlkey="l">
						<i class="icon"></i>
						<span class="title">Locale</span>
					</a>
				</li>
				<li class="menuitem-log <?php if(request()->segment(6) == 'maintenance') : ?> active <?php endif?>">
					<a class="item-group" href="/<?= app()->getLocale() ?>/admin/default/jqadm/search/maintenance?locale=en" title="maintenance (Ctrl+Alt+L)" data-ctrlkey="l">
						<i class="icon"></i>
						<span class="title">Maintenance</span>
					</a>
				</li>
				<li class="menuitem-log <?php if(request()->segment(6) == 'testdrive') : ?> active <?php endif?>">
					<a class="item-group" href="/<?= app()->getLocale() ?>/admin/default/jqadm/search/testdrive?locale=en" title="test drive (Ctrl+Alt+L)" data-ctrlkey="l">
						<i class="icon"></i>
						<span class="title">Test Drive</span>
					</a>
				</li>
				<li class="menuitem-log <?php if(request()->segment(6) == 'news') : ?> active <?php endif?>">
					<a class="item-group" href="/<?= app()->getLocale() ?>/admin/default/jqadm/search/news?locale=en" title="news (Ctrl+Alt+L)" data-ctrlkey="l">
						<i class="icon"></i>
						<span class="title">News</span>
					</a>
				</li>
				<li class="menuitem-users <?php if(request()->segment(6) == 'customerreviews') : ?> active <?php endif?>">
					<a class="item-group" href="/<?= app()->getLocale() ?>/admin/default/jqadm/search/customerreviews" title="customer reviews (Ctrl+Alt+L)" data-ctrlkey="l">
						<i class="icon"></i>
						<span class="title">Customer Reviews</span>
					</a>
				</li>
				<li class="menuitem-users <?php if(request()->segment(6) == 'slider') : ?> active <?php endif?>">
					<a class="item-group" href="/<?= app()->getLocale() ?>/admin/default/jqadm/search/slider" title="slider (Ctrl+Alt+L)" data-ctrlkey="l">
						<i class="icon"></i>
						<span class="title">Slider</span>
					</a>
				</li>
				<li class="menuitem-users <?php if(request()->segment(6) == 'blog') : ?> active <?php endif?>">
					<a class="item-group" href="/<?= app()->getLocale() ?>/admin/default/jqadm/search/blog" title="blog (Ctrl+Alt+L)" data-ctrlkey="l">
						<i class="icon"></i>
						<span class="title">Blog</span>
					</a>
				</li>
				<li class="none"></li>
			</ul>

		</div>
	</nav>

	<main class="main-content">
		<?= $this->partial( $this->config( 'admin/jqadm/partial/info', 'info' ), [
			'info' => array_merge( $this->get( 'pageInfo', [] ), $this->get( 'info', [] ) ),
			'error' => $this->get( 'errors', [] )
		] ) ?>

		<?= $this->block()->get( 'jqadm_content' ) ?>
	</main>


	<?= $this->partial( $this->config( 'admin/jqadm/partial/confirm', 'confirm' ) ) ?>
	<?= $this->partial( $this->config( 'admin/jqadm/partial/problem', 'problem' ) ) ?>

</div>
