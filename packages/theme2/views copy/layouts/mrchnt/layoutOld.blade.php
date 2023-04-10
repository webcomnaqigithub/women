
@extends('layouts.front_master')
@section('content')
         <!-- container  -->
         <div class="bigen-container-shop-data"  style="margin-bottom: 12rem;">
            <!-- Breadcrumbs -->
            <div class="container">
               <div class="breadcrumbs">
                  <ul>
                     <li><a href="{{ airoute('aimeos_home', ['site' => 'default']) }}">الرئيسية</a></li>
                     <li><a href="/{{app()->getLocale()}}/profile/{{app('aimeos.context')->get()->locale()->getSiteItem()->getCode()}}"><i class="fa fa-angle-left" aria-hidden="true"></i>الملف الشخصي</a></li>
                  </ul>
               </div>
            </div>
            <!--  shop profile-->
            <div class="container">
               <div >
                  <img src="{{asset('front/images/ov.png')}}" alt="Avatar" class="image" style="width:100%">
                  <div class="overlay">
                     <div class="text">
                        <label  class="image-upload">
                        <i class="fa fa-camera"></i>						
                        </label>
                     </div>
                     <div class="text">
                        <button class="btn btn-sm btn-white">تغير الصورة</button>
                     </div>
                  </div>
               </div>
               <div class="row  mt-20px bg-shop-profile">
                  <div class="col-md-6 shop-profile-deital">
                     <div class="logo-shop">
                        <img src="{{$site->getIcon()}}"  >
                     </div>
                     <div class="shop_details">
                        <div class="shop-title">{{$site->getLabel()}}</div>
                        <div class="shop-sub-title">
                           <span class="fa fa-map-marker"></span>
                           <span class="shop-addres">{{$mrchnt_profile->city . ' - ' .  $mrchnt_profile->state}}</span>
                           <span class="shop-addres pr-sa">
                           <i class="star_rating fa fa-star"></i>
                           4.9</span>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-6 shop-profile-btn">
                     <div class="mt-10px">
                        <form action="{{ airoute('logout') }}" method="POST">
                           @csrf
                           <button type="submit" class="btn-add-favorit round mt-n13">
                              تسجيل الخروج
                           </button>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
            <div class="container mt-3 mb-5">
               <div class="row">
                  <div class="col-md-3">
                     <div class="ratings">
                        <div class="text-right">
                           <img src="{{asset('front/images/icon/time.png')}}">
                           <span class="title">المنتجات في المخزن</span>
                        </div>
                        <div class="totle"> {{$products_number}}</div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="ratings">
                        <div class="text-right">
                           <img src="{{asset('front/images/icon/truck.png')}}">
                           <span class="title">منتجات قيد التوصيل</span>
                        </div>
                        <div class="totle"> 120</div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="ratings">
                        <div class="text-right">
                           <img src="{{asset('front/images/icon/complete.png')}}">
                           <span class="title">الطلبات مكتملة</span>
                        </div>
                        <div class="totle"> 120</div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="ratings">
                        <div class="text-right">
                           <img src="{{asset('front/images/icon/current.png')}}">
                           <span class="title">الرصيد الحالي</span>
                        </div>
                        <div class="totle"> 120</div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="container">
               <div class="row">
                  <div class="col-md-2">
                     <ul class="tab-section nav nav-pills flex-column" id="myTab" role="tablist">
                        <li class="nav-item">
                           <a class="nav-link active li-radius-top d-flex" href="{{airoute('front.mrchnt.order')}}" role="tab" aria-controls="Orders" aria-selected="true">
                              <div class="icon">
                                 <svg   xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                                    <g   id="bag-timer" transform="translate(-364 -188)">
                                       <path  id="Vector" d="M16.8,6.962a4.625,4.625,0,0,0-3.08-1.32v-.76A4.891,4.891,0,0,0,8.363.022a5.147,5.147,0,0,0-4.4,5.04v.58a4.625,4.625,0,0,0-3.08,1.32,4.4,4.4,0,0,0-.83,3.52l.7,5.57c.21,1.95,1,3.95,5.3,3.95h5.58c4.3,0,5.09-2,5.3-3.94l.7-5.59A4.383,4.383,0,0,0,16.8,6.962ZM8.5,1.412a3.485,3.485,0,0,1,3.83,3.47v.7H5.353v-.52A3.761,3.761,0,0,1,8.5,1.412Zm.34,15.17a3.79,3.79,0,1,1,3.79-3.79A3.794,3.794,0,0,1,8.843,16.582Z" transform="translate(367.156 189.998)" fill="#fff"/>
                                       <path id="Vector-2" data-name="Vector" d="M.746,3.75a.747.747,0,0,1-.38-1.39l.89-.53V.75A.755.755,0,0,1,2.006,0a.741.741,0,0,1,.74.75v1.5a.751.751,0,0,1-.36.64l-1.25.75A.794.794,0,0,1,.746,3.75Z" transform="translate(374.254 200.83)" fill="#fff"/>
                                       <path id="Vector-3" data-name="Vector" d="M0,0H24V24H0Z" transform="translate(388 212) rotate(180)" fill="none" opacity="0"/>
                                    </g>
                                 </svg>
                              </div>
                              <span class="mt-2 mr-2">الطلبات</span>
                           </a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link d-flex" href="{{airoute('front.mrchnt.product')}}" role="tab" aria-controls="home" aria-selected="true">
                              <div class="icon">
                                 <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20.81 21.13">
                                    <path id="Vector" d="M20.789,7.02,20.5,4.25C20.079,1.23,18.709,0,15.779,0H5.019C2.079,0,.719,1.23.289,4.28L.019,7.03a4.11,4.11,0,0,0,.82,2.92,4.01,4.01,0,0,0,3.23,1.55A4.093,4.093,0,0,0,7.3,9.86a3.815,3.815,0,0,0,6.24.04,4.1,4.1,0,0,0,3.2,1.6,3.982,3.982,0,0,0,3.28-1.63A4.072,4.072,0,0,0,20.789,7.02Z" fill="#525457"/>
                                    <path id="Vector-2" data-name="Vector" d="M18.74,1.82V4.8a5,5,0,0,1-5,5,.491.491,0,0,1-.49-.49V6.92A3.79,3.79,0,0,0,12.1,3.96a3.881,3.881,0,0,0-2.71-.91,6.854,6.854,0,0,0-.77.04A3.485,3.485,0,0,0,5.49,6.57V9.31A.491.491,0,0,1,5,9.8a5,5,0,0,1-5-5V1.84A1,1,0,0,1,1.34.9a4.671,4.671,0,0,0,.82.2,2.325,2.325,0,0,0,.37.04,3.866,3.866,0,0,0,.48.03A5.081,5.081,0,0,0,6.21,0,4.852,4.852,0,0,0,9.37,1.17,4.788,4.788,0,0,0,12.52.02a5.052,5.052,0,0,0,3.16,1.15,4.578,4.578,0,0,0,.53-.03c.12-.01.23-.02.34-.04a4.818,4.818,0,0,0,.87-.22A1,1,0,0,1,18.74,1.82Z" transform="translate(1.059 11.33)" fill="#525457"/>
                                 </svg>
                              </div>
                              <span class="mt-2 mr-2">المنتجات</span>
                           </a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link  d-flex" href="{{airoute('front.mrchnt.movement')}}" role="tab" aria-controls="home" aria-selected="true">
                              <div class="icon">
                                 <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 19.99 20">
                                    <path id="Vector" d="M14.19,0H5.81C2.17,0,0,2.17,0,5.81v8.37C0,17.83,2.17,20,5.81,20h8.37c3.64,0,5.81-2.17,5.81-5.81V5.81C20,2.17,17.83,0,14.19,0ZM7.11,14.9a.5.5,0,0,1-.5.5H3.82a.5.5,0,0,1-.5-.5V10.28A1.139,1.139,0,0,1,4.46,9.14H6.61a.5.5,0,0,1,.5.5Zm4.78,0a.5.5,0,0,1-.5.5H8.6a.5.5,0,0,1-.5-.5V5.74A1.139,1.139,0,0,1,9.24,4.6h1.52A1.139,1.139,0,0,1,11.9,5.74V14.9Zm4.79,0a.5.5,0,0,1-.5.5H13.39a.5.5,0,0,1-.5-.5V11.35a.5.5,0,0,1,.5-.5h2.15a1.139,1.139,0,0,1,1.14,1.14Z" fill="#525457"/>
                                 </svg>
                              </div>
                              <span class="mt-2 mr-2">الحركات المالية</span>
                           </a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link li-radius-bottom d-flex" href=" " role="tab" aria-controls="home" aria-selected="true">
                              <div class="icon">
                                 <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 16 20">
                                    <path id="Fill_1" data-name="Fill 1" d="M0,3.4c0,2.72,3.662,3.425,8,3.425,4.315,0,8-.68,8-3.4S12.339,0,8,0C3.685,0,0,.68,0,3.4Z" transform="translate(0 13.174)" fill="#525457"/>
                                    <path id="Fill_4" data-name="Fill 4" d="M5.294,10.583A5.292,5.292,0,1,0,0,5.291a5.274,5.274,0,0,0,5.294,5.292" transform="translate(2.706)" fill="#525457"/>
                                 </svg>
                              </div>
                              <span class="mt-2 mr-2">الحساب</span>
                           </a>
                        </li>
                     </ul>
                  </div>
                  <!-- /.col-md-4 -->
                  <div class="col-md-10 tab-div">
                     <div class="tab-content" id="myTabContent">
                        @yield('orders')
                        @yield('products')
                        @yield('movements')
                        @yield('account')
                     </div>
                  </div>
                  <!-- /.col-md-8 -->
               </div>
            </div>
         </div>
@endsection
 
@section('js')
    {{-- <script>
        function add_Products_new(){
            $('#Div_All_Products').hide();
            $('#Div_Add_New_Products').show();
        }

        function Products_save(){
            $('#Div_Add_New_Products').hide();
            $('#Div_All_Products').show();
        
        
            $('html, body').animate({
            scrollTop: $("#Div_All_Products").offset().top
        }, 1000)};

        function account_edit(){
            $('.button-account-edit').hide();
            $('.button-account-save-edit').show();
        }

        function account_save_edit(){
            $('.button-account-save-edit').hide();
            $('.button-account-edit').show();
        }
        
        function password_change(){
            $('.button-password-change').hide();
            $('.button-password-edit').show();
            $('.input-password').show();
        }
        
        function password_edit(){
            $('.button-password-edit').hide();
            $('.button-password-save-edit').show();
        }
        
        function password_save_edit(){
            $('.button-password-save-edit').hide();
            $('.button-password-edit').hide();
            $('.button-password-change').show();
            $('.input-password').hide();
        }
    </script> --}}
@endsection