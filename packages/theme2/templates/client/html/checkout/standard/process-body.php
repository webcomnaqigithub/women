<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Aimeos (aimeos.org), 2015-2022
 */


$enc = $this->encoder();
$prefix = !$this->get('standardUrlExternal', true);

$defaultRegex = array('payment.cardno' => '^[0-9]{16,19}$', 'payment.cvv' => '^[0-9]{3}$');
$regex = $this->config('client/html/checkout/standard/process/validate', $defaultRegex);


?>
<?php $this->block()->start('checkout/standard/process') ?>
	<div class="Pay-check text-center mb-5" >
		<lottie-player class="Pay-check-lottie-player" src="<?= $enc->attr( $this->content( 'front/js/progress2.json' ) ) ?>" background="transparent" speed="1" loop="" autoplay="" style="margin: 4% 0px 0% 0px;"></lottie-player>
		<h5>جاري الدفع </h5>
	</div>
	<form action="/ar/shop/default/confirm/demo-cashondelivery" method="POST" id="confirm-pay">
		<?= $this->csrf()->formfield() ?>
		<input type="hidden" name="cp_payment" value="1">
	</form>
<?php $this->block()->stop() ?>
<?= $this->block()->get('checkout/standard/process') ?>