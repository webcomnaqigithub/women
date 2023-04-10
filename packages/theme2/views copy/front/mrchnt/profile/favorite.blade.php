@extends('base')
@section('title') المفضلة @endsection

@section('content')
<div class="bigen-container-Desires "  >
   <!-- Breadcrumbs -->
   <div class="container">
      <div class="breadcrumbs ">
         <ul>
            <li><a href="{{ airoute('aimeos_home', ['site' => 'default']) }}">الرئيسية</a></li>
            <li class="active"><a href="#"><i class="fa fa-angle-left" aria-hidden="true"></i>الرغبات</a></li>
         </ul>
      </div>
   </div>
   <!--  shop tap-->
   <div class="tabs_section_container">
      <div class="container">
         <div class="row">
            <div class="col">
               <div class="tabs_container">
                  <ul class="tabs d-flex align-items-md-center justify-content-center">
                     <li class="tab active" data-active-tab="Desires"><span>قائمة الرغبات ({{$favoriteItems->count()}})</span></li>
                     <li class="tab" data-active-tab="Stories"><span>المراجعات (0)</span></li>
                  </ul>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col mt-n13">
               <!-- Tab Description -->
               <div id="Desires" class="tab_container active">
                  <div class="row"> 
                     @foreach ($favoriteItems as $productItem)
                        @if ($productItem->getRefItem() !== null)
                           <div class="col-md-3 mb-5 store-categories"> 
                              <div class="store-categories-details discount">
                                 <a href="{{airoute('aimeos_shop_list', ['locale'=>app()->getLocale(), 'site'=>'default']). '/' . $productItem->getRefItem()->getUrl()}}">
                                    <div class="store-categories-img">
                                       <?php foreach( $productItem->getRefItem()->getRefItems('media') as $media ) : ?>
                                          <img src="/aimeos/{{$media->getPreview()}}" >
                                          <?php break; ?>
                                       <?php endforeach ?>	
                                    </div>
                                 </a>
                                 <div class="favorite favorite_left active"></div>
                                 <div class="product_info l-h-product-info">
                                    <div class="row " >
                                       <div class="col-6">
                                          <div class=" text-right">
                                             <span> 
                                                @foreach($productItem->getRefItem()->getRefItems('catalog')->getNode() as $item1)
                                                   @if($item1->status == 1 && $item1->level)
                                                      {{$item1->label}}
                                                      @break
                                                   @endif
                                                @endforeach
                                             </span>
                                          </div>
                                       </div>
                                       <div class="col-6">
                                          <div class=" text-left">
                                             <i class="star_rating fa fa-star" aria-hidden="true"></i> 
                                             <span>
                                                {{$item->rating ?? '0.0'}}
                                             </span>
                                          </div>
                                       </div>
                                    </div>
                                       <div class="product_title text-right">
                                          {{$productItem->getRefItem()['product.label']}}
                                       </div>
                                          <div class="row">
                                             <?php foreach( $productItem->getRefItem()->getRefItems('price') as $price ) : ?>
                                                <div class="col-7 text-right">
                                                   <div class="product_price ">
                                                      {{$price->getValue() . ' ' . aitrans( $price->getCurrencyid(), [],'client' )}}	
                                                      @if($price->getRebate() > 0)	
                                                         <span>{{$price->getValue() + ($price->getValue() * $price->getRebate()/100)}}</span> 
                                                      @endif
                                                   </div>
                                                </div>
                                                <?php if($price->getRebate() > 0 ) : ?>
                                                   <div class="col-5 text-left">
                                                      <div class="product_bubble_decount ">
                                                         {{ $price->getRebate() . ' %' }}   {{aitrans('Discount', [], 'client')}}
                                                      </div>
                                                   </div>
                                                <?php endif ?>
                                                <?php break; ?>
                                             <?php endforeach ?>
                                          </div>
                                       
                                 </div>
                              </div>
                           </div>
                        @endif
                     @endforeach
                  </div>
                  <!-- Tab Additional Info -->
               </div>
               <div id="Stories" class="tab_container ">
                  <div class="row">
                     {{-- <div class="col-md-3 store-card mb-5">
                        <div class="store-card-details">
                           <div class="store-background-img">
                              <img src="images/blog_3.jpg">
                              <div class="favorite favorite_left active"></div>
                           </div>
                           <div class="store-logo">
                              <img  src="images/single_2_thumb.jpg">
                           </div>
                           <div class="store-name">
                              متجر المنى
                           </div>
                           <div class="store-rating">
                              <i class="star_rating fa fa-star" aria-hidden="true"></i> 4.9  <span>  </span>
                           </div>
                           <div class="store-go-to">
                              <button class="btn    cursor-pointer  ">
                              <a href="Store-data.html">تصفح المتجر</a>
                              </button>
                           </div>
                        </div>
                     </div> --}}
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection