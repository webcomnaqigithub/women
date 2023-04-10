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
<div class="Payment-page_container ">
   <div class="header-Payment-page">
      <div class="container ">
         <div class="d-flex-center">
            <div> 
               <a href="<?= airoute('aimeos_home', ['site' => 'default']) ?>">
                  <img src="<?= $enc->attr( $this->content( 'front/images/logo/Logo.png' ) ) ?>" style="width: 110px;">
               </a>
            </div>
            <div class="Payment-status">
               <span class="Shipping-addresses <?php if(str_contains(\Request::getRequestUri(), 'address')):?>text-danger<?php else :?>text-success<?php endif ?>"><?= $enc->html( $this->translate( 'admin', 'Shipping Address' ) ) ?> --------------------</span>
               <span class="Paying-off <?php if(str_contains(\Request::getRequestUri(), 'delivery') || str_contains(\Request::getRequestUri(), 'address')):?>text-danger<?php else :?>text-success<?php endif ?>"><?= $enc->html( $this->translate( 'admin', 'paying off' ) ) ?> --------------------</span>
               <span class="Order-status <?php if(str_contains(\Request::getRequestUri(), 'process')):?>text-success<?php endif ?>"><?= $enc->html( $this->translate( 'admin', 'Order status' ) ) ?> </span>
            </div>
         </div>
      </div>
   </div>
	<div id="Payment-section-3" style="display: block;" class="mb-5">
		<div class="Pay-check text-center" style="display: none;">
			<lottie-player class="Pay-check-lottie-player" src="js/progress2.json" background="transparent" speed="1" loop="" autoplay=""></lottie-player>
			<h5><?= $enc->html( $this->translate( 'admin', 'Payment in progress' ) ) ?></h5>
		</div>
		<div class="Pay-success text-center  mt-3" style="display: block;">
			<div class="d-flex justify-content-center">
				<lottie-player src="<?= $enc->attr( $this->content( 'front/js/succesfull.json' ) ) ?>" class="Pay-success-lottie-player" background="transparent" speed="1" loop="" autoplay=""></lottie-player>
			</div>
			<h5><?= $enc->html( $this->translate( 'admin', 'Payment and purchase completed successfully' ) ) ?></h5>
			<h5 class="sub-h5 py-2"> <?= $enc->html( $this->translate( 'admin', 'You can follow the order details from my order list' ) ) ?> </h5>
			<div class="my-5">
				<a href="<?= airoute('aimeos_shop_account', ['site' =>$this->get('store')->code, 'locale' => app()->getLocale()])?>" type="button" class="button-go-store"> <?= $enc->html( $this->translate( 'admin', 'My requests' ) ) ?></a>
			</div>
			<div>
				<a href="<?= airoute('aimeos_home', ['locale'=>app()->getLocale(), 'site'=>'default'])?>" type="button" class="button-go-order"><?= $enc->html( $this->translate( 'admin', 'Continue shopping' ) ) ?>   </a>
			</div>
		</div>
	</div>
	<div class="footer-Payment-page">
      <div class="container">
               <div class=" d-flex flex-sm-row flex-column align-items-center justify-content-center text-center">
                  <span class="text-white">  <?= $enc->html( $this->translate( 'admin', 'All rights reserved to ' ) ) ?> <?= $enc->html( $this->translate( 'admin', 'Ministry of Women Affairs' ) ) ?> © 2022 </span>
               </div>
            <!-- <div class="col-6">
               <div class="footer_social d-flex flex-row align-items-center justify-content-lg-end justify-content-center">
                  <ul>
                     <li><a class="cursor-pointer opacity-07"><img src="<?= $enc->attr( $this->content( 'front/images/icon/pay.png' ) ) ?>" width="50"></a>
                     </li>
                     <li><a class="cursor-pointer opacity-07"><img src="<?= $enc->attr( $this->content( 'front/images/icon/paypal.png' ) ) ?>"
                        width="50"></a></li>
                     <li><a class="cursor-pointer opacity-07"><img src="<?= $enc->attr( $this->content( 'front/images/icon/mada.png' ) ) ?>" width="50"></a>
                     </li>
                     <li><a class="cursor-pointer opacity-07"><img src="<?= $enc->attr( $this->content( 'front/images/icon/masterCard.png' ) ) ?>"
                        width="50"></a></li>
                     <li><a class="cursor-pointer opacity-07"><img src="<?= $enc->attr( $this->content( 'front/images/icon/visa.png' ) ) ?>" width="50"></a>
                     </li>
                  </ul>
               </div>
            </div> -->
      </div>
   </div>
</div>
<?php $this->block()->stop() ?>
<?= $this->block()->get('checkout/standard/process') ?>