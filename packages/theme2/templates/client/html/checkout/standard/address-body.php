<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Metaways Infosystems GmbH, 2013
 * @copyright Aimeos (aimeos.org), 2015-2022
 */

$enc = $this->encoder();
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
<?php $this->block()->start('checkout/standard/address') ?>
<form class="container-xxl page-body" method="<?= $enc->attr($this->get('standardMethod', 'POST')) ?>" action="/<?= app()->getLocale() ?>/shop/default/checkout/delivery" id="checkout-form">
	<?= $this->csrf()->formfield() ?>
	<div class="content-Payment-page">
		<div class="container ">
			<div id="Payment-section-1">
				<div class="row">
					<div class="col-md-7  ">
						<div class="d-flex-center  ">
							<h5><?= $enc->html( $this->translate( 'admin', 'Addresses' ) ) ?></h5>
							<div>
								<button class="button-add-addres">
									<i class="fa fa-plus"></i>
									<?= $enc->html( $this->translate( 'admin', 'Add a new title' ) ) ?>
								</button>
							</div>
						</div>
						<div class="address-Products-content">
							<form action="/<?= app()->getLocale() ?>/shop/default/checkout" method="POST" id="address-form">
								<?= $this->csrf()->formfield() ?>
								<div class="row ">
									<?php if (isset($this->addressDeliveryItems)) : ?> 
										<input type="hidden" name="ca_billingoption" value="<?= $enc->attr($this->addressPaymentItem->getAddressId()) ?>" >

										<?php foreach ($this->get('user_addresses', []) as $id => $address) : ?>
											<div class="col-md-12  Products_col addressDeliveryItems" id="addressDeliveryItems">
												<div class="d-flex"> 
													<div class="custom-radio-wrap ml-2"> 
														<input id="option-<?= $id ?>" type="radio" name="ca_deliveryoption" value="<?= $address->id ?>"   <?php if($address->default == 1):?>checked <?php endif?>>
														<label for="option-<?= $id ?>"><img src="<?= $enc->attr($this->content('front/images/icon/Path.svg')) ?>" style="margin-top:6px ;" class="option-image "></label>
													</div>
													<div class="Shipping-goods mr-2">
														<div class="icon-Shipping-goods">
															<svg xmlns="http://www.w3.org/2000/svg" width="18.893" height="26.33" viewBox="0 0 24.893 29.33">
																<g id="Location" transform="translate(1 1)">
																	<path id="Path_33958" d="M0,11.407a11.446,11.446,0,0,1,22.893.078v.13c-.078,4.109-2.372,7.907-5.185,10.876A30.087,30.087,0,0,1,12.354,26.9a1.387,1.387,0,0,1-1.815,0,29.543,29.543,0,0,1-7.531-7.052A14.648,14.648,0,0,1,0,11.446Z" fill="none" stroke="#525457" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2" />
																	<circle id="Ellipse_740" cx="3.669" cy="3.669" r="3.669" transform="translate(7.778 7.959)" fill="none" stroke="#525457" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2" />
																</g>
															</svg>
														</div>
														<div class="details-Shipping-goods">
															<div class="addres_name">
																<?= $address->firstname?>
																<?php if($address->default == 1):?>
																	<div class="status-name-addres">الإفتراضي</div>
																<?php endif?>
															</div>
															<div class="number"><?= $address->telephone ?></div>
															<div class="addres">
																<!-- <img src="<?= $enc->attr($this->content('front/images/icon/pals.png')) ?>"> -->
																<span><?= aitrans($address->countryid, [], 'country')?> </span>
																<span class="shop-addres pr-sa"><?= $address->city ?></span>
																<span class="shop-addres pr-sa"><?= $address->address1 ?></span>
																<span class="shop-addres pr-sa"><?= $address->postal ?></span>
																<a href="<?= airoute('profile.address.edit', ['id'=>$address->id])?>" class="button-edit-addres" >
																	<i class="fa fa-edit"></i>
																	<?= $enc->html( $this->translate( 'admin', 'Change' ) ) ?>
																</a>
															</div>
														</div>
													</div>
												</div>
											</div>
										<?php endforeach ?>
									<?php endif ?>
								</div>
							</form>
						</div>
						<div id="Div-Add-New-Adrees">
							<h4><?= $enc->html( $this->translate( 'admin', 'Add a new title' ) ) ?></h4>
							<form method="POST" action="<?= route('front.store_address', ['locale' => app()->getLocale()]) ?>" id="address-form">
								<?= $this->csrf()->formfield() ?>
								<input type="hidden" name="usid" value="<?= auth()->user()->id ?? '' ?>">
								<div class="row Register-input mt-2">
									<div class="col-md-6 my-1">
										<label><?= $enc->html( $this->translate( 'admin', 'full name' ) ) ?></label>
										<input type="text" name="firstname" class="form-control" placeholder=" <?= $enc->html( $this->translate( 'admin', 'full name' ) ) ?>">
									</div>
									<div class="col-md-6  my-1">
										<label><?= $enc->html( $this->translate( 'admin', 'Mobile number' ) ) ?></label>
										<div>
											<input type="tel" class="form-control input-tel" name="telephone">
										</div>
									</div>
									<div class="col-md-6  my-1">
										<label><?= $enc->html( $this->translate( 'admin', 'The state' ) ) ?></label>
										<select class="form-control select" name="countryid">
											<option selected><?= $enc->html( $this->translate( 'admin', 'Enter the country' ) ) ?></option>
											<?php foreach ($this->get('addressCountries', []) as $key => $countryId) : ?>
												<option value="<?= $enc->attr($key) ?>" <?= $selectfcn($addr, 'customer.address.countryid', $countryId) ?>>
													<?= $enc->html($this->translate('country', $countryId)) ?>
												</option>
											<?php endforeach ?>
										</select>
									</div>
									<div class="col-md-6  my-1">
										<label><?= $enc->html( $this->translate( 'admin', 'City' ) ) ?></label>
										<select class="form-control select" name="city">
											<option selected><?= $enc->html( $this->translate( 'admin', 'Choose the city' ) ) ?></option>
											<option value="1">غزة</option>
										</select>
									</div>
									<div class="col-md-6  my-1">
										<label><?= $enc->html( $this->translate( 'admin', 'street' ) ) ?></label>
										<input type="text" class="form-control" name="address1" placeholder=" <?= $enc->html( $this->translate( 'admin', 'Enter the street' ) ) ?>">
									</div>
									<div class="col-md-6  my-1">
										<label> <?= $enc->html( $this->translate( 'admin', 'ZIP code' ) ) ?></label>
										<input type="text" class="form-control" name="postal" placeholder="مثال : P860">
									</div>
									<div class="col-md-6  my-1">
										<div class="custom-control custom-switch">
											<input type="checkbox" class="custom-control-input" id="customSwitches" name="default" value="1">
											<label class="custom-control-label" for="customSwitches"><?= $enc->html( $this->translate( 'admin', 'Set as default shipping address' ) ) ?></label>
										</div>
									</div>
									<div class="col-12 mt-2 d-flex justify-content-center">
										<button type="button" class="button-addres-cancel ml-2" onclick="$('#Div-Add-New-Adrees').hide(); $('.address-Products-content').show()">
											<?= $enc->html( $this->translate( 'admin', 'Cancel' ) ) ?>
										</button>
										<button class="button-addres-save mr-2" value="1" onclick="Addres_save()">
											<i class="fa  fa-check  "></i>
											<?= $enc->html( $this->translate( 'admin', 'save address' ) ) ?>
										</button>
									</div>
								</div>
							</form>
						</div> 
					</div>
					<div class="col-md-5 pl-4 summary-a">
                     <div class="row Pending-col-5">
                        <div class="col-12 Pending-users summary-title">
                           <h5><?= $enc->html( $this->translate( 'admin', 'Summary' ) ) ?></h5>
                           <?php foreach( $this->standardBasket->getProducts()->groupBy( 'order.base.product.vendor' )->ksort() as $vendor => $list ) : ?>
                              <?php foreach( $list as $position => $product ) : $totalQuantity += $product->getQuantity() ?>
                                 <div class="row ">
                                 <div class="col-md-12 details_user_Products Products_col">
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
                                          <div class="Products_price"><?= $enc->html( sprintf( $priceFormat, $product->getPrice()->getValue(), $priceCurrency ) ) ?></div>
                                       </div>
                                    </a>
                                 </div>
                                 </div>
                                 <?php if ($position != array_key_last($list)) :?>
                                    <hr>
                                 <?php endif?>
                              <?php endforeach?>
                           <?php endforeach?>
                        </div>
                        <div class="col-12 Pending-users mt-3">
                           <h5><?= $enc->html( $this->translate( 'admin', 'Payment method' ) ) ?></h5>
                           <!-- <div class="d-flex">
                              <div class="custom-radio-wrap  mt-1 ml-2">
                                 <input id="1" type="radio"  disabled>
                                 <label for="1"><img src="<?= $enc->attr( $this->content( 'front/images/icon/Path.svg' ) ) ?>"></label>
                              </div>
                              <div class=" payment mb-3">
                                 <div class="payment-type ">
                                    <img src="<?= $enc->attr( $this->content( 'front/images/icon/mada-bold.png' ) ) ?>">
                                 </div>
                                 <div class="payment-type ">
                                    <img src="<?= $enc->attr( $this->content( 'front/images/icon/mastercard-bold.png' ) ) ?>">
                                 </div>
                                 <div class="payment-type ">
                                    <img src="<?= $enc->attr( $this->content( 'front/images/icon/vsia-bold.png' ) ) ?>">
                                 </div>
                                 <div class="payment-type ">
                                    <img src="<?= $enc->attr( $this->content( 'front/images/icon/pay-bold.png' ) ) ?>">
                                 </div>
                              </div>
                           </div> -->
                           <!-- <div class="d-flex">
                              <div class="custom-radio-wrap  mt-1 ml-2">
                                 <input id="2" type="radio" disabled>
                                 <label for="2"><img src="<?= $enc->attr( $this->content( 'front/images/icon/Path.svg' ) ) ?>"></label>
                              </div>
                              <div class=" payment mb-3">
                                 <div class="payment-type ">
                                    <img src="<?= $enc->attr( $this->content( 'front/images/icon/paypal.png' ) ) ?>">
                                 </div>
                              </div>
                           </div> -->
                           <div class="d-flex">
                              <div class="custom-radio-wrap  mt-1 ml-2">
                                 <input id="3" type="radio" checked>
                                 <label for="3"><img src="<?= $enc->attr( $this->content( 'front/images/icon/Path.svg' ) ) ?>" style="margin-top: 5px;"></label>
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
                                 <span class="f-left"><?= $enc->html( sprintf( $priceFormat, $this->standardBasket->getPrice()->getValue(), $priceCurrency ) ) ?></span>
                              </div>
                              <div class="col-12 ">
                                 <span><?= $enc->html( $this->translate( 'admin', 'Shipping Address' ) ) ?></span>
                                 <span class="f-left text-danger">0</span>
                              </div>
                              <div class="col-12 ">
                                 <span><?= $enc->html( $this->translate( 'admin', 'Discount' ) ) ?></span>
                                 <span class="f-left text-success ">- <?= $enc->html( sprintf( $priceFormat, $this->standardBasket->getPrice()->getRebate(), $priceCurrency ) ) ?></span>
                              </div>
                           </div>
                           <hr>
                           <div class="row ">
                              <div class="col-12 ">
                                 <span><?= $enc->html( $this->translate( 'admin', 'Sum' ) ) ?> ( <?= $this->standardBasket->getProducts()->count()?> <?= $enc->html( $this->translate( 'admin', 'an item' ) ) ?>)</span>
                                 <span class="f-left total"><?= $enc->html( sprintf( $priceFormat, $this->standardBasket->getPrice()->getValue(), $priceCurrency ) ) ?></span>
                              </div>
                           </div>

						   <?php if (!$this->addressDeliveryItems == []) : ?>
						<div class="payment-button d-flex justify-content-center mt-4">
							<button type="submit" class="col-9" form="checkout-form">
								<?= $enc->html( $this->translate( 'admin', 'tracking' ) ) ?>
							</button>
						</div>
					<?php endif?>
                        </div>
                     </div>
					 
                  </div>
				</div>
			</div>
		</div>
	</div>
</form>
<?php $this->block()->stop() ?>
<?= $this->block()->get('checkout/standard/address') ?>