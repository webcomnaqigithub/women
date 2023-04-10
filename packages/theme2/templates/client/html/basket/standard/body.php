<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Metaways Infosystems GmbH, 2012
 * @copyright Aimeos (aimeos.org), 2015-2022
 */

use Illuminate\Support\Facades\DB;

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

$modify = $this->get( 'summaryEnableModify', false );
$errors = $this->get( 'summaryErrorCodes', [] );
?>
<?php if( isset( $this->standardBasket ) ) : ?>
   <div class="bigen-container-shop "  >
   <!-- Breadcrumbs -->
   <div class="container">
      <div class="breadcrumbs">
         <ul>
            <li><a href="<?= airoute('aimeos_home', ['site' => 'default']) ?>">الرئيسية</a></li>
            <li><a href="#"><i class="fa fa-angle-left" aria-hidden="true"></i>الملف الشخصي</a></li>
            <li class="active"><a href="#"><i class="fa fa-angle-left" aria-hidden="true"></i>الطلبات</a></li>
         </ul>
      </div>
   </div>
   <div class="container">
      <div class="row">
         <div class="col-md-7">
            <div class="d-flex">
               <h5>سلة المشتريات</h5>
               <h5 class="count-Products"><?= $this->standardBasket->getProducts()->count()?> عناصر</h5>
            </div>
            <!-- /************/////////////////////////////////////////////// -->
            <?php foreach( $this->standardBasket->getProducts()->groupBy( 'order.base.product.vendor' )->ksort() as $vendor => $list ) : ?>
               <div class="Shop-Shopping-Basket">
                  <!-- <div class="round-check ">
                     <input type="checkbox"  id="checkbox2" />
                     <label for="checkbox2"></label>
                  </div>  -->
                  <div class="product_details_pay_store  my-2">
                     <div class="stor-logo">
                        <img src="<?= DB::table('mshop_locale_site')->where('label', $vendor)->first()->icon ?? '' ?>" style="width: 44px;padding-top: 13px;">
                     </div>
                     <div>
                        <div class="user_name"><?= $enc->html( $vendor ) ?></div>
                     </div>
                  </div>
               </div>
               <?php foreach( $list as $position => $product ) : $totalQuantity += $product->getQuantity() ?> 
               <input type="hidden" id="prodcod" value="<?= $enc->html( $product->getName(), $enc::TRUST ) ?>">
               <input type="hidden" id="prodid" value="<?= $enc->html( $product['order.base.product.productid'], $enc::TRUST ) ?>">
                  <div class="row Products-Shopping-Basket mt-2">
                     <div class="col-9 details_user_Products ">
                        <div class="img-Products"> 
                           <img src="<?= $enc->attr( $this->content( 'aimeos/' . $product->getMediaUrl()) ) ?>">
                        </div>
                        <div class="details_Products">
                        <?php
                           $params = array_diff_key( ['d_name' => $product['order.base.product.prodcode'], 'd_prodid' => $product->getId(), 'd_pos' => $position]  );
                           $url = $this->url( ( $product->getTarget() ?: $detailTarget ), $detailController, $detailAction, $params, [], $detailConfig );
                        ?>
                           <a href="<?= $enc->attr( $url ) ?>" >
                              <div class="Products_name" style="width: 100%;"><?= $enc->html( $product->getName(), $enc::TRUST ) ?></div>
                           </a>
                           <div class="Products_type"> x <?= $product->getQuantity()?> </div>
                           <div class="product_details_Quantity my-2">
                              <div class="quantity_selector">
                                 <?php $basketParams = array( 'b_action' => 'edit', 'b_position' => $position, 'b_quantity' => $product->getQuantity() - 1 ) ?>
                                 <a href="<?= $enc->attr( $this->link( 'client/html/basket/standard/url', $basketParams ) ) ?>" class="minus"><i class="fa fa-minus" aria-hidden="true"></i></a>
                                 <span id="quantity_value"><?= $enc->attr( $product->getQuantity() ) ?></span>
                                 <input type="hidden" id="input_quantity_value" class="addItem"
                                    name="<?= $enc->attr( $this->formparam( array( 'b_prod', $position, 'quantity' ) ) ) ?>"
                                    value="<?= $enc->attr( $product->getQuantity() ) ?>" maxlength="10" required="required" size="1">

                                 <?php $basketParams = array( 'b_action' => 'edit', 'b_position' => $position, 'b_quantity' => $product->getQuantity() + 1 ) ?>
                                 <a href="<?= $enc->attr( $this->link( 'client/html/basket/standard/url', $basketParams ) ) ?>" class="plus"><i class="fa fa-plus" aria-hidden="true"></i></a>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-3 details_button_Products-Shopping-Basket">
                        <div class="product_price ">
                        <?php
                           /// Price format with price value (%1$s) and currency (%2$s)
                           $format['value'] = $this->translate( 'client/code', 'price:' . ( $product->getPrice()->getType() ?: 'default' ), null, 0, false ) ?: $this->translate( 'client', '%1$s %2$s' );
                           $currency = $this->translate( 'client', $product->getPrice()->getCurrencyId() );
                        ?>
                              <?= $enc->html( sprintf( $priceFormat, $product->getPrice()->getValue(), $priceCurrency ) ) ?>
                        </div>
                        <div class="product_price-descount">
                           <?php if($product->getPrice()->getRebate() > 0):?>
                              <?= $enc->html( sprintf( $format['value'], $product->getPrice()->getValue() + ($product->getPrice()->getValue() * $product->getPrice()->getRebate()/100), $currency ), $enc::TRUST )  ?> 
                           <?php endif?>
                        </div>
                        <div class="button-Products-Shopping-Basket ">
                           <button class="button-Products-like"><img src="<?= $enc->attr( $this->content( 'front/images/icon/hart.svg' ) ) ?>" width="18">  </button>
                           <button class="button-Products-convert">  <img src="<?= $enc->attr( $this->content( 'front/images/icon/trash.svg' ) ) ?>" width="18" data-toggle="modal" data-target="#Modal-trash<?= $position?>">  </button>
                        </div>
                     </div>
                  </div>
                  <div class="modal fade" id="Modal-trash<?= $position?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                     <div class="modal-dialog modal-dialog-centered   d-flex justify-content-center" role="document">
                        <div class="modal-content  ">
                           <div class="modal-header-cust ">
                              <h5 class="modal-title text-right" > حذف عنصر واحد</h5>
                              <button type="button" class="close ml-n3" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">
                              <i class="fa fa-times-circle"></i>
                              </span>
                              </button>
                           </div>
                           <div class="modal-body mt-n3 text-center ">
                              <div>
                                 هل أنت متأكد أنك تريد حذف عنصر واحد من سلة المشتريات؟
                              </div>
                              <hr>
                              <div class="row py-1" >
                                 <form method="POST" class="col-6 " action="<?= $enc->attr( $this->link( 'client/html/account/favorite/url' ) ) ?>">
                                    <?= $this->csrf()->formfield() ?>
                                    <input type="hidden" name="<?= $this->formparam( 'fav_action' ) ?>" value="add" />
                                    <input type="hidden" name="<?= $this->formparam( 'fav_id' ) ?>" value="<?= $enc->attr( $product->getProductId() ) ?>" />
                                    <!-- <input type="hidden" name="<?= $this->formparam( 'd_prodid' ) ?>" value="<?= $enc->attr( $product->getProductId() ) ?>" /> -->
                                    <input type="hidden" name="<?= $this->formparam( 'd_name' ) ?>" value="<?= $product->getName( 'url' ) ?>" />
                                    <!-- <input type="submit" id="lovebtn" style="display: none;"> -->
                                    <button type="submit" id="lovebtn" class="text-center text-danger cursor-pointer" style="border: unset;background: unset;">نقل إلى قائمة الرغبات</button>
                                 </form>
                                 <?php if( ( $product->getFlags() & \Aimeos\MShop\Order\Item\Base\Product\Base::FLAG_IMMUTABLE ) == 0 ) : ?>
                                    <?php $basketParams = array( 'b_action' => 'delete', 'b_position' => $position ) ?>
                                    <a class="col-6 text-center cursor-pointer pr-sa" href="<?= $enc->attr( $this->link( 'client/html/basket/standard/url', $basketParams ) ) ?>">حذف</a>
                                 <?php endif ?>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               <?php endforeach ?>
            <?php endforeach ?>
         </div>
         <div class="col-md-5">
            <div class="row Pending-col-5">
               <div class="col-12 Pending-users">
                  <h5>طريقة الدفع</h5>
                  <!-- <div class="d-flex">
                     <div class="custom-radio-wrap  mt-1 ml-2">
                        <input id="1" type="radio" name="custom-radio-btn" disabled>
                        <label for="1"><img src="<?= $enc->attr( $this->content( 'front/images/icon/Path.svg' ) ) ?>"></label>
                     </div>
                     <div class=" payment mb-3">
                        <div class="payment-type ">
                           <img src="<?= $enc->attr( $this->content( 'front/images/icon/mada-bold.png' ) ) ?>" >
                        </div>
                        <div class="payment-type ">
                           <img src="<?= $enc->attr( $this->content( 'front/images/icon/mastercard-bold.png' ) ) ?>" >
                        </div>
                        <div class="payment-type ">
                           <img src="<?= $enc->attr( $this->content( 'front/images/icon/vsia-bold.png' ) ) ?>" >
                        </div>
                        <div class="payment-type ">
                           <img src="<?= $enc->attr( $this->content( 'front/images/icon/pay-bold.png' ) ) ?>" >
                        </div>
                     </div>
                  </div>
                  <div class="d-flex">
                     <div class="custom-radio-wrap mt-1 ml-2">
                        <input id="2" type="radio" name="custom-radio-btn" disabled>
                        <label for="2"><img src="<?= $enc->attr( $this->content( 'front/images/icon/Path.svg' ) ) ?>"></label>
                     </div>
                     <div class=" payment mb-3">
                        <div class="payment-type ">
                           <img src="<?= $enc->attr( $this->content( 'front/images/icon/paypal.png' ) ) ?>" >
                        </div>
                     </div>
                  </div> -->
                  <div class="d-flex">
                     <div class="custom-radio-wrap  mt-1 ml-2">
                        <input id="3" type="radio" name="custom-radio-btn" checked >
                        <label for="3"><img src="<?= $enc->attr( $this->content( 'front/images/icon/Path.svg' ) ) ?>" style="margin-top:6px ;"></label>
                     </div>
                     <div class=" payment mb-3">
                        <div class="payment-type2 ">
                           <img src="<?= $enc->attr( $this->content( 'front/images/icon/Component 45 – 1.png' ) ) ?>" width="25" class="mt-1" >
                           <span>عند الإستلام</span>
                        </div>
                     </div>
                  </div>
                  <form method="POST" action="<?= $enc->attr( $this->link( 'client/html/basket/standard/url' ) ) ?>">
				         <?= $this->csrf()->formfield() ?>
                     <div class="input-check">
                        <div class="input-icon " >
                           <input type="text" class="form-control" placeholder="تطبيق اسم القسيمة" name="<?= $enc->attr( $this->formparam( 'b_coupon' ) ) ?>">
                           <button type="submit" class="btn btn-sm btn-dark cursor-pointer f-left"  id="button-check">
                              <span id="span-button">تحقق</span>
                              <span id="svg">
                              </span>
                           </button>
                        </div>
                     </div>
                  </form>
                  <hr>
                  <div class="row invoice">
                     <div class="col-12 ">
                        <span>المنتجات</span>
                        <span class="f-left"><?= $this->standardBasket->getProducts()->count()?></span>
                     </div>
                     <div class="col-12 ">
                        <span>إجمالي العناصر</span>
                        <span class="f-left"><?= $enc->html( sprintf( $priceFormat, $this->standardBasket->getPrice()->getValue() , $priceCurrency ) ) ?></span>
                     </div>
                     <div class="col-12 ">
                        <span>الشحن</span>
                        <span class="f-left text-danger">0</span>
                     </div>
                     <div class="col-12 ">
                        <span>الخصم</span>
                        <span class="f-left text-success ">- <?= $enc->html( sprintf( $priceFormat, $this->standardBasket->getPrice()->getRebate() , $priceCurrency ) ) ?></span>
                     </div>
                  </div>
                  <hr>
                  <div class="row ">
                     <div class="col-12 ">
                        <span>المجموع ( <?= $this->standardBasket->getProducts()->count()?> عنصر)</span>
                        <span class="f-left total"><?= $enc->html( sprintf( $priceFormat, $this->standardBasket->getPrice()->getValue(), $priceCurrency ) ) ?></span>
                     </div>
                  </div>
                  <?php if($this->standardBasket->getProducts()->count() > 0 ) :?>
                     <?php if(auth()->check() && auth()->user()->merchant == 1):?>
                     <?php else :?>
                        <div class="Go-to-payment mt-4 mb-2 d-flex justify-content-center">
                              <a class="col-9" href="<?= $enc->attr( $this->link( 'client/html/checkout/standard/url' ) ) ?>/address">
                                 شراء الآن
                              </a>
                        </div>
                     <?php endif ?>
                  <?php endif ?>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<?php endif ?>
