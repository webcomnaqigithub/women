@extends('layouts.front_master')
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('front/js/plugins/jquery-ui-1.12.1.custom/jquery-ui.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('front/styles/single_styles.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('front/styles/single_responsive.css')}}">
@endsection
@section('content')
<div class="bigen-container-shop-data "  >
   <!-- Breadcrumbs -->
   <div class="container">
      <div class="breadcrumbs ">
         <ul>
            <li><a href="{{ airoute('aimeos_home', ['site' => 'default']) }}">الرئيسية</a></li>
            <li class="active"><a href="#"><i class="fa fa-angle-left" aria-hidden="true"></i>المتاجر</a></li>
            {{-- <li class="active"><a href="#"><i class="fa fa-angle-left" aria-hidden="true"></i>متجر</a></li> --}}
         </ul>
      </div>
   </div>
   <!--  shop profile-->
   <div class="container ">
      <div class="row shop-profile">
         <div class="col">
            <img src="{{$user->profile_pic}}" class="cover-store">
         </div>
      </div>
      <div class="row mt-20px ">
         <div class="col-md-6 shop-profile-deital">
            <div class="logo-shop">
               <img src="{{$store[$user->id]->getIcon()}}"  >
            </div>
            <div class="shop_details">
               <div class="shop-title">{{$store[$user->id]->getLabel()}}</div>
               <div class="shop-sub-title">{{$user->brief ?? ''}}</div>
               <div class="shop-sub-title">
                  <span class="fa fa-map-marker"></span>
                  <span class="shop-addres ">{{$user->city}} - {{$user->state}}</span>
                  <span class="shop-addres pr-sa">تم بيع 1998</span>
                  <span class="shop-addres pr-sa">
                  <i class="star_rating fa fa-star"></i>
                  {{$user->rating ?? ''}}</span>
                  <span class="shop-addres pr-sa">إنضم في {{ date("Y-M-d",strtotime($user->created_at))}}	</span>
               </div>
            </div>
         </div>
         <div class="col-lg-6 shop-profile-btn " >
            <div class="mt-10px">
               <button class="btn btn-outline-light cursor-pointer round mt-n13" data-toggle="modal" data-target="#send-masg">
               <i class="fa fa-envelope"></i> تواصل مع المتجر
               </button>
               <div class="btn-add-favorit   round mt-n13">
                  <i class="fa fa-heart-o cursor-pointer">
                  </i> إضف للمفضلة (23)
               </div>
            </div>
         </div>
      </div>
   </div>
   <!--  shop tap-->
   <div class="tabs_section_container">
      <div class="container">
         <div class="row">
            <div class="col">
               <div class="tabs_container">
                  <ul class="tabs d-flex align-items-md-center justify-content-center">
                     <li class="tab active" data-active-tab="tab_1"><span>العناصر</span></li>
                     <li class="tab" data-active-tab="tab_2"><span>المراجعات (15)</span></li>
                     <li class="tab" data-active-tab="tab_3"><span>نبذة</span></li>
                  </ul>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col mt-n13">
               <!-- Tab Description -->
               <div id="tab_1" class="tab_container active">
                  <div class="row ">
                     <div class="col-lg-12 d-flex justify-content-end">
                        <ul class="product_sorting">
                           <li>
                              <span class="type_sorting_text">ترتيب حسب</span>
                              <i class="fa fa-angle-down"></i>
                              <ul class="sorting_type">
                                 <li class="type_sorting_btn" data-isotope-option="{ &quot;sortBy&quot;: &quot;original-order&quot; }"><span>العناصر</span></li>
                                 <li class="type_sorting_btn" data-isotope-option="{ &quot;sortBy&quot;: &quot;price&quot; }"><span>السعر</span></li>
                                 <li class="type_sorting_btn" data-isotope-option="{ &quot;sortBy&quot;: &quot;name&quot; }"><span>المنتج</span></li>
                              </ul>
                           </li>
                        </ul>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-lg-3">
                        <div class="sidebar">
                           <!-- Elements -->
                           <div class="row ">
                              <div class="sidebar_section">
                                 <div class="row ">
                                    <span class=" col-9  sidebar_title">
                                       <h5>العناصر</h5>
                                    </span>
                                 </div>
                                 <ul class="checkboxes">
                                    <li><i class="fa fa-square-o" aria-hidden="true"></i><span>حقائب</span></li>
                                    <li class="active"><i class="fa fa-square" aria-hidden="true"></i><span>تقيم المنتج</span></li>
                                    <li><i class="fa fa-square-o" aria-hidden="true"></i><span>نقيم البائع</span></li>
                                    <li><i class="fa fa-square-o" aria-hidden="true"></i><span>السعر</span></li>
                                    <li class="">
                                       <div class="d-flex price">
                                          <input type="text" class="input-price form-control " placeholder="من">
                                          <span class="px-2"> --  </span>
                                          <input type="text" class="input-price form-control" placeholder="الى">
                                       </div>
                                    </li>
                                 </ul>
                              </div>
                           </div>
                           <!-- SEctions -->
                           <div class="row ">
                              <div class="sidebar_section">
                                 <div class="row ">
                                    <span class="col-9 d-flex justify-content-start sidebar_title">
                                       <h5>الأقسام</h5>
                                    </span>
                                    <span class="col-3 d-flex justify-content-end">
                                    <i class="fa fa-angle-up"></i>
                                    </span>
                                 </div>
                                 <ul class="checkboxes ">
                                    <li><i class="fa fa-square-o" aria-hidden="true"></i> 
                                       <span>الكل</span><span class="f-left">1200</span>
                                    </li>
                                    <li><i class="fa fa-square-o" aria-hidden="true"></i> 
                                       <span>الثوب الفلسطيني</span><span class="f-left">20</span>
                                    </li>
                                    <li><i class="fa fa-square-o" aria-hidden="true"></i> 
                                       <span>حقائب</span><span class="f-left">5</span>
                                    </li>
                                    <li><i class="fa fa-square-o" aria-hidden="true"></i> 
                                       <span>ملابس</span><span class="f-left">55</span>
                                    </li>
                                    <li><i class="fa fa-square-o" aria-hidden="true"></i> 
                                       <span>الفستان</span><span class="f-left">14</span>
                                    </li>
                                 </ul>
                              </div>
                           </div>
                           <!-- Color -->
                           <div class="row mb-4">
                              <div class="sidebar_section">
                                 <div class="row ">
                                    <span class="col-9 d-flex justify-content-start sidebar_title">
                                       <h5>الألوان</h5>
                                    </span>
                                    <span class="col-3 d-flex justify-content-end">
                                    <i class="fa fa-angle-up"></i>
                                    </span>
                                 </div>
                                 <div class="d-flex">
                                    <label class="color-group" title="red">
                                    <input type="checkbox">
                                    <span class="checkmark color-red"></span>
                                    </label>
                                    <label class="color-group" title="orange">
                                    <input type="checkbox" >
                                    <span class="checkmark color-orange"></span>
                                    </label>
                                    <label class="color-group" title="purple">
                                    <input type="checkbox">
                                    <span class="checkmark color-black"></span>
                                    </label>
                                    <label class="color-group" title="purple">
                                    <input type="checkbox">
                                    <span class="checkmark color-purple"></span>
                                    </label>
                                    <label class="color-group" title="blue">
                                    <input type="checkbox" >
                                    <span class="checkmark color-blue"></span>
                                    </label>
                                    <label class="color-group" title="green">
                                    <input type="checkbox" >
                                    <span class="checkmark color-green"></span>
                                    </label>
                                 </div>
                              </div>
                           </div>
                           <!-- discount -->
                           <div class="row ">
                              <div class="sidebar_section">
                                 <div class="row ">
                                    <span class="show_more col-9 d-flex justify-content-start sidebar_title">
                                       <h5>نسبة التخفيضات</h5>
                                    </span>
                                    <span class="col-3 d-flex justify-content-end">
                                    <i class="fa fa-angle-down"></i>
                                    </span>
                                 </div>
                                 <ul class="checkboxes checkboxes-list">
                                    <li><i class="fa fa-square-o" aria-hidden="true"></i> 
                                       <span>1111</span>
                                    </li>
                                    <li><i class="fa fa-square-o" aria-hidden="true"></i> 
                                       <span>22222</span>
                                    </li>
                                 </ul>
                              </div>
                           </div>
                           <!-- size -->
                           <div class="row ">
                              <div class="sidebar_section">
                                 <div class="row ">
                                    <span class="col-9 d-flex justify-content-start sidebar_title">
                                       <h5>المقاس</h5>
                                    </span>
                                    <span class="col-3 d-flex justify-content-end">
                                    <i class="fa fa-angle-down"></i>
                                    </span>
                                 </div>
                                 <ul class="checkboxes ">
                                    <!-- <li><i class="fa fa-square-o" aria-hidden="true"></i> 
                                       <span>1111</span>
                                       </li> -->
                                 </ul>
                              </div>
                           </div>
                           <!-- Shipping Methods -->
                           <div class="row ">
                              <div class="sidebar_section">
                                 <div class="row ">
                                    <span class="col-9 d-flex justify-content-start sidebar_title">
                                       <h5>طرق الشحن</h5>
                                    </span>
                                    <span class="col-3 d-flex justify-content-end">
                                    <i class="fa fa-angle-down"></i>
                                    </span>
                                 </div>
                                 <ul class="checkboxes ">
                                    <!-- <li><i class="fa fa-square-o" aria-hidden="true"></i> 
                                       <span>1111</span>
                                       </li> -->
                                 </ul>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-lg-9">
                        <div class="row mt-3">
                           <div class="col-lg-4 mb-5 store-categories">
                              <div class="store-categories-details">
                                 <div class="store-categories-img">
                                    <img src="{{asset('front/images/sa.png')}}">
                                 </div>
                                 <div class="favorite favorite_left"></div>
                                 <div class="product_info l-h-product-info">
                                    <div class="row " >
                                       <div class="col-6">
                                          <div class=" text-right">
                                             <span>الأثواب</span>
                                          </div>
                                       </div>
                                       <div class="col-6">
                                          <div class=" text-left">
                                             <i class="star_rating fa fa-star" aria-hidden="true"></i> <span>  4.9</span>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="row" >
                                       <div class="col-12 product_title text-right">
                                          ثوب فلسطيني
                                       </div>
                                    </div>
                                    <div class="row " >
                                       <div class="col-7">
                                          <div class="product_price text-right">
                                             $520.00		<span> $590.00 </span> 
                                          </div>
                                       </div>
                                       <div class="col-5 text-left">
                                          <div class="product_bubble_decount ">
                                             خصم 20%
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-lg-4 mb-5 store-categories">
                              <div class="store-categories-details">
                                 <div class="store-categories-img">
                                    <img src="{{asset('front/images/sa.png')}}">
                                 </div>
                                 <div class="favorite favorite_left"></div>
                                 <div class="product_info l-h-product-info">
                                    <div class="row " >
                                       <div class="col-6">
                                          <div class=" text-right">
                                             <span>الأثواب</span>
                                          </div>
                                       </div>
                                       <div class="col-6">
                                          <div class=" text-left">
                                             <i class="star_rating fa fa-star" aria-hidden="true"></i> <span>  4.9</span>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="row" >
                                       <div class="col-12 product_title text-right">
                                          ثوب فلسطيني
                                       </div>
                                    </div>
                                    <div class="row " >
                                       <div class="col-7">
                                          <div class="product_price text-right">
                                             $520.00		<span> $590.00 </span> 
                                          </div>
                                       </div>
                                       <div class="col-5 text-left">
                                          <div class="product_bubble_decount ">
                                             خصم 20%
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-lg-4 mb-5 store-categories">
                              <div class="store-categories-details">
                                 <div class="store-categories-img">
                                    <img src="{{asset('front/images/sa.png')}}">
                                 </div>
                                 <div class="favorite favorite_left"></div>
                                 <div class="product_info l-h-product-info">
                                    <div class="row " >
                                       <div class="col-6">
                                          <div class=" text-right">
                                             <span>الأثواب</span>
                                          </div>
                                       </div>
                                       <div class="col-6">
                                          <div class=" text-left">
                                             <i class="star_rating fa fa-star" aria-hidden="true"></i> <span>  4.9</span>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="row" >
                                       <div class="col-12 product_title text-right">
                                          ثوب فلسطيني
                                       </div>
                                    </div>
                                    <div class="row " >
                                       <div class="col-7">
                                          <div class="product_price text-right">
                                             $520.00		<span> $590.00 </span> 
                                          </div>
                                       </div>
                                       <div class="col-5 text-left">
                                          <div class="product_bubble_decount ">
                                             خصم 20%
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-lg-4 mb-5 store-categories">
                              <div class="store-categories-details">
                                 <div class="store-categories-img">
                                    <img src="{{asset('front/images/sa.png')}}">
                                 </div>
                                 <div class="favorite favorite_left"></div>
                                 <div class="product_info l-h-product-info">
                                    <div class="row " >
                                       <div class="col-6">
                                          <div class=" text-right">
                                             <span>الأثواب</span>
                                          </div>
                                       </div>
                                       <div class="col-6">
                                          <div class=" text-left">
                                             <i class="star_rating fa fa-star" aria-hidden="true"></i> <span>  4.9</span>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="row" >
                                       <div class="col-12 product_title text-right">
                                          ثوب فلسطيني
                                       </div>
                                    </div>
                                    <div class="row " >
                                       <div class="col-7">
                                          <div class="product_price text-right">
                                             $520.00		<span> $590.00 </span> 
                                          </div>
                                       </div>
                                       <div class="col-5 text-left">
                                          <div class="product_bubble_decount ">
                                             خصم 20%
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-lg-4 mb-5 store-categories">
                              <div class="store-categories-details">
                                 <div class="store-categories-img">
                                    <img src="{{asset('front/images/sa.png')}}">
                                 </div>
                                 <div class="favorite favorite_left"></div>
                                 <div class="product_info l-h-product-info">
                                    <div class="row " >
                                       <div class="col-6">
                                          <div class=" text-right">
                                             <span>الأثواب</span>
                                          </div>
                                       </div>
                                       <div class="col-6">
                                          <div class=" text-left">
                                             <i class="star_rating fa fa-star" aria-hidden="true"></i> <span>  4.9</span>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="row" >
                                       <div class="col-12 product_title text-right">
                                          ثوب فلسطيني
                                       </div>
                                    </div>
                                    <div class="row " >
                                       <div class="col-7">
                                          <div class="product_price text-right">
                                             $520.00		<span> $590.00 </span> 
                                          </div>
                                       </div>
                                       <div class="col-5 text-left">
                                          <div class="product_bubble_decount ">
                                             خصم 20%
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-lg-4 mb-5 store-categories">
                              <div class="store-categories-details">
                                 <div class="store-categories-img">
                                    <img src="{{asset('front/images/sa.png')}}">
                                 </div>
                                 <div class="favorite favorite_left"></div>
                                 <div class="product_info l-h-product-info">
                                    <div class="row " >
                                       <div class="col-6">
                                          <div class=" text-right">
                                             <span>الأثواب</span>
                                          </div>
                                       </div>
                                       <div class="col-6">
                                          <div class=" text-left">
                                             <i class="star_rating fa fa-star" aria-hidden="true"></i> <span>  4.9</span>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="row" >
                                       <div class="col-12 product_title text-right">
                                          ثوب فلسطيني
                                       </div>
                                    </div>
                                    <div class="row " >
                                       <div class="col-7">
                                          <div class="product_price text-right">
                                             $520.00		<span> $590.00 </span> 
                                          </div>
                                       </div>
                                       <div class="col-5 text-left">
                                          <div class="product_bubble_decount ">
                                             خصم 20%
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- Tab Additional Info -->
               </div>
               <div id="tab_2" class="tab_container">
                  <div class="row ">
                     <div class="col-lg-6 d-flex justify-content-start">
                        <h4>0 المراجعات</h4>
                     </div>
                     <div class="row mt-10px">
                        <!-- User Reviews -->
                        <div class="col-12 reviews_col">
                           <div class="user_review_container d-flex ">
                              <div class="user-Reviews-img">
                                 <img src="{{asset('front/images/user.png')}}">
                              </div>
                              <div class="review">
                                 <div class="user_name">فاطمة خلود</div>
                                 <div class="review_date">27 Aug 2016</div>
                                 <div class="review-word">جودة مذهلة! تبدو أفضل من الصورة! جميلة جدا وناعمة والشحن كان سريعا! وحصلت على ملاحظة خطية جميلة! بالتأكيد أوصي بهم!.</div>
                              </div>
                           </div>
                        </div>
                        <div class="col-12 reviews_col">
                           <div class="user_review_container d-flex ">
                              <div class="user-Reviews-img">
                                 <img src="{{asset('front/images/user.png')}}">
                              </div>
                              <div class="review">
                                 <div class="user_name">فاطمة خلود</div>
                                 <div class="review_date">27 Aug 2016</div>
                                 <div class="review-word">جودة مذهلة! تبدو أفضل من الصورة! جميلة جدا وناعمة والشحن كان سريعا! وحصلت على ملاحظة خطية جميلة! بالتأكيد أوصي بهم!.</div>
                              </div>
                           </div>
                        </div>
                        <div class="col-12 reviews_col">
                           <div class="user_review_container d-flex ">
                              <div class="user-Reviews-img">
                                 <img src="{{asset('front/images/user.png')}}">
                              </div>
                              <div class="review">
                                 <div class="user_name">فاطمة خلود</div>
                                 <div class="review_date">27 Aug 2016</div>
                                 <div class="review-word">جودة مذهلة! تبدو أفضل من الصورة! جميلة جدا وناعمة والشحن كان سريعا! وحصلت على ملاحظة خطية جميلة! بالتأكيد أوصي بهم!.</div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- Tab Reviews -->
               <div id="tab_3" class="tab_container">
                  <div class="row About">
                     <div class="col-lg-4 mb-3 ">
                        <div class="About-img">
                           <img src="{{asset('front/images/nb1.png')}}">
                        </div>
                     </div>
                     <div class="col-lg-4 mb-3">
                        <div class="About-img">
                           <img src="{{asset('front/images/nb2.png')}}">
                        </div>
                     </div>
                     <div class="col-lg-4 mb-3">
                        <div class="About-img">
                           <img src="{{asset('front/images/nb3.png')}}">
                        </div>
                     </div>
                  </div>
                  <div class="row About-dital">
                     <div class="col-lg-7">{{$user->summary}}</div>
                  </div>
                  <div class="row About-More">
                  </div>
                  <div class="row">
                     <div class="col-lg-7 text-center">
                        <button class="btn  btn-About-More  btn-outline-light cursor-pointer round">
                        المزيد
                        </button>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-lg-7">
                        <h4>تابعنا</h4>
                        <div class="social-media d-flex">
                           <a href="https://www.facebook.com/sharer/sharer.php?u=<?= url()->current() ?>&display=popup" class="btn ml-4 btn-About-facebook  btn-outline-light cursor-pointer round">
                              <i class="fa fa-facebook"></i>
                                  فيس بوك
                              </button>
                           <button class="btn  ml-4 btn-About-instagram  btn-outline-light cursor-pointer round">
                           <i class="fa fa-instagram"></i>
                           واتس أب
                           </button>
                           <button class="btn  ml-4 btn-About-twitter  btn-outline-light cursor-pointer round">
                           <i class="fa fa-twitter"></i>
                           واتس أب
                           </button>
                           <button class="btn ml-4  btn-About-whatsapp  btn-outline-light cursor-pointer round">
                           <i class="fa fa-whatsapp"></i>
                           واتس أب
                           </button>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="modal fade" id="send-masg" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered " role="document">
         <div class="modal-content ">
            <div class="modal-header-cust">
               <h5 class="modal-title" id="exampleModalLongTitle">تواصل مع المتجر</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">
               <i class="fa fa-times-circle"></i>
               </span>
               </button>
            </div>
            <div class="modal-body text-center">
               <div class="d-flex justify-content-center">
                  <div class="logo-shop-modal">
                     <img src="{{$store[$user->id]->getIcon()}}"  >  
                  </div>
               </div>
               <div class="mt-2">
                  <div>{{$store[$user->id]->getLabel()}}</div>
                  <div>
                     <span class="fa fa-map-marker"></span>
                     <span class=" ">{{$user->city}} - {{$user->state}}</span>
                  </div>
               </div>
               <div class="form-group text-right font-weight-bold mt-3">
                  <label for="exampleFormControlTextarea1">الرسالة</label>
                  <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
               </div>
               <div class="form-group send-masg-shop  font-weight-bold mt-5">
                  <button type="button" class="btn btn-danger" data-dismiss="modal"   data-toggle="modal" data-target="#message-success">
                  إرسال
                  <i class="fa fa-paper-plane "></i>
                  </button>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="modal fade" id="message-success" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered " role="document">
         <div class="modal-content ">
            <div class="modal-header-cust">
               <h5 class="modal-title" id="exampleModalLongTitle">تواصل مع المتجر</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">
               <i class="fa fa-times-circle"></i>
               </span>
               </button>
            </div>
            <div class="modal-body text-center">
               <div class="pt-5 px-5 font-weight-bold">
                  تم إرسال رسالتك بنجاح
               </div>
               <div class="pb-5 pt-1">
                  سيتم الرد عليك بأقرب وقت ممكن شكراً لك
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
</div>
@endsection
@section('js')
<script src="{{asset('front/js/plugins/jquery-ui-1.12.1.custom/jquery-ui.js')}}"></script>
<script src="{{asset('front/js/single_custom.js')}}"></script>
<script src="{{asset('front/js/categories_custom.js')}}"></script>
@endsection