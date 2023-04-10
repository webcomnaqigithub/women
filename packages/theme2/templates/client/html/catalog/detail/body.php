<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Metaways Infosystems GmbH, 2012
 * @copyright Aimeos (aimeos.org), 2015-2022
 */

use Illuminate\Support\Facades\DB;

/* Available data:
 * - detailProductItem : Product item incl. referenced items
 */


$enc = $this->encoder();

/** client/html/basket/require-stock
 * Customers can order products only if there are enough products in stock
 *
 * Checks that the requested product quantity is in stock before
 * the customer can add them to his basket and order them. If there
 * are not enough products available, the customer will get a notice.
 *
 * @param boolean True if products must be in stock, false if products can be sold without stock
 * @since 2014.03
 */
$reqstock = (int) $this->config( 'client/html/basket/require-stock', true );

/** client/html/catalog/detail/basket-add
 * Display the "add to basket" button for each suggested/bought-together product item
 *
 * Enables the button for adding products to the basket for the related products
 * in the basket. This works for all type of products, even for selection products
 * with product variants and product bundles. By default, also optional attributes
 * are displayed if they have been associated to a product.
 *
 * To fetch the variant articles of selection products too, add this setting to
 * your configuration:
 *
 * mshop/common/manager/maxdepth = 3
 *
 * @param boolean True to display the button, false to hide it
 * @since 2021.04
 * @see client/html/catalog/home/basket-add
 * @see client/html/catalog/lists/basket-add
 * @see client/html/catalog/product/basket-add
 * @see client/html/basket/related/basket-add
 */
   $position = $this->get( 'position' );
   $detailTarget = $this->config( 'client/html/catalog/detail/url/target' );
   $detailController = $this->config( 'client/html/catalog/detail/url/controller', 'catalog' );
   $detailAction = $this->config( 'client/html/catalog/detail/url/action', 'detail' );
   $detailConfig = $this->config( 'client/html/catalog/detail/url/config', [] );
   $detailFilter = array_flip( $this->config( 'client/html/catalog/detail/url/filter', ['d_prodid'] ) );

?>
<?php if( isset( $this->detailProductItem ) ) : ?>
<div class="container product-details" style="margin-top: 200px;">
   <div class="row "> 
      <div class="col-lg-6">
         <div class="single_product_pics">
            <div class="row">
               <div class="col-lg-2 px-2.5 thumbnails_col order-lg-1 order-2">
                  <div class="single_product_thumbnails">
                     <ul>
						<?php foreach($this->get('detailMediaItems') as $mediaItem) : ?>
							<li class="active">
                        <img src="<?= $enc->attr( $this->content( 'aimeos/' . $mediaItem->getPreview(), $mediaItem->getFileSystem() ) ) ?>" 
                         alt="" data-image="<?= $enc->attr( $this->content( 'aimeos/' . $mediaItem->getPreview(960), $mediaItem->getFileSystem() ) ) ?>">
                     </li>
						<?php endforeach ?>
                     </ul>
                  </div>
               </div>
               <div class="col-lg-10 image_col order-lg-2 order-1">
                  <div class="single_product">
                     <div class="single_product_image">
                        <div class="single_product_image_background" 
                             style="background-image:url('<?= $enc->attr(  $this->content( 'aimeos/' .$this->get('detailMediaItems', map() )->first()->getPreview(960), $mediaItem->getFileSystem() ) ) ?>')">
                        </div>
                     </div>
                     <div class="favorite favorite_left button-Products-like" data-d_prodid="<?= $this->detailProductItem->getId()?>" data-d_name="<?= $this->detailProductItem->getLabel() ?>"></div>                      
                  </div>
               </div>
            </div>
         </div>
      </div> 
      <div class="col-lg-6">
         <div class="product_details">
            <div class="product_details-top">
               <span class="name">
                  <?php
                     $x = 1;
                     $length = count($this->get('detailProductItem')->getRefItems('catalog'));
                  ?>
                  <?php foreach($this->get('detailProductItem')->getRefItems('catalog') as $category):?>
                     <?php if($x === 1) :?>
                           <?php $x++; ?> <!-- skip and go to second one  -->
                     <?php elseif($x == $length) : ?>
                        <?= $enc->attr( $category->label ) . '  ' ?>
                        <?php else  : ?>
                        <?= $enc->attr( $category->label ) . '  |  ' ?>
                     <?php $x++; endif?>
                  <?php endforeach ?>

               </span>
               <span class="count pr-sa"><?= $enc->html( $this->translate( 'client', 'sold' ) ) ?> <?= $enc->attr( $this->get('order_number')) . '  ' ?>  </span>
               <span class="rating pr-sa">
               <i class="star_rating fa fa-star"></i>
               <?= $this->get('detailProductItem')->getRating()?></span>
            </div>
            <div class="product_details_title my-2">
               <div class="row ">
                  <div class="col-8">
                     <div class="font-weight-bold ">
                        <h5><?= $this->detailProductItem->getLabel() ?></h5>
                     </div>
                  </div>  
                  <?php if($this->get('detailProductItem')->getRefItems('price')->first() != null && $this->get('detailProductItem')->getRefItems('price')->first()->getRebate() > 0) : ?> 
                     <div class="col-4 text-left">
                        <div class="product_bubble_decount ">
                        <?= $enc->html( $this->translate( 'client', 'Discount' ) ) ?> <?= $this->get('detailProductItem')->getRefItems('price')->first()->getRebate() . ' ' ?> %
                        </div>
                     </div>
                  <?php endif ?> 

               </div>
            </div>

               <div class="product_details_size my-2">
                  <label>
                  <?= $enc->html( $this->translate( 'client', 'Size' ) ) ?>
                  <img src="<?= $this->content( 'front/images/icon/size.svg' ) ?>" width="20" class="cursor-pointer"  data-toggle="modal" data-target="#Modal-size">
                  </label>
                  <div class="group-label-chack">
                     <?php if(count($this->get('detailProductItem')->getRefItems('attribute')) > 0 && $this->get('detailProductItem')->getRefItems('attribute')->first()['attribute.code'] == 's'):?>  
                        <label class="label-chack"> 
                           <input type="radio" name="product" class="card-input-element"> 
                           <div class="panel panel-default card-input selected-attr">
                              <div class="panel-heading">S</div>
                           </div>
                        </label>
                     <?php endif?>
                     <?php if(count($this->get('detailProductItem')->getRefItems('attribute')) > 0 && $this->get('detailProductItem')->getRefItems('attribute')->first()['attribute.code'] == 'm'):?>
                        <label class="label-chack">
                           <input type="radio" name="product" class="card-input-element">
                           <div class="panel panel-default card-input selected-attr">
                              <div class="panel-heading">M</div>
                           </div>
                        </label>
                     <?php endif?>
                     <?php if(count($this->get('detailProductItem')->getRefItems('attribute')) > 0 && $this->get('detailProductItem')->getRefItems('attribute')->first()['attribute.code'] == 'l'):?>
                        <label class="label-chack">
                           <input type="radio" name="product" class="card-input-element">
                           <div class="panel panel-default card-input selected-attr">
                              <div class="panel-heading">L</div>
                           </div>
                        </label>
                        <?php endif?>
                     <?php if(count($this->get('detailProductItem')->getRefItems('attribute')) > 0 && $this->get('detailProductItem')->getRefItems('attribute')->first()['attribute.code'] == 'xl'):?>
                        <label class="label-chack">
                           <input type="radio" name="product" class="card-input-element">
                           <div class="panel panel-default card-input selected-attr">
                              <div class="panel-heading">XL</div>
                           </div>
                        </label>
                     <?php endif?>
                     <?php if(count($this->get('detailProductItem')->getRefItems('attribute')) > 0 && $this->get('detailProductItem')->getRefItems('attribute')->first()['attribute.code'] == '2xl'):?>
                        <label class="label-chack">
                           <input type="radio" name="product" class="card-input-element">
                           <div class="panel panel-default card-input selected-attr">
                              <div class="panel-heading" >2XL</div>
                           </div>
                        </label>
                     <?php endif?>
                  </div>
               </div>
               <div class="product_details_Quantity my-2">
                  <label>
                  <?= $enc->html( $this->translate( 'client', 'Quantity' ) ) ?>
                  </label>
                  <div class="quantity_selector">
                     <span class="minus"><i class="fa fa-minus" aria-hidden="true"></i></span>
                     <span id="quantity_value">1</span>
                     <?php if( $this->detailProductItem->getType() !== 'group' ) : ?>
                        <input type="hidden" id="input_quantity_value" <?= !$this->detailProductItem->isAvailable() ? 'disabled' : '' ?>
                           name="<?= $enc->attr( $this->formparam( ['b_prod', 0, 'quantity'] ) ) ?>"
                           step="<?= $this->detailProductItem->getScale() ?>"
                           min="<?= $this->detailProductItem->getScale() ?>" max="2147483647"
                           value="<?= $this->detailProductItem->getScale() ?>" required="required"
                           title="<?= $enc->attr( $this->translate( 'client', 'Quantity' ) ) ?>"
                        >
                     <?php endif ?>
                     <span class="plus"><i class="fa fa-plus" aria-hidden="true"></i></span>
                  </div>
               </div>
                
               <div class="product_details_in-store my-2">
                  <?php if($this->detailProductItem->getStockItems()->first() != null && $this->detailProductItem->getStockItems()->first()['stock.stocklevel'] > 0) : ?>
                     <div class="Existing">
                        <img src="<?= $this->content( 'front/images/icon/Existing.svg' ) ?>" width="15" class="cursor-pointer">
                        <span id="stock_number"><?= $this->detailProductItem->getStockItems()->first()['stock.stocklevel'] ?> </span><span> <?= $enc->html( $this->translate( 'client', 'in the store' ) ) ?></span>
                     </div>
                  <?php else : ?>
                     <div class="is-over">
                        <img src="<?= $this->content( 'front/images/icon/is-over.svg' ) ?>" width="15" class="cursor-pointer">
                        <span class="text-danger"><?= $enc->html( $this->translate( 'client', 'out of stock' ) ) ?></span>
                     </div>
                  <?php endif ?>
               </div> 
               <div class="product_details_price text-right my-3">
                  <!-- $520.00 <span> $590.00 </span> -->
                  <?php foreach( $this->detailProductItem->getRefItems('price') as $price ) : ?>
                  <?= $enc->attr($price->getValue()) ?>
                  <?= $this->translate( 'client', $price->getCurrencyid() )  ?>
               <?php break; ?>
               <?php endforeach ?>
               </div>
               <div class="product_details_pay_store  my-2">
                  <div class="stor-logo">
                     <a href="/<?= app()->getLocale()?>/shop/<?= $enc->attr( $this->get('site')->getCode()  ) ?>">
                        <img src="<?= $enc->attr( $this->get('site')->getIcon()  ) ?>">
                     </a>
                  </div>
                  <div class="mr-2" style="line-height: 1.5;">
                     <a href="/<?= app()->getLocale()?>/shop/<?= $enc->attr( $this->get('site')->getCode()  ) ?>">
                        <div class="user_name"><?= $this->get('site')->getLabel() ?></div>
                        <div class="user_name"><i class="star_rating fa fa-star"></i>
                           <?= $this->get('user')->rating ?? '0.0' ?>
                        </div>
                     </a>
                  </div>
               </div>
               <?php if( !$this->detailProductItem->getRefItems( 'price', 'default', 'default' )->empty() ) : ?>
                  <input type="hidden" value="add" name="<?= $enc->attr( $this->formparam( 'b_action' ) ) ?>">
                  <input type="hidden" name="<?= $enc->attr( $this->formparam( ['b_prod', 0, 'prodid'] ) ) ?>" value="<?= $enc->attr( $this->detailProductItem->getId() ) ?>">

                     <div class="Add-To-Cart my-2">
                        <button class="col-md-7 d-flex justify-content-center " id="Add-To-Cart" <?= !$this->detailProductItem->isAvailable() || $this->detailProductItem->getStockItems()->first()['stock.stocklevel'] <= 0 ? 'disabled style="background-color:#D0D0D0;color:#262626;"' : '' ?>>
                           <span class="Add-To-Cart-title">
                              <?= $enc->html( $this->translate( 'client', 'Add to cart' ) ) ?>
                              <img src="<?= $this->content( 'front/images/icon/shopping-cart.svg' ) ?>" width="20" class="cursor-pointer">
                           </span>
                        </button>
                     </div>

                  <?php endif ?>
            <!-- <div class="nots">
               <img src="<?= $this->content( 'front/images/icon/Shipping to.svg' ) ?>" width="20" class="cursor-pointer">
               يصل في موعد أقصاه 28 فبراير - 4 مارس إذا طلبت اليوم.
            </div> -->  
            <?php if(count($this->get('detailProductItem')->getRefItems('attribute')) > 0 && $this->get('detailProductItem')->getRefItems('attribute', 'ProcessingTime')->first() !== null && $this->get('detailProductItem')->getRefItems('attribute', 'ProcessingTime') && $this->get('detailProductItem')->getRefItems('attribute', 'ProcessingTime')->first()['attribute.code']):?>
               <div class="nots">
                  <?= $enc->html( $this->translate( 'client', 'This product requires processing time' ) ) ?> <?= $this->get('detailProductItem')->getRefItems('attribute', 'ProcessingTime')->getListItems('text')->first()->getRefItem()->getContent()->first() ?>
               </div>
            <?php endif ?>
         </div>
      </div>
   </div>
</div>

<div class="container my-2">
   <div class="row">
      <div class="col-md-5">
         <div class="Product-specification mb-4">
            <div class="title"><?= $enc->html( $this->translate( 'client', 'Specifications' ) ) ?></div>
            <div class="Product-specification-details">
               <div class="type">
                  <img src="<?= $this->content( 'front/images/icon/specification.svg' ) ?>" width="" class="cursor-pointer">
                  <span><?= $enc->html( $this->translate( 'client', 'hand made' ) ) ?></span>
               </div>
               <div class="details"><?= $this->get('detailProductItem')->getRefItems('text')->first()['text.content'] ?></div>
            </div>
         </div>
         <div class="Product-rating mb-4">
            <div class="title"><?= $enc->html( $this->translate( 'client', 'Reviews' ) ) ?></div>
            <?php $rating = $this->get('ratings'); $rat = $rating->first() ?? 0; $total = $rating->sum('count'); ?>
            <?php foreach($rating as $item):?>
               <div class="rating"> 
                  <div class="stars-rating"> 
                        <?= str_repeat('<i class=" fa fa-star gold"></i>', $item->rating) ?> 
                        <?= str_repeat('<i class=" fa fa-star"></i>', 5 - $item->rating)?> 
                  </div>
                  <div class="progress">
                     <div class="progress-bar bg-danger" role="progressbar" style="width: <?=($item->count / $total) * 100 ?>%;"
                        aria-valuemax="100"></div>
                  </div>
               </div>
            <?php endforeach?>
         </div>
         <div class="Product-liked mb-4">
            <div class="title"><?= $enc->html( $this->translate( 'client', 'Did you like the product? Share it now' ) ) ?></div>
            <div class="social-media">
               <a href="https://www.facebook.com/sharer/sharer.php?u=<?= url()->current() ?>&display=popup" class="btn btn-sm btn-About-facebook  btn-outline-light cursor-pointer round">
                  <i class="fa fa-facebook"></i>
                  <?= $enc->html( $this->translate( 'client', 'Facebook' ) ) ?>
               </a>
               <a href="https://instagram.com/mowa.gaza?igshid=YmMyMTA2M2Y=" class="btn btn-sm btn-About-instagram btn-outline-light cursor-pointer round">
                  <i class="fa fa-instagram"></i>
                  <?= $enc->html( $this->translate( 'client', 'instagram' ) ) ?>
               </a>
               <a href="https://twitter.com/intent/tweet?text=Bazar Product&url=<?= url()->current() ?>" class="btn btn-sm btn-About-twitter btn-outline-light cursor-pointer round">
                  <i class="fa fa-twitter"></i>
                  <?= $enc->html( $this->translate( 'client', 'twitter' ) ) ?>
               </a>
               <a href="https://wa.me/?text=<?= url()->current() ?>" data-action="share/whatsapp/share" class="btn btn-sm btn-About-whatsapp  btn-outline-light cursor-pointer round">
               <i class="fa fa-whatsapp"></i>
                  <?= $enc->html( $this->translate( 'client', 'Whats Up' ) ) ?>
               </a>
            </div>
         </div>
      </div>
      <div class="col-md-7">
         <div class="Product-Reviews mb-4">
            <div class="head">
               <span class="title"><?= $this->get('reviews')->count()?> <?= $enc->html( $this->translate( 'client', 'Reviews' ) ) ?></span>
               <div class="d-flex justify-content-end">
                  <!-- <ul class="product_sorting">
                     <li>
                        <span class="type_sorting_text"><?= $enc->html( $this->translate( 'client', 'sort by' ) ) ?></span>
                        <i class="fa fa-angle-down"></i>
                        <ul class="sorting_type">
                           <a href="?sort=-ctime">
                           <li class="type_sorting_btn"
                              data-isotope-option="{ &quot;sortBy&quot;: &quot;original-order&quot; }">
                              <span><?= $enc->html( $this->translate( 'client', 'Elements' ) ) ?></span>
                           </li></a>
                           <li class="type_sorting_btn"
                              data-isotope-option="{ &quot;sortBy&quot;: &quot;price&quot; }">
                              <span> <?= $enc->html( $this->translate( 'client', 'Price' ) ) ?></span>
                           </li>
                           <li class="type_sorting_btn"
                              data-isotope-option="{ &quot;sortBy&quot;: &quot;name&quot; }">
                              <span><?= $enc->html( $this->translate( 'client', 'Product' ) ) ?></span>
                           </li>
                        </ul>
                     </li>
                  </ul>  -->
                  <form action="<?= airoute('aimeos_shop_detail', ['d_name'=>$this->detailProductItem->getUrl()])?>" method="GET">
                     <select name="sort" onchange="this.form.submit()">
                        <option value="" disabled selected><?= $enc->html( $this->translate( 'client', 'sort by' ) ) ?></option>
                        <option  value="ctime">الأحدث</option>
                        <option value="rating">التقييم</option>
                     </select>
                  </form>
               </div>
            </div>
            <div class="All-Reviews overflow-y-hidden">
               <?php foreach($this->get('reviews') as $review):?>
                  <div class=" reviews_col">
                     <div class="user_review_container d-flex ">
                        <div class="user-Reviews-img">
                           <img src="<?= $review->response == '' ? $this->content( 'front/images/User-avatar.png' ) :$review->response?>">
                        </div>
                        <div class="review"> 
                           <div class="user_name"><?= $review->name?>
                              <span class="rating">
                                 <?= str_repeat('<i class=" fa fa-star gold"></i>', $review->rating) ?> 
                                 <?= str_repeat('<i class=" fa fa-star"></i>', 5 - $review->rating)?> 
                                 <?= $review->rating . '.00' ?? ''?>
                              </span>
                           </div>
                           <div class="review_date"><?= date('d/m/y h:i A', strtotime($review->ctime)) ?? ''?></div>
                           <div class="review-word">
                              <?= $review->comment ?? ''?>
                           </div>
                        </div>
                     </div>
                  </div>
               <?php endforeach?>
            </div>
            <div class="show-more">
               <!-- (20) عرض المزيد -->
            </div>
         </div>
      </div>
   </div>
</div>
<!-- More store -->
<div class="container my-2">
   <div class="row mt-5">
      <div class="col-12 More-store">
         <div class="container">
            <div class="row">
               <div class="col-9 mb-3">
                  <h5><?= $enc->html( $this->translate( 'client', 'More from this store' ) ) ?></h5>
               </div>
               <div class="col-3 ">
                  <div
                     class=" d-flex flex-row justify-content-end">
                     <a href="/<?= app()->getLocale()?>/shop/<?= $enc->attr( $this->get('site')->getCode()  ) ?>">
                        <h6>
                        <?= $enc->html( $this->translate( 'client', 'view all' ) ) ?></h4>
                     </a>
                  </div>
               </div>
            </div> 
            <div class="product_details_pay_store my-n2" style="line-height: 1.5;">
               <div class="stor-logo">
                  <a href="/<?= app()->getLocale()?>/shop/<?= $enc->attr( $this->get('site')->getCode()  ) ?>">
                     <img src="<?= $enc->attr( $this->get('site')->getIcon()  ) ?>">
                  </a>
               </div>
               <div class="mr-2">
                  <a href="/<?= app()->getLocale()?>/shop/<?= $enc->attr( $this->get('site')->getCode()  ) ?>">
                     <div class="user_name"><?= $this->get('site')->getLabel() ?></div>
                     <div class="user_name"><i class="star_rating fa fa-star"></i>
                        <?= $this->get('user')->rating ?? '0.0' ?>
                     </div>
                  </a>
               </div>
            </div>
            <div class="row">
               <div class="col-12">
                  <div class="product_slider_container1 mt-3">
                     <div class="owl-carousel owl-theme product_slider1"> 
                        <?php foreach($this->get('store_products')->slice(0,6)  as $productItem) : ?>
                           <?php
                              $params = array_diff_key( ['d_name' => $productItem->getName( 'url' ), 'd_prodid' => $productItem->getId(), 'd_pos' => $position !== null ? $position++ : ''], $detailFilter );
                              $url = $this->url( ( $productItem->getTarget() ?: $detailTarget ), $detailController, $detailAction, $params, [], $detailConfig );
                           ?>
                           <div class="owl-item product_slider_item1">
                              <a href="<?= $enc->attr( $url ) ?>">
                                 <div class="product-item">
                                    <div class="product discount">
                                       <div class="product_image">
                                          <?php foreach( $productItem->getRefItems('media') as $media ) : ?>
                                             <img src="/aimeos/<?= $media->getPreview() ?>" style="width: 75%;">
                                             <?php break; ?>
                                          <?php endforeach ?>											
                                       </div>
                                       <div class="favorite favorite_left"></div>
                                       <div class="product_bubble product_bubble_right product_bubble_green d-flex flex-column align-items-center"><span>جديد</span></div>
                                       <div class="product_info l-h-product-info">
                                          <div class="row ">
                                          <div class="col-6">
                                             <div class=" text-right">
                                                <span>
                                                   <?php foreach($productItem->getRefItems('catalog')->getNode() as $item) : ?>
                                                      <?php if($item->status == 1 && $item->level) :?>
                                                         <?= $item->label ?>
                                                      <?php break; endif ?>
                                                   <?php endforeach?>
                                                </span>
                                             </div>
                                          </div>
                                          <div class="col-6">
                                             <div class=" text-left">
                                                <i class="star_rating fa fa-star" aria-hidden="true"></i> 
                                                <span>
                                                   <?= $productItem->rating ?? '0.0'?>
                                                </span>
                                             </div>
                                          </div>
                                          </div>
                                          <div class="product_title "><?= $productItem->getLabel() ?></div>
                                          <div class="row ">
                                             <?php foreach( $productItem->getRefItems('price') as $price ) : ?>
                                                <div class="col-7">
                                                   <div class="product_price ">
                                                      <?= $price->getValue() . ' ' . $this->translate( 'client', $price->getCurrencyid() ) ?>
                                                      <?php if($price->getRebate() > 0 ) : ?>	
                                                         <span><?= $price->getValue() + ($price->getValue() * $price->getRebate()/100) ?></span>
                                                      <?php endif ?> 
                                                   </div>
                                                </div>
                                                <?php if($price->getRebate() > 0 ) : ?>
                                                   <div class="col-5 text-left">
                                                      <div class="product_bubble_decount ">
                                                         <?= $price->getRebate() . ' %' ?> خصم
                                                      </div>
                                                   </div>
                                                <?php endif ?>
                                                <?php break; ?>
                                             <?php endforeach ?>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </a>
                           </div>
                        <?php endforeach?>
                     </div>
                     <!-- Slider Navigation -->
                     <div
                        class="carousel-circle product_slider_nav_left1 product_slider_nav_left-best-sellers1 product_slider_nav1 d-flex align-items-center justify-content-center flex-column">
                        <i class="fa fa-chevron-left" aria-hidden="true"></i>
                     </div>
                     <div
                        class="carousel-circle product_slider_nav_right1 product_slider_nav_right-best-sellers1 product_slider_nav1 d-flex align-items-center justify-content-center flex-column">
                        <i class="fa fa-chevron-right" aria-hidden="true"></i>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- More store -->
<div class="container mt-5">
   <div class="row ">
      <div class="col-12 More-store">
         <div class="container">
            <div class="row  ">
               <div class="col-9">
                  <h5><?= $enc->html( $this->translate( 'client', 'You may also like' ) ) ?></h5>
               </div>
               <div class="col-3 ">
                  <div
                     class=" d-flex flex-row justify-content-end">
                     <a href="<?= airoute('front.ournews', ['site' => 'default'])?>">
                        <h6>
                        <?= $enc->html( $this->translate( 'client', 'view all' ) ) ?></h4>
                     </a>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-12">
                  <div class="product_slider_container2 mt-3">
                     <div class="owl-carousel owl-theme product_slider2">
                        <?php foreach($this->get('related_products')->slice(0,6) as $productItem) : ?>
                           <?php
                              $params = array_diff_key( ['d_name' => $productItem->getName( 'url' ), 'd_prodid' => $productItem->getId(), 'd_pos' => $position !== null ? $position++ : ''], $detailFilter );
                              $url = $this->url( ( $productItem->getTarget() ?: $detailTarget ), $detailController, $detailAction, $params, [], $detailConfig );
                           ?>
                           <div class="owl-item product_slider_item2">
                              <a href="<?= $enc->attr( $url  ) ?>">
                                 <div class="product-item">
                                    <div class="product discount">
                                       <div class="product_image">
                                          <?php foreach( $productItem->getRefItems('media') as $media ) : ?>
                                             <img src="/aimeos/<?= $media->getPreview() ?>" style="width: 75%;">
                                             <?php break; ?>
                                          <?php endforeach ?>											
                                       </div>
                                       <div class="favorite favorite_left"></div>
                                       <div class="product_bubble product_bubble_right product_bubble_green d-flex flex-column align-items-center"><span>جديد</span></div>
                                       <div class="product_info l-h-product-info">
                                          <div class="row ">
                                          <div class="col-6">
                                             <div class=" text-right">
                                                <span>
                                                   <?php foreach($productItem->getRefItems('catalog')->getNode() as $item) : ?>
                                                      <?php if($item->status == 1 && $item->level) :?>
                                                         <?= $item->label ?>
                                                      <?php break; endif ?>
                                                   <?php endforeach?>
                                                </span>
                                             </div>
                                          </div>
                                          <div class="col-6">
                                             <div class=" text-left">
                                                <i class="star_rating fa fa-star" aria-hidden="true"></i> 
                                                <span>
                                                   <?= $productItem->rating ?? '0.0'?>
                                                </span>
                                             </div>
                                          </div>
                                          </div>
                                          <div class="product_title "><?= $productItem->getLabel() ?></div>
                                          <div class="row ">
                                             <?php foreach( $productItem->getRefItems('price') as $price ) : ?>
                                                <div class="col-7">
                                                   <div class="product_price ">
                                                      <?= $price->getValue() . ' ' .  $this->translate( 'client', $price->getCurrencyid() ) ?>	
                                                      <?php if($price->getRebate() > 0 ) : ?>
                                                         <span><?= $price->getValue() + ($price->getValue() * $price->getRebate()/100) ?></span> 
                                                      <?php endif ?>
                                                   </div>
                                                </div>
                                                <?php if($price->getRebate() > 0 ) : ?>
                                                   <div class="col-5 text-left">
                                                      <div class="product_bubble_decount ">
                                                         <?= $price->getRebate() . ' %' ?> خصم
                                                      </div>
                                                   </div>
                                                <?php endif ?>
                                                <?php break; ?>
                                             <?php endforeach ?>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </a>
                           </div>
                        <?php endforeach?>
                     </div>
                     <!-- Slider Navigation -->
                     <div class="carousel-circle product_slider_nav_left2 product_slider_nav_left-best-sellers2 product_slider_nav2 d-flex align-items-center justify-content-center flex-column">
                        <i class="fa fa-chevron-left" aria-hidden="true"></i>
                     </div>
                     <div
                        class="carousel-circle product_slider_nav_right2 product_slider_nav_right-best-sellers2 product_slider_nav2 d-flex align-items-center justify-content-center flex-column">
                        <i class="fa fa-chevron-right" aria-hidden="true"></i>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<!--Modal: Modal-Added-Cart-->
<div class="Modal-Added-Cart modal fade animate" id="Modal-Added-Cart" tabindex="-1" role="dialog"
   aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="false">
   <div class="modal-dialog modal-side modal-bottom-right" role="document">
      <div class="modal-content  animate-bottom">
         <!-- Here you have the juicy hahah -->
         <div class="modal-body">
            <div class="d-flex">
               <div>
                  <img src="<?= $this->content( 'front/images/icon/shopping.svg' ) ?>" width="40">
               </div>
               <div class="show-cart-title">
                  <div><?= $enc->html( $this->translate( 'client', 'Added to cart' ) ) ?></div>
                  <div><?= $enc->html( $this->translate( 'client', 'Buy anytime you like' ) ) ?></div>
               </div>
            </div>
            <div class="button-show-cart">
               <a href="/<?= app()->getLocale()?>/shop/default/basket" type="button" class="btn btn-dark round-20 ">
                  <?= $enc->html( $this->translate( 'client', 'View cart' ) ) ?>					 
               </a>
            </div>
         </div>
      </div>
   </div>
</div>
<!--Modal: stock is full-->
<div class="Modal-Added-Cart modal fade animate" id="stock-full" tabindex="-1" role="dialog"
   aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="false">
   <div class="modal-dialog modal-side modal-bottom-right" role="document" style="max-width: 265px;">
      <div class="modal-content  animate-bottom">
         <!-- Here you have the juicy hahah -->
         <div class="modal-body">
            <div class="d-flex">
               <div>
                  <img src="<?= $this->content( 'front/images/icon/shopping.svg' ) ?>" width="40">
               </div>
               <div class="show-cart-title align-self-center">
                  <div>عذرا، تم نفاذ الكمية</div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!--Modal: Modal-Added-Cart-->
<div class="modal fade" id="Modal-size" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered bd-example-modal-sm d-flex justify-content-center" role="document">
      <div class="modal-content modal-sm ">
         <div class="modal-header-cust text-center">
            <h5 class="modal-title" id="exampleModalLongTitle">
               <?= $enc->html( $this->translate( 'client', 'Size guide' ) ) ?>	
            </h5>
            <button type="button" class="close ml-n3" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">
            <i class="fa fa-times-circle"></i>
            </span>
            </button>
         </div>
         <div class="modal-body mt-n3 ">
            <div class="size-type">
               <div class="group-label-chack">
                  <label class="label-chack">
                     <input type="radio" name="product" class="card-input-element" checked>
                     <div class="panel panel-default card-input">
                        <div class="panel-heading"><?= $enc->html( $this->translate( 'client', 'Inch' ) ) ?>	</div>
                     </div>
                  </label>
                  <label class="label-chack">
                     <input type="radio" name="product" class="card-input-element">
                     <div class="panel panel-default card-input">
                        <div class="panel-heading"><?= $enc->html( $this->translate( 'client', 'centimeter' ) ) ?>	</div>
                     </div>
                  </label>
               </div>
            </div>
            <div class="row text-center mt-3">
               <div class="col-6"><?= $enc->html( $this->translate( 'client', 'Show' ) ) ?>	</div>
               <div class="col-6"><?= $enc->html( $this->translate( 'client', 'High' ) ) ?>	</div>
            </div>
            <div class="row text-center mt-2">
               <div class="col-6">15.5</div>
               <div class="col-6">15.5</div>
            </div>
         </div>
      </div>
   </div>
</div>
<input type="hidden" name="d_prodid" id="d_prodid" value="<?= $enc->attr( $this->detailProductItem->getId() ) ?>" />
<?php endif ?>
