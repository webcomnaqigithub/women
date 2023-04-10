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
$priceCurrency = $this->translate( 'currency', $price->getCurrencyId() );
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
 
      <?= $this->get( 'body' ) ?>
 
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



 