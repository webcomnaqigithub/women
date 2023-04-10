@extends('layouts.mrchnt.layout')
@section('title') الطلبات @endsection
@section('orders')
<div class="tab-pane fade show active" id="Orders" role="tabpanel" aria-labelledby="home-tab">
   <h4>الطلبات</h4>
   <div class="tab_orders">
      <div class="row">
         <div class="col">
            <div class="tabs_container">
               <ul class="tabs d-flex align-items-md-center justify-content-center">
                  <li class="tab active" data-active-tab="tab_Pending_orders"><span>قيد الأنتظار</span></li>
                  <li class="tab" data-active-tab="tab_current_orders"><span>حالية</span></li>
                  <li class="tab" data-active-tab="tab_Completed_orders"><span>مكتملة</span></li>
               </ul>
            </div>
         </div>
      </div>
      <div class="row mx-1 mt-n13">
         <div id="tab_Pending_orders" class="tab_container active">
            <div class="row reviews_col">
               <div class="col-8 details_user_orders"  >
                  <div class="user-Reviews-img">
                     <img src="{{asset('front/images/user.png')}}">
                  </div>
                  <div class="review">
                     <div class="user_name">أمل سالم</div>
                     <div class="review_date"> <i class="fa fa-map-marker"></i>  غزة  </div>
                     <div class="review_date">#437952</div>
                     <div class="review_date">
                        <svg id="box-time" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24">
                           <path id="Vector" d="M9.583,6.613a.746.746,0,0,1-.38-.1L.373,1.4A.753.753,0,0,1,1.133.1l8.45,4.89,8.4-4.86a.761.761,0,0,1,1.03.27.761.761,0,0,1-.27,1.03l-8.77,5.08A.94.94,0,0,1,9.583,6.613Z" transform="translate(2.417 6.687)" fill="#525457"/>
                           <path id="Vector-2" data-name="Vector" d="M.75,10.57A.755.755,0,0,1,0,9.82V.75A.755.755,0,0,1,.75,0,.755.755,0,0,1,1.5.75V9.82A.755.755,0,0,1,.75,10.57Z" transform="translate(11.25 11.79)" fill="#525457"/>
                           <path id="Vector-3" data-name="Vector" d="M10.37,21.51a5,5,0,0,1-2.44-.58L2.59,17.97A5.453,5.453,0,0,1,0,13.58V7.92A5.468,5.468,0,0,1,2.59,3.53L7.93.57a5.486,5.486,0,0,1,4.87,0l5.34,2.96a5.453,5.453,0,0,1,2.59,4.39v5.66a1.243,1.243,0,0,1-.03.3.752.752,0,0,1-1.23.4,3.269,3.269,0,0,0-4.14-.07,3.224,3.224,0,0,0-1.22,2.53,3.169,3.169,0,0,0,.47,1.67,1.966,1.966,0,0,0,.25.35.738.738,0,0,1,.17.62.729.729,0,0,1-.38.52l-1.83,1.01A4.7,4.7,0,0,1,10.37,21.51Zm0-20a3.643,3.643,0,0,0-1.7.38L3.33,4.85A3.99,3.99,0,0,0,1.52,7.92v5.66a4,4,0,0,0,1.81,3.07l5.34,2.96a3.991,3.991,0,0,0,3.41,0l1.12-.62a4.746,4.746,0,0,1,1.21-5.96,4.844,4.844,0,0,1,4.83-.66V7.91a4,4,0,0,0-1.81-3.07L12.09,1.88A3.92,3.92,0,0,0,10.37,1.51Z" transform="translate(1.63 1.24)" fill="#525457"/>
                           <path id="Vector-4" data-name="Vector" d="M4.75,9.5A4.774,4.774,0,1,1,7.88,8.31,4.754,4.754,0,0,1,4.75,9.5Zm0-8a3.25,3.25,0,0,0,0,6.5A3.322,3.322,0,0,0,6.9,7.19,3.252,3.252,0,0,0,4.75,1.5Z" transform="translate(14.25 13.25)" fill="#525457"/>
                           <path id="Vector-5" data-name="Vector" d="M.746,3.75a.747.747,0,0,1-.38-1.39l.89-.53V.75a.75.75,0,0,1,1.5,0v1.5a.751.751,0,0,1-.36.64l-1.25.75A.782.782,0,0,1,.746,3.75Z" transform="translate(17.254 16)" fill="#525457"/>
                           <path id="Vector-6" data-name="Vector" d="M0,0H24V24H0Z" fill="none" opacity="0"/>
                        </svg>
                        17/02/2022
                        <span class="shop-addres pr-sa">AM10:30	</span>
                     </div>
                  </div>
               </div>
               <div class="col-4 details_button_orders"  >
                  <div class="button-Pending-order">
                     <button>
                     <a href="#">
                     قيد الإنتظار
                     </a>
                     </button>
                  </div>
                  <div class="button-details-order  mt-3">
                     <button>
                     تفاصيل
                     </button>
                  </div>
               </div>
            </div>
            <div class="row reviews_col">
               <div class="col-8 details_user_orders"  >
                  <div class="user-Reviews-img">
                     <img src="{{asset('front/images/user.png')}}">
                  </div>
                  <div class="review">
                     <div class="user_name">أمل سالم</div>
                     <div class="review_date"> <i class="fa fa-map-marker"></i>  غزة  </div>
                     <div class="review_date">#437952</div>
                     <div class="review_date">
                        <svg id="box-time" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24">
                           <path id="Vector" d="M9.583,6.613a.746.746,0,0,1-.38-.1L.373,1.4A.753.753,0,0,1,1.133.1l8.45,4.89,8.4-4.86a.761.761,0,0,1,1.03.27.761.761,0,0,1-.27,1.03l-8.77,5.08A.94.94,0,0,1,9.583,6.613Z" transform="translate(2.417 6.687)" fill="#525457"/>
                           <path id="Vector-2" data-name="Vector" d="M.75,10.57A.755.755,0,0,1,0,9.82V.75A.755.755,0,0,1,.75,0,.755.755,0,0,1,1.5.75V9.82A.755.755,0,0,1,.75,10.57Z" transform="translate(11.25 11.79)" fill="#525457"/>
                           <path id="Vector-3" data-name="Vector" d="M10.37,21.51a5,5,0,0,1-2.44-.58L2.59,17.97A5.453,5.453,0,0,1,0,13.58V7.92A5.468,5.468,0,0,1,2.59,3.53L7.93.57a5.486,5.486,0,0,1,4.87,0l5.34,2.96a5.453,5.453,0,0,1,2.59,4.39v5.66a1.243,1.243,0,0,1-.03.3.752.752,0,0,1-1.23.4,3.269,3.269,0,0,0-4.14-.07,3.224,3.224,0,0,0-1.22,2.53,3.169,3.169,0,0,0,.47,1.67,1.966,1.966,0,0,0,.25.35.738.738,0,0,1,.17.62.729.729,0,0,1-.38.52l-1.83,1.01A4.7,4.7,0,0,1,10.37,21.51Zm0-20a3.643,3.643,0,0,0-1.7.38L3.33,4.85A3.99,3.99,0,0,0,1.52,7.92v5.66a4,4,0,0,0,1.81,3.07l5.34,2.96a3.991,3.991,0,0,0,3.41,0l1.12-.62a4.746,4.746,0,0,1,1.21-5.96,4.844,4.844,0,0,1,4.83-.66V7.91a4,4,0,0,0-1.81-3.07L12.09,1.88A3.92,3.92,0,0,0,10.37,1.51Z" transform="translate(1.63 1.24)" fill="#525457"/>
                           <path id="Vector-4" data-name="Vector" d="M4.75,9.5A4.774,4.774,0,1,1,7.88,8.31,4.754,4.754,0,0,1,4.75,9.5Zm0-8a3.25,3.25,0,0,0,0,6.5A3.322,3.322,0,0,0,6.9,7.19,3.252,3.252,0,0,0,4.75,1.5Z" transform="translate(14.25 13.25)" fill="#525457"/>
                           <path id="Vector-5" data-name="Vector" d="M.746,3.75a.747.747,0,0,1-.38-1.39l.89-.53V.75a.75.75,0,0,1,1.5,0v1.5a.751.751,0,0,1-.36.64l-1.25.75A.782.782,0,0,1,.746,3.75Z" transform="translate(17.254 16)" fill="#525457"/>
                           <path id="Vector-6" data-name="Vector" d="M0,0H24V24H0Z" fill="none" opacity="0"/>
                        </svg>
                        17/02/2022
                        <span class="shop-addres pr-sa">AM10:30	</span>
                     </div>
                  </div>
               </div>
               <div class="col-4 details_button_orders"  >
                  <div class="button-Pending-order">
                     <button>
                     قيد الإنتظار
                     </button>
                  </div>
                  <div class="button-details-order  mt-3">
                     <button>
                     تفاصيل
                     </button>
                  </div>
               </div>
            </div>
         </div>
         <div id="tab_current_orders" class="tab_container">
            <div class="row reviews_col">
               <div class="col-8 details_user_orders"  >
                  <div class="user-Reviews-img">
                     <img src="{{asset('front/images/blog_2.jpg')}}">
                  </div>
                  <div class="review">
                     <div class="user_name">أمل سالم</div>
                     <div class="review_date"> <i class="fa fa-map-marker"></i>  غزة  </div>
                     <div class="review_date">#437952</div>
                     <div class="review_date">
                        <svg id="box-time" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24">
                           <path id="Vector" d="M9.583,6.613a.746.746,0,0,1-.38-.1L.373,1.4A.753.753,0,0,1,1.133.1l8.45,4.89,8.4-4.86a.761.761,0,0,1,1.03.27.761.761,0,0,1-.27,1.03l-8.77,5.08A.94.94,0,0,1,9.583,6.613Z" transform="translate(2.417 6.687)" fill="#525457"/>
                           <path id="Vector-2" data-name="Vector" d="M.75,10.57A.755.755,0,0,1,0,9.82V.75A.755.755,0,0,1,.75,0,.755.755,0,0,1,1.5.75V9.82A.755.755,0,0,1,.75,10.57Z" transform="translate(11.25 11.79)" fill="#525457"/>
                           <path id="Vector-3" data-name="Vector" d="M10.37,21.51a5,5,0,0,1-2.44-.58L2.59,17.97A5.453,5.453,0,0,1,0,13.58V7.92A5.468,5.468,0,0,1,2.59,3.53L7.93.57a5.486,5.486,0,0,1,4.87,0l5.34,2.96a5.453,5.453,0,0,1,2.59,4.39v5.66a1.243,1.243,0,0,1-.03.3.752.752,0,0,1-1.23.4,3.269,3.269,0,0,0-4.14-.07,3.224,3.224,0,0,0-1.22,2.53,3.169,3.169,0,0,0,.47,1.67,1.966,1.966,0,0,0,.25.35.738.738,0,0,1,.17.62.729.729,0,0,1-.38.52l-1.83,1.01A4.7,4.7,0,0,1,10.37,21.51Zm0-20a3.643,3.643,0,0,0-1.7.38L3.33,4.85A3.99,3.99,0,0,0,1.52,7.92v5.66a4,4,0,0,0,1.81,3.07l5.34,2.96a3.991,3.991,0,0,0,3.41,0l1.12-.62a4.746,4.746,0,0,1,1.21-5.96,4.844,4.844,0,0,1,4.83-.66V7.91a4,4,0,0,0-1.81-3.07L12.09,1.88A3.92,3.92,0,0,0,10.37,1.51Z" transform="translate(1.63 1.24)" fill="#525457"/>
                           <path id="Vector-4" data-name="Vector" d="M4.75,9.5A4.774,4.774,0,1,1,7.88,8.31,4.754,4.754,0,0,1,4.75,9.5Zm0-8a3.25,3.25,0,0,0,0,6.5A3.322,3.322,0,0,0,6.9,7.19,3.252,3.252,0,0,0,4.75,1.5Z" transform="translate(14.25 13.25)" fill="#525457"/>
                           <path id="Vector-5" data-name="Vector" d="M.746,3.75a.747.747,0,0,1-.38-1.39l.89-.53V.75a.75.75,0,0,1,1.5,0v1.5a.751.751,0,0,1-.36.64l-1.25.75A.782.782,0,0,1,.746,3.75Z" transform="translate(17.254 16)" fill="#525457"/>
                           <path id="Vector-6" data-name="Vector" d="M0,0H24V24H0Z" fill="none" opacity="0"/>
                        </svg>
                        17/02/2022
                        <span class="shop-addres pr-sa">AM10:30	</span>
                     </div>
                  </div>
               </div>
               <div class="col-4 details_button_orders"  >
                  <div class="button-current-order">
                     <button>
                     الطلب الحالي
                     </button>
                  </div>
                  <div class="button-details-order  mt-3">
                     <button>
                     تفاصيل
                     </button>
                  </div>
               </div>
            </div>
            <div class="row reviews_col">
               <div class="col-8 details_user_orders"  >
                  <div class="user-Reviews-img">
                     <img src="{{asset('front/images/User-avatar.png')}}">
                  </div>
                  <div class="review">
                     <div class="user_name">أمل سالم</div>
                     <div class="review_date"> <i class="fa fa-map-marker"></i>  غزة  </div>
                     <div class="review_date">#437952</div>
                     <div class="review_date">
                        <svg id="box-time" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24">
                           <path id="Vector" d="M9.583,6.613a.746.746,0,0,1-.38-.1L.373,1.4A.753.753,0,0,1,1.133.1l8.45,4.89,8.4-4.86a.761.761,0,0,1,1.03.27.761.761,0,0,1-.27,1.03l-8.77,5.08A.94.94,0,0,1,9.583,6.613Z" transform="translate(2.417 6.687)" fill="#525457"/>
                           <path id="Vector-2" data-name="Vector" d="M.75,10.57A.755.755,0,0,1,0,9.82V.75A.755.755,0,0,1,.75,0,.755.755,0,0,1,1.5.75V9.82A.755.755,0,0,1,.75,10.57Z" transform="translate(11.25 11.79)" fill="#525457"/>
                           <path id="Vector-3" data-name="Vector" d="M10.37,21.51a5,5,0,0,1-2.44-.58L2.59,17.97A5.453,5.453,0,0,1,0,13.58V7.92A5.468,5.468,0,0,1,2.59,3.53L7.93.57a5.486,5.486,0,0,1,4.87,0l5.34,2.96a5.453,5.453,0,0,1,2.59,4.39v5.66a1.243,1.243,0,0,1-.03.3.752.752,0,0,1-1.23.4,3.269,3.269,0,0,0-4.14-.07,3.224,3.224,0,0,0-1.22,2.53,3.169,3.169,0,0,0,.47,1.67,1.966,1.966,0,0,0,.25.35.738.738,0,0,1,.17.62.729.729,0,0,1-.38.52l-1.83,1.01A4.7,4.7,0,0,1,10.37,21.51Zm0-20a3.643,3.643,0,0,0-1.7.38L3.33,4.85A3.99,3.99,0,0,0,1.52,7.92v5.66a4,4,0,0,0,1.81,3.07l5.34,2.96a3.991,3.991,0,0,0,3.41,0l1.12-.62a4.746,4.746,0,0,1,1.21-5.96,4.844,4.844,0,0,1,4.83-.66V7.91a4,4,0,0,0-1.81-3.07L12.09,1.88A3.92,3.92,0,0,0,10.37,1.51Z" transform="translate(1.63 1.24)" fill="#525457"/>
                           <path id="Vector-4" data-name="Vector" d="M4.75,9.5A4.774,4.774,0,1,1,7.88,8.31,4.754,4.754,0,0,1,4.75,9.5Zm0-8a3.25,3.25,0,0,0,0,6.5A3.322,3.322,0,0,0,6.9,7.19,3.252,3.252,0,0,0,4.75,1.5Z" transform="translate(14.25 13.25)" fill="#525457"/>
                           <path id="Vector-5" data-name="Vector" d="M.746,3.75a.747.747,0,0,1-.38-1.39l.89-.53V.75a.75.75,0,0,1,1.5,0v1.5a.751.751,0,0,1-.36.64l-1.25.75A.782.782,0,0,1,.746,3.75Z" transform="translate(17.254 16)" fill="#525457"/>
                           <path id="Vector-6" data-name="Vector" d="M0,0H24V24H0Z" fill="none" opacity="0"/>
                        </svg>
                        17/02/2022
                        <span class="shop-addres pr-sa">AM10:30	</span>
                     </div>
                  </div>
               </div>
               <div class="col-4 details_button_orders"  >
                  <div class="button-current-order">
                     <button>
                     الطلب الحالي
                     </button>
                  </div>
                  <div class="button-details-order  mt-3">
                     <button>
                     تفاصيل
                     </button>
                  </div>
               </div>
            </div>
         </div>
         <div id="tab_Completed_orders" class="tab_container">
            <div class="row reviews_col">
               <div class="col-8 details_user_orders"  >
                  <div class="user-Reviews-img">
                     <img src="{{asset('front/images/User-avatar.png')}}">
                  </div>
                  <div class="review">
                     <div class="user_name">أمل سالم</div>
                     <div class="review_date"> <i class="fa fa-map-marker"></i>  غزة  </div>
                     <div class="review_date">#437952</div>
                     <div class="review_date">
                        <svg id="box-time" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24">
                           <path id="Vector" d="M9.583,6.613a.746.746,0,0,1-.38-.1L.373,1.4A.753.753,0,0,1,1.133.1l8.45,4.89,8.4-4.86a.761.761,0,0,1,1.03.27.761.761,0,0,1-.27,1.03l-8.77,5.08A.94.94,0,0,1,9.583,6.613Z" transform="translate(2.417 6.687)" fill="#525457"/>
                           <path id="Vector-2" data-name="Vector" d="M.75,10.57A.755.755,0,0,1,0,9.82V.75A.755.755,0,0,1,.75,0,.755.755,0,0,1,1.5.75V9.82A.755.755,0,0,1,.75,10.57Z" transform="translate(11.25 11.79)" fill="#525457"/>
                           <path id="Vector-3" data-name="Vector" d="M10.37,21.51a5,5,0,0,1-2.44-.58L2.59,17.97A5.453,5.453,0,0,1,0,13.58V7.92A5.468,5.468,0,0,1,2.59,3.53L7.93.57a5.486,5.486,0,0,1,4.87,0l5.34,2.96a5.453,5.453,0,0,1,2.59,4.39v5.66a1.243,1.243,0,0,1-.03.3.752.752,0,0,1-1.23.4,3.269,3.269,0,0,0-4.14-.07,3.224,3.224,0,0,0-1.22,2.53,3.169,3.169,0,0,0,.47,1.67,1.966,1.966,0,0,0,.25.35.738.738,0,0,1,.17.62.729.729,0,0,1-.38.52l-1.83,1.01A4.7,4.7,0,0,1,10.37,21.51Zm0-20a3.643,3.643,0,0,0-1.7.38L3.33,4.85A3.99,3.99,0,0,0,1.52,7.92v5.66a4,4,0,0,0,1.81,3.07l5.34,2.96a3.991,3.991,0,0,0,3.41,0l1.12-.62a4.746,4.746,0,0,1,1.21-5.96,4.844,4.844,0,0,1,4.83-.66V7.91a4,4,0,0,0-1.81-3.07L12.09,1.88A3.92,3.92,0,0,0,10.37,1.51Z" transform="translate(1.63 1.24)" fill="#525457"/>
                           <path id="Vector-4" data-name="Vector" d="M4.75,9.5A4.774,4.774,0,1,1,7.88,8.31,4.754,4.754,0,0,1,4.75,9.5Zm0-8a3.25,3.25,0,0,0,0,6.5A3.322,3.322,0,0,0,6.9,7.19,3.252,3.252,0,0,0,4.75,1.5Z" transform="translate(14.25 13.25)" fill="#525457"/>
                           <path id="Vector-5" data-name="Vector" d="M.746,3.75a.747.747,0,0,1-.38-1.39l.89-.53V.75a.75.75,0,0,1,1.5,0v1.5a.751.751,0,0,1-.36.64l-1.25.75A.782.782,0,0,1,.746,3.75Z" transform="translate(17.254 16)" fill="#525457"/>
                           <path id="Vector-6" data-name="Vector" d="M0,0H24V24H0Z" fill="none" opacity="0"/>
                        </svg>
                        17/02/2022
                        <span class="shop-addres pr-sa">AM10:30	</span>
                     </div>
                  </div>
               </div>
               <div class="col-4 details_button_orders"  >
                  <div class="button-Completed-order">
                     <button>
                     الطلب الحالي
                     </button>
                  </div>
                  <div class="button-details-order  mt-3">
                     <button>
                     تفاصيل
                     </button>
                  </div>
               </div>
            </div>
            <div class="row reviews_col">
               <div class="col-8 details_user_orders"  >
                  <div class="user-Reviews-img">
                     <img src="{{asset('front/images/single_2_thumb.jpg')}}">
                  </div>
                  <div class="review">
                     <div class="user_name">أمل سالم</div>
                     <div class="review_date"> <i class="fa fa-map-marker"></i>  غزة  </div>
                     <div class="review_date">#437952</div>
                     <div class="review_date">
                        <svg id="box-time" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24">
                           <path id="Vector" d="M9.583,6.613a.746.746,0,0,1-.38-.1L.373,1.4A.753.753,0,0,1,1.133.1l8.45,4.89,8.4-4.86a.761.761,0,0,1,1.03.27.761.761,0,0,1-.27,1.03l-8.77,5.08A.94.94,0,0,1,9.583,6.613Z" transform="translate(2.417 6.687)" fill="#525457"/>
                           <path id="Vector-2" data-name="Vector" d="M.75,10.57A.755.755,0,0,1,0,9.82V.75A.755.755,0,0,1,.75,0,.755.755,0,0,1,1.5.75V9.82A.755.755,0,0,1,.75,10.57Z" transform="translate(11.25 11.79)" fill="#525457"/>
                           <path id="Vector-3" data-name="Vector" d="M10.37,21.51a5,5,0,0,1-2.44-.58L2.59,17.97A5.453,5.453,0,0,1,0,13.58V7.92A5.468,5.468,0,0,1,2.59,3.53L7.93.57a5.486,5.486,0,0,1,4.87,0l5.34,2.96a5.453,5.453,0,0,1,2.59,4.39v5.66a1.243,1.243,0,0,1-.03.3.752.752,0,0,1-1.23.4,3.269,3.269,0,0,0-4.14-.07,3.224,3.224,0,0,0-1.22,2.53,3.169,3.169,0,0,0,.47,1.67,1.966,1.966,0,0,0,.25.35.738.738,0,0,1,.17.62.729.729,0,0,1-.38.52l-1.83,1.01A4.7,4.7,0,0,1,10.37,21.51Zm0-20a3.643,3.643,0,0,0-1.7.38L3.33,4.85A3.99,3.99,0,0,0,1.52,7.92v5.66a4,4,0,0,0,1.81,3.07l5.34,2.96a3.991,3.991,0,0,0,3.41,0l1.12-.62a4.746,4.746,0,0,1,1.21-5.96,4.844,4.844,0,0,1,4.83-.66V7.91a4,4,0,0,0-1.81-3.07L12.09,1.88A3.92,3.92,0,0,0,10.37,1.51Z" transform="translate(1.63 1.24)" fill="#525457"/>
                           <path id="Vector-4" data-name="Vector" d="M4.75,9.5A4.774,4.774,0,1,1,7.88,8.31,4.754,4.754,0,0,1,4.75,9.5Zm0-8a3.25,3.25,0,0,0,0,6.5A3.322,3.322,0,0,0,6.9,7.19,3.252,3.252,0,0,0,4.75,1.5Z" transform="translate(14.25 13.25)" fill="#525457"/>
                           <path id="Vector-5" data-name="Vector" d="M.746,3.75a.747.747,0,0,1-.38-1.39l.89-.53V.75a.75.75,0,0,1,1.5,0v1.5a.751.751,0,0,1-.36.64l-1.25.75A.782.782,0,0,1,.746,3.75Z" transform="translate(17.254 16)" fill="#525457"/>
                           <path id="Vector-6" data-name="Vector" d="M0,0H24V24H0Z" fill="none" opacity="0"/>
                        </svg>
                        17/02/2022
                        <span class="shop-addres pr-sa">AM10:30	</span>
                     </div>
                  </div>
               </div>
               <div class="col-4 details_button_orders"  >
                  <div class="button-Completed-order">
                     <button>
                     الطلب الحالي
                     </button>
                  </div>
                  <div class="button-details-order  mt-3">
                     <button>
                     تفاصيل
                     </button>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection