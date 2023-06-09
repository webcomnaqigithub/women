<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Metaways Infosystems GmbH, 2014
 * @copyright Aimeos (aimeos.org), 2015-2022
 */

$enc = $this->encoder();

/** client/html/account/favorite/url/target
 * Destination of the URL where the controller specified in the URL is known
 *
 * The destination can be a page ID like in a content management system or the
 * module of a software development framework. This "target" must contain or know
 * the controller that should be called by the generated URL.
 *
 * @param string Destination of the URL
 * @since 2014.09
 * @see client/html/account/favorite/url/controller
 * @see client/html/account/favorite/url/action
 * @see client/html/account/favorite/url/config
 */

/** client/html/account/favorite/url/controller
 * Name of the controller whose action should be called
 *
 * In Model-View-Controller (MVC) applications, the controller contains the methods
 * that create parts of the output displayed in the generated HTML page. Controller
 * names are usually alpha-numeric.
 *
 * @param string Name of the controller
 * @since 2014.09
 * @see client/html/account/favorite/url/target
 * @see client/html/account/favorite/url/action
 * @see client/html/account/favorite/url/config
 */

/** client/html/account/favorite/url/action
 * Name of the action that should create the output
 *
 * In Model-View-Controller (MVC) applications, actions are the methods of a
 * controller that create parts of the output displayed in the generated HTML page.
 * Action names are usually alpha-numeric.
 *
 * @param string Name of the action
 * @since 2014.09
 * @see client/html/account/favorite/url/target
 * @see client/html/account/favorite/url/controller
 * @see client/html/account/favorite/url/config
 */

/** client/html/account/favorite/url/config
 * Associative list of configuration options used for generating the URL
 *
 * You can specify additional options as key/value pairs used when generating
 * the URLs, like
 *
 *  client/html/<clientname>/url/config = array( 'absoluteUri' => true )
 *
 * The available key/value pairs depend on the application that embeds the e-commerce
 * framework. This is because the infrastructure of the application is used for
 * generating the URLs. The full list of available config options is referenced
 * in the "see also" section of this page.
 *
 * @param string Associative list of configuration options
 * @since 2014.09
 * @see client/html/account/favorite/url/target
 * @see client/html/account/favorite/url/controller
 * @see client/html/account/favorite/url/action
 * @see client/html/url/config
 */


?>
<?php if( !$this->get( 'favoriteItems', map() )->isEmpty() ) : ?>





















<?php endif ?>

