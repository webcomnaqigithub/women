<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Metaways Infosystems GmbH, 2012
 * @copyright Aimeos (aimeos.org), 2015-2022
 * @package Client
 * @subpackage Html
 */


namespace Aimeos\Client\Html\Account\Addaddress;


/**
 * Factory for stage part in account for HTML clients.
 *
 * @package Client
 * @subpackage Html
 */
class Factory
	extends \Aimeos\Client\Html\Common\Factory\Base
	implements \Aimeos\Client\Html\Common\Factory\Iface
{
	public static function create( \Aimeos\MShop\ContextIface $context, string $name = null ) : \Aimeos\Client\Html\Iface
	{
		if( $name === null ) {
			$name = $context->config()->get( 'client/html/account/addaddress/name', 'Standard' );
		}

		$iface = '\\Aimeos\\Client\\Html\\Iface';
		$classname = '\\Aimeos\\Client\\Html\\Account\\Addaddress\\' . $name;

		if( ctype_alnum( $name ) === false ) {
			throw new \Aimeos\Client\Html\Exception( sprintf( 'Invalid characters in class name "%1$s"', $classname ) );
		}

		$client = self::createClient( $context, $classname, $iface );
		$client = self::addClientDecorators( $context, $client, 'addaddress' );

		return $client->setObject( $client );
	}
}
