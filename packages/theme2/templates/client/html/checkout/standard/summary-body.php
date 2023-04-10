<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Metaways Infosystems GmbH, 2013
 * @copyright Aimeos (aimeos.org), 2015-2022
 */

$enc = $this->encoder();

$checkoutAddressUrl = $this->link( 'client/html/checkout/standard/url', ['c_step' => 'address'] );
$checkoutDeliveryUrl = $this->link( 'client/html/checkout/standard/url', ['c_step' => 'delivery'] );
$checkoutPaymentUrl = $this->link( 'client/html/checkout/standard/url', ['c_step' => 'payment'] );
$basketUrl = $this->link( 'client/html/basket/standard/url' );


$totalQuantity = 0;
$detailTarget = $this->config( 'client/html/catalog/detail/url/target' );
$detailController = $this->config( 'client/html/catalog/detail/url/controller', 'catalog' );
$detailAction = $this->config( 'client/html/catalog/detail/url/action', 'detail' );
$detailConfig = $this->config( 'client/html/catalog/detail/url/config', array( 'absoluteUri' => 1 ) );
$attrTypes = $this->config( 'client/html/common/summary/detail/product/attribute/types', ['variant', 'config', 'custom'] );
$price = $this->standardBasket->getPrice();
$precision = $price->getPrecision();
$priceTaxflag = $price->getTaxFlag();
$priceCurrency = $this->translate( 'client', $price->getCurrencyId() );
/// Price format with price value (%1$s) and currency (%2$s)
$priceFormat = $this->translate( 'client/code', 'price:default', null, 0, false ) ?: $this->translate( 'client', '%1$s %2$s' );
/// Tax format with tax rate (%1$s) and tax name (%2$s)
$taxFormatIncl = $this->translate( 'client', 'Incl. %1$s%% %2$s' );
/// Tax format with tax rate (%1$s) and tax name (%2$s)
$taxFormatExcl = $this->translate( 'client', '+ %1$s%% %2$s' );
$pos = 1;
$selectfcn = function( $list, $key, $value ) {
	return ( isset( $list[$key] ) && $list[$key] == $value ? 'selected="selected"' : '' );
};
$addr = $this->get( 'addressBilling', [] );


?>
<?php $this->block()->start( 'checkout/standard/summary' ) ?>
<form class="container-xxl page-body" method="<?= $enc->attr($this->get('standardMethod', 'POST')) ?>" action="/<?= app()->getLocale() ?>/shop/default/checkout/process" id="checkout-form">
	<?= $this->csrf()->formfield() ?>
	<input type="hidden" name="<?= $enc->attr($this->formparam(['cs_order'])) ?>" value="1">
	<input type="hidden" name="<?= $enc->attr($this->formparam(['cs_option_terms_value'])) ?>" value="1">
	<input type="hidden" name="<?= $enc->attr($this->formparam(['cs_option_terms'])) ?>" value="1">
	<div class="container px-5">
		<!-- <div class="col-md-12 pl-4 mt-5"> -->
			<div class="row mt-5">
				<div class="col-md-3 col-sm-1"></div>
				<div class="col-md-6 col-sm-10 Pending-users">
					<h5><?= $enc->html( $this->translate( 'admin', 'Summary' ) ) ?></h5>
					<?php $x = 0;$length = count($this->standardBasket->getProducts()) ?>
					<?php foreach( $this->standardBasket->getProducts()->groupBy( 'order.base.product.vendor' )->ksort() as $vendor => $list ) : ?>
						<?php foreach( $list as $position => $product ) : $totalQuantity += $product->getQuantity() ?>
							<div class="row ">
							<div class="col-md-12 details_user_Products Products_col" style="border-bottom:none;">
							<div class="img-Products">
								<img src="/aimeos/<?= $enc->attr( $this->content( $product->getMediaUrl()) ) ?>">
							</div>
							<?php
								$params = array_diff_key( ['d_name' => $product['order.base.product.prodcode'], 'd_prodid' => $product->getId(), 'd_pos' => $position]  );
								$url = $this->url( ( $product->getTarget() ?: $detailTarget ), $detailController, $detailAction, $params, [], $detailConfig );
							?>
							<a href="<?= $enc->attr( $url ) ?>" style="width: 100%;">
								<div class="details_Products">
									<div class="Products_name"><?= $enc->html( $product->getName(), $enc::TRUST ) ?></div>
									<div class="Products_type"> x <?= $product->getQuantity()?> </div>
									<div class="Products_price"><?= $enc->html( sprintf( $priceFormat, $product->getPrice()->getValue() , $priceCurrency ) ) ?></div>
								</div>
							</a>
							</div>
							</div>
							<?php $x++; ?>
							<?php if ($x !== $length) :?>
								<hr>
							<?php endif?>
							
						<?php endforeach?>
					<?php endforeach?>
				</div>
			</div>
			<div class="row mb-5">
				<div class="col-md-3 col-sm-1"></div>
				<div class="col-md-6 col-sm-10 Pending-users mt-3">
					<h5><?= $enc->html( $this->translate( 'admin', 'Payment method' ) ) ?></h5>
					<div class="d-flex">
						<div class="custom-radio-wrap  mt-1 ml-2">
							<input id="3" type="radio" checked>
							<label for="3"><img src="<?= $enc->attr( $this->content( 'front/images/icon/Path.svg' ) ) ?>" style="margin-top: 5px;" class="option-image"></label>
						</div>
						<div class=" payment mb-3">
							<div class="payment-type2 ">
							<img src="<?= $enc->attr( $this->content( 'front/images/icon/Component 45 – 1.png' ) ) ?>" width="25" class="mt-1">
							<span><?= $enc->html( $this->translate( 'admin', 'upon receipt' ) ) ?></span>
							</div>
						</div>
					</div>
					<hr>
					<div class="row invoice">
						<div class="col-12 ">
							<span><?= $enc->html( $this->translate( 'admin', 'Products' ) ) ?></span>
							<span class="f-left"><?= $this->standardBasket->getProducts()->count()?></span>
						</div>
						<div class="col-12 ">
							<span><?= $enc->html( $this->translate( 'admin', 'total items' ) ) ?></span>
							<span class="f-left"><?= $enc->html( sprintf( $priceFormat, $this->standardBasket->getPrice()->getValue() , $priceCurrency ) ) ?></span>
						</div>
						<div class="col-12 ">
							<span><?= $enc->html( $this->translate( 'admin', 'Shipping Address' ) ) ?></span>
							<span class="f-left text-danger">0</span>
						</div>
						<div class="col-12 ">
							<span><?= $enc->html( $this->translate( 'admin', 'Discount' ) ) ?></span>
							<span class="f-left text-success ">- <?= $enc->html( sprintf( $priceFormat, $this->standardBasket->getPrice()->getRebate() , $priceCurrency ) ) ?></span>
						</div>
					</div>
					<hr>
					<div class="row ">
						<div class="col-12 ">
							<span><?= $enc->html( $this->translate( 'admin', 'Sum' ) ) ?> ( <?= $this->standardBasket->getProducts()->count()?> <?= $enc->html( $this->translate( 'admin', 'an item' ) ) ?>)</span>
							<span class="f-left total"><?= $enc->html( sprintf( $priceFormat, $this->standardBasket->getPrice()->getValue() , $priceCurrency ) ) ?></span>
						</div>
					</div>
					<div class="payment-button my-4 d-flex justify-content-center">
						<button type="submit" class="col-9" form="checkout-form">
							<?= $enc->html( $this->translate( 'admin', 'Checkout' ) ) ?>
						</button>
					</div>
				</div>
			</div>
		<!-- </div> -->
	</div>

</form>

<?php $this->block()->stop() ?>
<?= $this->block()->get( 'checkout/standard/summary' ) ?>
