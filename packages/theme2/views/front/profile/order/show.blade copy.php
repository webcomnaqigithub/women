@extends('base')
@section('content')
@if(auth()->user()->merchant == 1)
   <div class="bigen-container-shop "  >
      <div class="container">
         <div class="breadcrumbs">
            <ul>
               <li><a href="{{ airoute('aimeos_home', ['site' => 'default']) }}">الرئيسية</a></li>
               <li><a href="#"><i class="fa fa-angle-left" aria-hidden="true"></i>الملف الشخصي</a></li>
               <li class="active"><a href="#"><i class="fa fa-angle-left" aria-hidden="true"></i>الطلبات</a></li>
            </ul>
         </div>
      </div>
      <div class="container">
         <div class="row">
            <div class="col-md-8">
               <div class="row ">
                  <div class="col-3">
                     <h4>المنتجات</h4>
                  </div>
               </div>
               <div class="row ">  
                  @foreach( $historyItems->getProducts() as $id => $product ) 
                     @if($product['order.base.product.siteid'] == auth()->user()->siteid)
                        <div class="col-md-12 details_user_Products Products_col"> 
                           <div class="img-Products">
                              <img src="{{'/aimeos/' . $product['order.base.product.mediaurl']}}">
                           </div>
                           <div class="details_Products">
                              <div class="Products_name">{{$product['order.base.product.name']}}</div>
                              <div class="Products_type"> x <?= $product->getQuantity()?> </div>
                              <div class="Products_number">#{{$product['order.base.product.prodcode']}}</div>
                              <div class="Products_price">{{$product['order.base.product.price'] . ' ' . aitrans($product['order.base.product.currencyid'], [],'client' )}}</div>
                              <span></span>
                           </div>
                           <div class="col-9 add_Products">
                              {{-- <button class="button-order-Cancel" data-toggle="modal" data-target="#order-refusal-modal" data-id="<?= $product->getId()?>" data-baseid="<?= $historyItems['order.base.id']?>" data-status="reject" @if($product['order.base.product.statuspayment'] == 5) style="display:block;" @endif>
                              إلغاء الطلب
                              </button> --}}
                              @if ($product['order.base.product.statusdelivery'] == -1)
                                 <button class="button-order-refusal mr-2 refuse-oder" data-id="<?= $product->getId()?>" data-baseid="<?= $historyItems['order.base.id']?>" data-status="reject" data-toggle="modal" data-target="#order-refusal-modal">
                                    رفض الطلب
                                 </button>
                                 <button class="button-order-accept mr-2 accept-order" data-id="<?= $product->getId()?>" data-baseid="<?= $historyItems['order.base.id']?>" data-status="accept">
                                 <i class="fa  fa-check  "></i>
                                    قبول الطلب
                                 </button>
                              @endif
                              @if ($product['order.base.product.statusdelivery'] == 2)
                                 <button class="button-order-accept mr-2 prepared" data-id="<?= $product->getId()?>" data-baseid="<?= $historyItems['order.base.id']?>" data-status="prepared">
                                 <i class="fa  fa-check  "></i>
                                    جاهز للتسليم
                                 </button>
                              @endif
                           </div>
                        </div>
                     @endif
                  @endforeach
                     <div class="col-md-12  Products_col">
                        <h4>عنوان الشحن</h4>
                        @foreach( $historyItems->getAddress('delivery') as $id => $address )
                           <div class="Shipping-goods"> 
                              <div class="icon-Shipping-goods">
                                 <svg xmlns="http://www.w3.org/2000/svg" width="18.893" height="26.33" viewBox="0 0 24.893 29.33">
                                    <g id="Location" transform="translate(1 1)">
                                       <path id="Path_33958" d="M0,11.407a11.446,11.446,0,0,1,22.893.078v.13c-.078,4.109-2.372,7.907-5.185,10.876A30.087,30.087,0,0,1,12.354,26.9a1.387,1.387,0,0,1-1.815,0,29.543,29.543,0,0,1-7.531-7.052A14.648,14.648,0,0,1,0,11.446Z" fill="none" stroke="#525457" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2"/>
                                       <circle id="Ellipse_740" cx="3.669" cy="3.669" r="3.669" transform="translate(7.778 7.959)" fill="none" stroke="#525457" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2"/>
                                    </g>
                                 </svg>
                              </div>
                              <div class="details-Shipping-goods">
                                 <div class="name">{{$address['order.base.address.firstname'] . ' ' . $address['order.base.address.lastname']}}</div>
                                 <div class="number">{{$address['order.base.address.telephone']}}</div>
                                 <div class="addres">
                                    {{-- <img src="{{asset('front/images/icon/pals.png')}}"> --}}
                                    <span>{{aitrans($address->getCountryId(), [], 'country')}}</span>
                                    <span class="shop-addres pr-sa">{{$address['order.base.address.city']}}</span>
                                    <span class="shop-addres pr-sa">{{$address['order.base.address.address1']}}</span>
                                    <span class="shop-addres pr-sa">{{$address['order.base.address.postal']}}</span>
                                 </div>
                              </div>
                           </div>
                        @endforeach
                     </div>
                  </div>
               
            </div>
            <div class="col-md-4">
               <div class="row Pending-col-4">
               <div class="col-12 Pending-users">
                  <h5> اسم المشتري </h5>
                  <div class="row">
                     <div class="col-7"> 
                        <div class="details-Pending-users  details_user_orders">
                           <div class="user-Reviews-img">
                              <img src="<?= DB::table('users')->where('id', $historyItems['order.base.customerid'])->first()->icon ?? '' ?>">
                           </div>
                           <div class="review"> 
                              <div class="user_name">{{$historyItems['order.base.editor']}}</div>
                              <div class="review_date"> <i class="fa fa-map-marker"></i>{{$historyItems->getAddress('delivery')[0]['order.base.address.city']}}</div>
                           </div>
                        </div>
                     </div>
                     <div class="col-5  details_button_orders">
                        
                           @switch($historyItems->getProducts()[0]->getStatusDelivery())
                               @case(-1)
                                 <div class="button-Pending-order">
                                    <button>
                                       في الإنتظار
                                    </button>
                                 </div>
                                 @break 
                              @case(2)
                                 <div class="button-proccess-order">
                                    <button>
                                       قيد التجهيز
                                    </button>
                                 </div>
                              @break 
                              @case(8)
                                 <div class="button-completed-order">
                                    <button>
                                       تم التسليم
                                    </button>
                                 </div>
                              @break
                              @case(4)
                                 <div class="button-completed-order">
                                    <button>
                                       مكتمل
                                    </button>
                                 </div>
                              @break                                  
                           @endswitch

                        
                     </div>
                  </div>
               </div>
               </div>
               <div class="row Pending-col-4">
                  <div class="col-12 Pending-users">
                     <h5>الملخص</h5>
                     <h5>طريقة الدفع</h5>
                     <div class=" payment mb-3">
                        <div class="payment-type2 ">
                           <img src="/front/images/icon/Component 45 – 1.png" width="25" class="mt-1">
                           <span>عند الإستلام</span>
                        </div>
                     </div> 
                     <h5>تاريخ الطلب</h5>
                     <div class="Products-date-time mt-n1 mb-3">
                        <i class="fa fa-calendar"></i> 
                        <span>{{ date('d/m/y h:i A', strtotime($historyItems['order.base.ctime']))}}</span> 
                        {{-- <span class="pr-b">AM10:30</span> --}}
                     </div>
                     <h5>رقم التتبع</h5>
                     <div class="Products-date-time mt-n1 mb-3">
                        <span>#437952</span> 
                     </div> 
                     <h5>حالة الطلب</h5>
                     <div class="Products-date-time mt-n1 mb-3">
                        <span @if($order->getStatusDelivery() == -1)   class="text-success" @endif> تم القبول --------</span> 
                        <span @if($order->getStatusDelivery() == 2)  class="text-success" @endif>قيد التجهيز --------</span> 
                        <span @if($order->getStatusDelivery() == 4)  class="text-success" @endif> الإستلام</span> 
                     </div>
                  </div>
               </div>
               <div class="row Pending-col-4"> 
                  <div class="col-12 Pending-users">
                     <h5>الفاتورة</h5>
                     <hr>
                     <div class="row invoice">
                        <div class="col-12 ">
                           <span>المنتجات</span>
                           <span class="f-left">{{$historyItems->getProducts()->count()}}</span>
                        </div>
                        <div class="col-12 ">
                           <span>إجمالي العناصر</span>
                           <span class="f-left">{{$historyItems->getPrice()['price.value'] . ' ' . aitrans( $historyItems->getPrice()['price.currencyid'], [],'client' )}}</span>
                        </div>
                        <div class="col-12 ">
                           <span>الشحن</span>
                           <span class="f-left text-danger">0</span>
                        </div>
                        <div class="col-12 ">
                           <span>الخصم</span>
                           <span class="f-left text-success ">- {{$historyItems->getPrice()['price.rebate'] . ' ' . aitrans( $historyItems->getPrice()['price.currencyid'], [],'client' )}}</span>
                        </div>
                     </div>
                     <hr>
                     <div class="row ">
                        <div class="col-12 ">
                           <span>المجموع ( {{$historyItems->getProducts()->count()}} عنصر)</span>
                           <span class="f-left total">{{$historyItems->getPrice()['price.value'] . ' ' . aitrans( $historyItems->getPrice()['price.currencyid'], [],'client' )}}</span>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
<?php endif?>










{{-- ------------------------------------------------------------------------------------------------------------------------------ --}}
{{-- ------------------------------------------------------------------------------------------------------------------------------ --}}
{{-- ---------------------------------IF USER-------------------------------------------------------------------------------------- --}}
{{-- ------------------------------------------------------------------------------------------------------------------------------ --}}
{{-- ------------------------------------------------------------------------------------------------------------------------------ --}}
{{-- ------------------------------------------------------------------------------------------------------------------------------ --}}










@if(auth()->user()->merchant == 0)
   <div class="bigen-container-shop "  >
      <div class="container">
         <div class="breadcrumbs">
            <ul>
               <li><a href="{{ airoute('aimeos_home', ['site' => 'default']) }}">الرئيسية</a></li>
               <li><a href="#"><i class="fa fa-angle-left" aria-hidden="true"></i>الملف الشخصي</a></li>
               <li class="active"><a href="#"><i class="fa fa-angle-left" aria-hidden="true"></i>الطلبات</a></li>
            </ul>
         </div>
      </div>
      <div class="container">
         <div class="row">
            <div class="col-md-8">
               <div class="row ">
                  <div class="col-10">
                     <h4>المنتجات</h4>
                  </div>
               </div>
               <div class="row ">  
                  @foreach( $historyItems->getProducts()->groupBy( 'order.base.product.vendor' )->ksort() as $vendor => $list) 
                  <div class="Shop-Shopping-Basket">
                     <div class="product_details_pay_store  my-2">
                        <div class="stor-logo">
                           <img src="<?= DB::table('mshop_locale_site')->where('label', $vendor)->first()->icon?>" style="width: 44px;padding-top: 13px;">
                        </div>
                        <div>
                           <div class="user_name"><?= $vendor?></div>
                        </div>
                     </div>
                  </div>
                  @foreach ($list as $item) 
                     <div class="col-md-12 details_user_Products Products_col justify-content-between"> 
                        <div>
                           <div class="img-Products">
                              <img src="{{'/aimeos/' . $item['order.base.product.mediaurl']}}">
                           </div>
                           <div class="details_Products">
                              <div class="Products_name">{{$item['order.base.product.name']}}</div>
                              <div class="Products_type"> x <?= $item->getQuantity()?> </div>
                              <div class="Products_number">#{{$item['order.base.product.prodcode']}}</div>
                              <div class="Products_price">{{$item['order.base.product.price'] . ' ' . aitrans($item['order.base.product.currencyid'], [],'client' )}}</div>
                              <span></span>
                           </div>
                        </div>
                        <div> 
                           @if($item['order.base.product.statusdelivery'] == -1)
                              <button class="button-order-Cancel" style="display: block;" data-toggle="modal" data-target="#order-refusal-modal" data-baseid="{{$item['order.base.product.baseid']}}" data-id="{{$item['order.base.product.id']}}" data-status="reject">
                                 إلغاء الطلب
                              </button>
                           @endif
                           @if($item['order.base.product.statusdelivery'] == 8)
                              <button class="button-order-refusal mr-2 lost" data-id="<?= $item->getId()?>" data-baseid="<?= $historyItems['order.base.id']?>" data-status="lost" data-toggle="modal" data-target="#order-refusal-modal" style="background-color: #F5F6F6;color:#262626;">
                                 لم أستلم
                              </button>
                              <button class="button-order-accept mr-2 delivered" data-id="<?= $item->getId()?>" data-productid="<?= $item->getProductId()?>" data-baseid="<?= $historyItems['order.base.id']?>" data-status="delivered" data-siteid="<?= $item['order.base.product.siteid']?>">
                              <i class="fa fa-check"></i>
                                 إستلمت
                              </button>
                           @endif
                           @if($item['order.base.product.statusdelivery'] == 2)
                              <div class="button-proccess-order">
                                 <button>
                                    قيد التجهيز
                                 </button>
                              </div>
                           @endif 
                           @if($item['order.base.product.statusdelivery'] == 4)
                              <?= str_repeat('<img src="/front/images/icon/gray-star.svg">', 2)?> 
                              <?= str_repeat('<img src="/front/images/icon/yellow-star.svg">', 3) ?> 
                           @endif
                        </div>
                     </div>
                     @endforeach
                  @endforeach
                     <div class="col-md-12  Products_col">
                        <h4>عنوان الشحن</h4>
                        @foreach( $historyItems->getAddress('delivery') as $id => $address )
                           <div class="Shipping-goods"> 
                              <div class="icon-Shipping-goods">
                                 <svg xmlns="http://www.w3.org/2000/svg" width="18.893" height="26.33" viewBox="0 0 24.893 29.33">
                                    <g id="Location" transform="translate(1 1)">
                                       <path id="Path_33958" d="M0,11.407a11.446,11.446,0,0,1,22.893.078v.13c-.078,4.109-2.372,7.907-5.185,10.876A30.087,30.087,0,0,1,12.354,26.9a1.387,1.387,0,0,1-1.815,0,29.543,29.543,0,0,1-7.531-7.052A14.648,14.648,0,0,1,0,11.446Z" fill="none" stroke="#525457" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2"/>
                                       <circle id="Ellipse_740" cx="3.669" cy="3.669" r="3.669" transform="translate(7.778 7.959)" fill="none" stroke="#525457" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2"/>
                                    </g>
                                 </svg>
                              </div>
                              <div class="details-Shipping-goods">
                                 <div class="name">{{$address['order.base.address.firstname'] . ' ' . $address['order.base.address.lastname']}}</div>
                                 <div class="number">{{$address['order.base.address.telephone']}}</div>
                                 <div class="addres">
                                    {{-- <img src="{{asset('front/images/icon/pals.png')}}"> --}}
                                    <span>{{aitrans($address->getCountryId(), [], 'country')}}</span>
                                    <span class="shop-addres pr-sa">{{$address['order.base.address.city']}}</span>
                                    <span class="shop-addres pr-sa">{{$address['order.base.address.address1']}}</span>
                                    <span class="shop-addres pr-sa">{{$address['order.base.address.postal']}}</span>
                                 </div>
                              </div>
                           </div>
                        @endforeach
                     </div>
               </div>
            </div>
            <div class="col-md-4">
               <div class="row Pending-col-4">
                  <div class="col-12 Pending-users">
                     <h5> اسم التاجر </h5>
                     <?php foreach($historyItems->getProducts()->groupBy('order.base.product.vendor')->ksort() as $vendor => $list) :?>
                        <div class="row"> 
                           <div class="col-7"> 
                              <div class="details-Pending-users  details_user_orders">
                                 <div class="user-Reviews-img"> 
                                    <img src="<?= DB::table('mshop_locale_site')->where('label', $vendor)->first()->icon ?? '' ?>">
                                 </div>
                                 <div class="review">
                                    <div class="user_name">{{$vendor}}</div>
                                    <div class="review_date"> <i class="fa fa-map-marker"></i>غزة</div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-5  ">
                              <div class=" ">
                                 @foreach ($list as $item)
                                    @if($item['order.base.product.statusdelivery'] == 4)
                                       <div class="button-completed-order">
                                          <button>
                                             مكتمل
                                          </button>
                                       </div>
                                       @break
                                    @elseif($item['order.base.product.statusdelivery'] == 8)
                                       <div class="button-completed-order">
                                          <button>
                                             تم التسليم
                                          </button>
                                       </div>
                                       @break
                                    @elseif($item['order.base.product.statusdelivery'] == 2)
                                       <div class="button-proccess-order">
                                          <button>
                                             قيد التجهيز
                                          </button>
                                       </div>
                                       @break
                                    @elseif($item['order.base.product.statusdelivery'] == -1)
                                       <div class="button-Pending-order">
                                          <button>
                                             قيد الإنتظار
                                          </button>
                                       </div> 
                                       @break
                                    @endif 
                                 @endforeach
                              </div>
                           </div>
                        </div>
                     <?php endforeach?>
                  </div>
               </div>
               <div class="row Pending-col-4">
                  <div class="col-12 Pending-users">
                     <h5>الملخص</h5>
                     <h5>طريقة الدفع</h5>
                     <div class=" payment mb-3">
                        <div class="payment-type2 ">
                           <img src="/front/images/icon/Component 45 – 1.png" width="25" class="mt-1">
                           <span>عند الإستلام</span>
                        </div>
                     </div> 
                     <h5>تاريخ الطلب</h5>
                     <div class="Products-date-time mt-n1 mb-3">
                        <i class="fa fa-calendar"></i> 
                        <span>{{date('d/m/y h:i A', strtotime($historyItems['order.base.ctime'] ))}}</span> 
                        {{-- <span class="pr-b">AM10:30</span> --}}
                     </div>
                     <h5>رقم التتبع</h5>
                     <div class="Products-date-time mt-n1 mb-3">
                        <span>#437952</span> 
                     </div> 
                     <h5>حالة الطلب</h5> 
                     <div class="Products-date-time mt-n1 mb-3">
                        <span @if($order->getStatusDelivery() == -1)   class="text-success" @endif> تم القبول --------</span> 
                        <span @if($order->getStatusDelivery() == 2)  class="text-success" @endif>قيد التجهيز --------</span> 
                        <span @if($order->getStatusDelivery() == 4)  class="text-success" @endif> الإستلام</span> 
                     </div>
                  </div>
               </div>
               <div class="row Pending-col-4"> 
                  <div class="col-12 Pending-users">
                     <h5>الفاتورة</h5>
                     <hr>
                     <div class="row invoice">
                        <div class="col-12 ">
                           <span>المنتجات</span>
                           <span class="f-left">{{$historyItems->getProducts()->count()}}</span>
                        </div>
                        <div class="col-12 ">
                           <span>إجمالي العناصر</span>
                           <span class="f-left">{{$historyItems->getPrice()['price.value'] . ' ' . aitrans( $historyItems->getPrice()['price.currencyid'], [],'client' )}}</span>
                        </div>
                        <div class="col-12 ">
                           <span>الشحن</span>
                           <span class="f-left text-danger">0</span>
                        </div>
                        <div class="col-12 ">
                           <span>الخصم</span>
                           <span class="f-left text-success ">- {{$historyItems->getPrice()['price.rebate'] . ' ' . aitrans( $historyItems->getPrice()['price.currencyid'], [],'client' )}}</span>
                        </div>
                     </div>
                     <hr>
                     <div class="row ">
                        <div class="col-12 ">
                           <span>المجموع ( {{$historyItems->getProducts()->count()}} عنصر)</span>
                           <span class="f-left total">{{$historyItems->getPrice()['price.value'] . ' ' . aitrans( $historyItems->getPrice()['price.currencyid'], [],'client' )}}</span>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
<?php endif?>











      <div class="modal fade" id="order-refusal-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered " role="document">
            <form action="" method="post" id="refuse-form">
               <div class="modal-content  ">
                  <div class="modal-header-cust">
                     <h5 class="modal-title" id="exampleModalLongTitle">رفض الطلب</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">
                     <i class="fa fa-times-circle"></i>
                     </span>
                     </button>
                  </div>
                  <div class="modal-body text-center">
                     <div class="form-group text-right  mt-3">
                        <label for="exampleFormControlTextarea1">سبب إلغاء الطلب</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                     </div>
                     <div class="form-group send-masg-shop  font-weight-bold mt-5">
                        <button type="button" class="btn btn-danger"   data-toggle="modal" id="confirm-refuse"   data-id="<?= $historyItems['order.base.id']?>" data-status="6">
                        إرسال
                        <i class="fa fa-paper-plane "></i>
                        </button>
                     </div>
                  </div>
               </div>
            </form>
         </div>
      </div>
      <div class="modal fade" id="order-refusal-success-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered " role="document">
            <div class="modal-content ">
               <div class="modal-header-cust">
                  <h5 class="modal-title" id="exampleModalLongTitle">رفض الطلب</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true" style="display: contents;">
                     <img src="{{asset('front/images/succesfull.gif')}}" alt="" style="width: 200px;">
                  </span>
                  </button>
               </div>
               <div class="modal-body text-center">
                  <div class="pt-5 px-5 font-weight-bold">
                     تم رفض الطلب بنجاح
                  </div>
                  <div class="pb-5 pt-1">
                     إذا كنت تحتاج المساعدة يمكنك التواصل معنا
                  </div>
                  <div class="form-group message-success-btn  font-weight-bold mt-3">
                     <button type="button" class="btn " data-dismiss="modal">
                     موافق
                     </button>
                  </div>
               </div>
            </div>
         </div>
      </div>
		<!-- Modal -->
		<div style="z-index: 9999;" class="modal fade" id="product-review" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header" style="border-bottom: 0 !important;">
						<span class="w-100 mt-5 mr-5" style="text-align: center; font-size: 15px;">تقييــم المنتج</span>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button> 
					</div>
					<form action="" method="POST" id="rating-form">
                  <input type="hidden" value="" id="productid" name="productid">
                  <input type="hidden"  name="siteid" id="siteid">
                  <div style="padding:0px 20px ;">
                     <div>
                     <div class="d-flex justify-content-center" style="height: 100px;">
                        <svg class="d-block" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="250" height="70" viewBox="0 0 369 103">
                           <defs>
                              <clipPath id="clip-path">
                              <rect y="86" width="369" height="103" fill="none"/>
                              </clipPath>
                              <pattern id="pattern" preserveAspectRatio="none" width="100%" height="100%" viewBox="0 0 1440 1080">
                              </pattern>
                           </defs>
                           <g id="Scroll_Group_2" data-name="Scroll Group 2" transform="translate(0 -86)" clip-path="url(#clip-path)" style="isolation: isolate">
                              <rect id="_70705-rating-profiles" data-name="70705-rating-profiles" width="369" height="277" fill="url(#pattern)"/>
                           </g>
                        </svg>
						      <lottie-player class="my-0 welcome-circle " src="{{asset('front/js/rating-profiles.json')}}" style="height: 170px;transform: translate3d(76px, -43px, 0px);"  background="transparent" loop speed="1" autoplay></lottie-player>
                     </div>
                     <div>
                        <div class="rate">
                           <input type="radio" id="star5" name="review_rating" value="5" />
                           <label for="star5" title="text">5 star</label>
                           <input type="radio" id="star4" name="review_rating" value="4" />
                           <label for="star4" title="text">4 stars</label>
                           <input type="radio" id="star3" name="review_rating" value="3" />
                           <label for="star3" title="text">3 stars</label>
                           <input type="radio" id="star2" name="review_rating" value="2" />
                           <label for="star2" title="text">2 stars</label>
                           <input type="radio" id="star1" name="review_rating" value="1" />
                           <label for="star1" title="text">1 stars</label>
                        </div>
                        <!-- newww newwwww -->
                        <label class="d-block">مراجعتك</label>
                        <textarea class="w-100 p-2 " name="review_comment" id="review_comment" style="border: 1px solid #c9c3c3;border-radius: 10px;" rows="7" placeholder="يرجى اخبارنا عن تجربتك"></textarea>
                        <div id="error_msg"></div>
                     </div>
                     </div>
                  </div>
                  <button id="send-product-rating" type="button" style="margin: 20px 20px ; border-radius: 17px; background-color:#BF1F2C ; border: none;" class="btn btn-secondary" data-dismiss="modal">ارسال</button>
					</form>
				</div>
			</div>
		</div>
		<!-- Modal -->
 
@endsection
 
 @section('js')
      <script src="{{asset('front/js/lottie_5.5.0.js')}}"></script>
      <script src="{{asset('front/js/lottie-player.js')}}"></script>
   {{-- @if (auth()->user()->merchant == 1) --}}
         <script>
            $(".accept-order, .button-order-Cancel").click(function(e){
               e.preventDefault();
               $(this).hide();
               $('.button-order-Cancel').show();
               let baseid = $(this).data('baseid');
               let id = $(this).data('id');
               let status = $(this).data('status');
               let url = "{{airoute('front.mrchnt.order.update_status', ['id' => 'ID'])}}";
               $.ajax({
                  type:"POST",
                  url: url.replace('ID', baseid),
                  data:{
                     id:id,
                     baseid:baseid,
                     // code:{{$historyItems->getSiteCode()}},
                     status:status,
                  _token:"{{ csrf_token() }}",
                  },
                  success: function(response) {
                  if(response)
                  {
                     window.location.reload();
                  }
                  }
               });
            });
      </script>
      <script>
         $(".refuse-oder").click(function(e){
            e.preventDefault();
            $(this).hide();
            document.getElementById("refuse-form").reset();
            $('.refuse-oder').hide();
            $('.button-order-Cancel').show();
            let baseid = $(this).data('baseid');
            let id = $(this).data('id');
            let status = $(this).data('status');
            let url = "{{airoute('front.mrchnt.order.update_status', ['id' => 'ID'])}}";
            $.ajax({
               type:"POST",
               url: url.replace('ID', baseid),
               data:{
                  id:id,
                  baseid:baseid,
                  // code:{{$historyItems->getSiteCode()}},
                  status:status,
               _token:"{{ csrf_token() }}",
               },
               success: function(response) {
               if(response)
               {
               }
               }
            });
         });
      </script>
      <script>
            $(".delivered, .lost, .prepared").click(function(e){
               e.preventDefault();
               document.getElementById("refuse-form").reset();
               let baseid = $(this).data('baseid');
               let id = $(this).data('id');
               let status = $(this).data('status');
               let url = "{{airoute('front.mrchnt.order.update_status', ['id' => 'ID'])}}";
               $.ajax({
                  type:"POST",
                  url: url.replace('ID', baseid),
                  data:{
                     id:id,
                     baseid:baseid,
                     status:status,
                  _token:"{{ csrf_token() }}",
                  },
                  success: function(response) {
                  if(response && status !== 'delivered')
                  {
                     setInterval(function(){
                        window.location.reload();
                     }, 500); 
                  }
                  }
               });
            });
      </script>
   {{-- @endif --}}
         <script>
            $("#confirm-refuse").click(function(e){
               e.preventDefault();
               let id = $(this).data('id');
               let status = $(this).data('status');
               let url = "{{route('front.mrchnt.order.update_status', ['id' => 'ID', 'locale' => app()->getLocale()])}}";
               $.ajax({
                  type:"POST",
                  url: url.replace('ID', id),
                  data:{
                     id:id,
                     code:"{{$historyItems->getSiteCode()}}",
                     status:status,
                  _token:"{{ csrf_token() }}",
                  },
                  success: function(response) {
                  if(response)
                  {
                     $('#order-refusal-success-modal').modal('show');
                  }
                  
                  }
               });
               setInterval(function(){
                  window.location = '/{{app()->getLocale()}}/profile/default';
               }, 2000); 
            });
      </script>
      <script>
         $('.delivered').click(function(e){
            e.preventDefault();
            document.getElementById("rating-form").reset();
            $('#product-review').modal('show');
            let productid = $(this).data('productid');
            $('#productid').val(productid);
            let siteid = $(this).data('siteid');
            $('#siteid').val(siteid);
         });
         $('#send-product-rating').click(function(e){
            e.preventDefault();
            let orderid = "{{$historyItems['order.base.id']}}";
            var formData = new FormData(document.getElementById('rating-form'));
            formData.append('orderid' , orderid);
            formData.append('_token' , "{{ csrf_token() }}");
            let url = "{{ route('front.mrchnt.order.product_rating', ['locale'=>'en', 'id' => 'ID']) }}";
            $.ajax({
               type: 'POST',
               url: url.replace('ID', orderid),
               data: formData,
               processData: false,
               contentType: false,
               cache: false,
               success: function (data) {
                  if(data.status == 'success') {
                     window.location.reload();
                  }
                  if(data.status == 'fail'){
                     swal('تقييم المنتج', 'نأسف، لقد تم تقييم المنتج مسبقاً' );
                  }
                  
               }, error: function (reject) {
               }
            });
         });
      </script>
 

 @endsection
