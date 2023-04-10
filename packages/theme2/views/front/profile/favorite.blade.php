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
                     <li class="tab" data-active-tab="Stories"><span>قائمة المتاجر ({{$stores->count()}})</span></li>
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
                           <div class="col-md-3 mb-5 store-categories fav-item"> 
                              <div class="store-categories-details discount"> 
                                 <a href="{{airoute('aimeos_shop_detail', ['d_name' => $productItem->getRefItem()->getName( 'url' ), 'd_prodid' => $productItem->getRefItem()->getId(), 'locale'=>app()->getLocale(), 'site'=>'default'])}}">
                                    <div class="store-categories-img">
                                       <?php foreach( $productItem->getRefItem()->getRefItems('media') as $media ) : ?>
                                          <img src="/aimeos/{{$media->getPreview()}}" >
                                          <?php break; ?>
                                       <?php endforeach ?>	
                                    </div>
                                 </a> 
                                 <div class="favorite favorite_left active" data-prodid="{{$productItem->getRefItem()->getId()}}"></div>
                                 <div class="product_info l-h-product-info">
                                    <div class="row">
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
                     @foreach ($stores as $item)
                        <div class="col-lg-3 store-card">
                           <a href="shop/{{$item->code}}">
                              <div class="store-card-details">
                                 <div class="store-background-img">
                                       <img src="{{asset('front/images/blog_3.jpg')}}">
                                 </div>
                                 <div class="store-logo">
                                       <img  src="{{asset($item['locale.site.icon'])}}">
                                 </div>
                                 <div class="store-name">
                                          {{$item->label}}
                                 </div>
                                 <div class="store-rating">
                                       {{str_repeat('<i class="star_rating fa fa-star" aria-hidden="true"></i>', $item->rating)}}
                                       {{$item->rating}}  
                                 </div>
                                 <div class="store-go-to">
                                       <button class="btn cursor-pointer mt-2 ">
                                       {{aitrans('Browse the store', [], 'client')}}
                                       </button>
                                 </div>
                              </div>
                           </a>
                     </div>
                     @endforeach
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection

@section('js')
   <script>
      $('.favorite').click(function(){
         let prodid = $(this).data('prodid');
         let url = '/ar/profile/default/favorite/delete/ID';
         let fav_item = $(this).closest(".fav-item");
         $.ajax({
            type:"post",
            url: url.replace('ID', prodid),
            data:{
               _token:"{{ csrf_token() }}",
            },
            success: function(response) {
               if(response)
               {
                  fav_item.fadeOut(300,function(){
                     fav_item.remove();
                  });
               }
            }
         });
      });
   </script>
@endsection