<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Metaways Infosystems GmbH, 2013
 * @copyright Aimeos (aimeos.org), 2015-2022
 */

$enc = $this->encoder();


?>
<?php $this->block()->start( 'checkout/standard/payment' ) ?>

<?php $this->block()->stop() ?>
<?= $this->block()->get( 'checkout/standard/payment' ) ?>
