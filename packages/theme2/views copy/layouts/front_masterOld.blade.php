<!DOCTYPE html>
<html lang="en">
   <head>
      <title>@yield('title') Women Store</title>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="description" content="Colo Shop Template">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" type="text/css" href="{{asset('front/styles/bootstrap/css/bootstrap-rtl.css')}}">
      <link href="{{asset('front/js/plugins/font-awesome-4.7.0/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
      <link rel="stylesheet" type="text/css" href="{{asset('front/js/plugins/jquery-ui-1.12.1.custom/jquery-ui.css')}}">
      <link rel="stylesheet" type="text/css" href="{{asset('front/js/plugins/OwlCarousel2-2.2.1/owl.carousel.css')}}">
      <link rel="stylesheet" type="text/css" href="{{asset('front/js/plugins/OwlCarousel2-2.2.1/owl.theme.default.css')}}">
      <link rel="stylesheet" type="text/css" href="{{asset('front/js/plugins/OwlCarousel2-2.2.1/animate.css')}}">
	  <link href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/8.4.6/css/intlTelInput.css" rel="stylesheet" />
      <link rel="stylesheet" type="text/css" href="{{asset('front/styles/main_styles.css')}}">
      <link rel="stylesheet" type="text/css" href="{{asset('front/styles/responsive.css')}}">
      <link rel="stylesheet" type="text/css" href="{{asset('front/styles/single_styles.css')}}">
      <link rel="stylesheet" type="text/css" href="{{asset('front/styles/single_responsive.css')}}">
	  @yield('css')
   </head>
   <body dir="rtl">
      <div class="super_container">
         <!-- Header -->
         <header class="header trans_300">
            <!-- Top Navigation -->
            <div class="top_nav">
               <div class="container">
                  <div class="row">
                     <div class="col-md-4">
                        <div class="top_nav_right text-right  d-flex layout-align-justify">
                           <div class=" cursor-pointer"  data-toggle="modal" data-target="#Shipping-to-modal">
                              <img src="{{asset('front/images/logo/ps.png')}}" width="40">
                              USD
                           </div>
                           <div class="d-flex cursor-pointer"  data-toggle="modal" data-target="#languages-modal">
                              <div class=" mx-2 mt-0.5">
                                 <img src="{{asset('front/images/logo/language.png')}}" width="18">
                              </div>
                              <div class="d-flex">
                                 العربية
                                 <div >
                                    <svg id="expand_more_black_24dp" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24">
                                       <path id="Path_13265" data-name="Path 13265" d="M24,24H0V0H24Z" fill="none" opacity="0.87"/>
                                       <path id="Path_13266" data-name="Path 13266" d="M15.88,9.29,12,13.17,8.12,9.29A1,1,0,0,0,6.71,10.7l4.59,4.59a1,1,0,0,0,1.41,0L17.3,10.7a1,1,0,0,0,0-1.41,1.017,1.017,0,0,0-1.42,0Z" fill="#525457"/>
                                    </svg>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="top_nav-center">
                           <img src="{{asset('front/images/logo/Logo.png')}}" width="100">
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="mt-13">
                           <ul class="navbar_user f-left">
                              @if (Auth::guest())
                                 <li>
                                    <a href="#">
                                    <img src="{{asset('front/images/icon/shopping-cart.png')}}" width="20">
                                    <span id="checkout_items" class="checkout_items">2</span>
                                    </a>
                                 </li>
                                 <li><a href="#">				
                                    <img src="{{asset('front/images/icon/huart.png')}}" width="20"></a>
                                 </li>
                                 <li><a href="{{airoute('login', ['site' => 'default'])}}">				
                                    <img src="{{asset('front/images/icon/users.png')}}" width="14"></a>
                                 </li>
                                 <li class="mr-3">
                                    <button class="btn  btn-outline-danger cursor-pointer round-20 mt-n13  entry-reg-shop">
                                    <a  href="{{airoute('mrchnt_register', ['site' => 'default'])}}">انضم كمتجر</a>
                                    </button>
                                    </a>
                                 </li>
                              @else
                                 <li>
                                    <a href="#">
                                       <img src="{{asset('front/images/icon/truck-fast.png')}}" width="20">
                                       <span id="checkout_items" class="checkout_items">2</span>
                                    </a>
                                 </li>	
                                 <li>
                                    <a href="#">				
                                       <img src="{{asset('front/images/icon/Notification.png')}}" width="16">
                                       <span id="checkout_items" class="checkout_items">2</span>
                                    </a>
                                 </li>
                                 @if (auth()->user()->superuser)
                                    <li class="mr-2">
                                       <a href="{{airoute('aimeos_shop_admin', ['site' => 'default'])}}">
                                          <div style="border-radius: 50px;border: 1px solid rgb(154, 154, 154);height: 55px;width: 55px;">
                                             <div class="logo-img-header-store">
                                                <img src="{{asset('front/images/logo/User-avatar.png')}}">
                                             </div>
                                          </div>
                                       </a>
                                    </li>
                                 @else
                                    <li class="mr-2">
                                       <a href="{{airoute('aimeos_shop_account', $site->getCode())}}">
                                          <div style="border-radius: 50px;border: 1px solid rgb(154, 154, 154);height: 55px;width: 55px;">
                                             <div class="logo-img-header-store">
                                                <img src="{{asset($site->getIcon())}}">
                                             </div>
                                          </div>
                                       </a>
                                    </li>
                                 @endif
                              @endif
                           </ul>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <!-- Main Navigation -->
            <div class="main_nav_container">
               <div class="container">
                  <div class="row">
                     <div class="col-lg-12 text-left" style="padding: 0px;">
                        <nav class="navbar">
                           <ul class="navbar_menu">
                              <li><a  href="{{ airoute('aimeos_home', ['site' => 'default']) }}">الرئيسية</a></li>
                              <li><a href="#">تسوق حسب</a></li>
                              <li><a href="#">جديدنا</a></li>
                              <li><a class="active" href="{{airoute('front.store.index')}}">المتاجر</a></li>
                              <li><a href="#">المدونة</a></li>
                              <li><a href="#">تواصل معنا</a></li>
                           </ul>
                           <div class="hamburger_container">
                              <i class="fa fa-bars" aria-hidden="true"></i>
                           </div>
                        </nav>
                        <div class="logo_container">
                           <div class="" style="width:250px">
                              <div class="input-icon">
                                 <input type="text" class="input-icon-radius form-control" placeholder="إبحث عن متجر">
                                 <button class="btn btn-sm   cursor-pointer round-20 mt-cust f-left">
                                 <i class="fa fa-search"></i>
                                 </button>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </header>
         <div class="fs_menu_overlay"></div>
         <div class="hamburger_menu"   id="container-carousel">
            <div class="hamburger_close"><i class="fa fa-times" aria-hidden="true"></i></div>
            <div class="hamburger_menu_content text-right">
               <ul class="menu_top_nav">
                  <li class="menu_item"><a class="active" href="#">الرئيسية</a></li>
                  <li class="menu_item"><a href="#">تسوق حسب</a></li>
                  <li class="menu_item"><a href="#">جديدنا</a></li>
                  <li class="menu_item"><a href="#">المتاجر</a></li>
                  <li class="menu_item"><a href="#">المدونة</a></li>
                  <li class="menu_item"><a href="#">تواصل معنا</a></li>
                  <li class="menu_item has-children">
                     <a href="#">
                        حسابي
                     <i class="fa fa-angle-down"></i>
                     </a>
                     <ul class="menu_selection">
                        <li><a href="#"><i class="fa fa-sign-in" aria-hidden="true"></i>تسجيل دخول</a></li>
                        <li><a href="#"><i class="fa fa-user-plus" aria-hidden="true"></i>تسجيل جديد</a></li>
                     </ul>
                  </li>
               </ul>
            </div>
         </div>
         <div class="modal fade" id="Shipping-to-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered bd-example-modal-sm d-flex justify-content-center" role="document">
               <div class="modal-content modal-sm">
                  <div class="modal-header-cust text-right">
                     <h5 class="modal-title" id="exampleModalLongTitle">
                        <img src="{{asset('front/images/icon/Shippingto.png')}}" width="18" height="18" class="mt-1 ml-1">
                        الشحن إلى
                     </h5>
                     <button type="button" class="close ml-n3" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">
                     <i class="fa fa-times-circle"></i>
                     </span>
                     </button>
                  </div>
                  <div class="modal-body languages mt-n3">
                     <div class=" language" data-dismiss="modal">
                        <img src="{{asset('front/images/icon/l1.png')}}" width="35">
                        <label>العربية</label>
                     </div>
                     <div class=" language" data-dismiss="modal">
                        <img src="{{asset('front/images/icon/l2.png')}}" width="35">
                        <label>العربية</label>
                     </div>
                     <div class=" language" data-dismiss="modal">
                        <img src="{{asset('front/images/icon/l3.png')}}" width="35">
                        <label>العربية</label>
                     </div>
                     <h5 class="mt-4">
                        <img src="{{asset('front/images/icon/Shippingto.png')}}" width="18" height="18" class="mt-1 ml-1">
                        الشحن إلى
                     </h5>
                     <div class=" language" data-dismiss="modal">
                        <img src="{{asset('front/images/icon/shekel.png')}}" width="35">
                        <label>شيكل</label>
                     </div>
                     <div class=" language" data-dismiss="modal">
                        <img src="{{asset('front/images/icon/dollar.png')}}" width="35">
                        <label>دولار</label>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="modal fade" id="languages-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered bd-example-modal-sm d-flex justify-content-center" role="document">
               <div class="modal-content modal-sm">
                  <div class="modal-header-cust text-right">
                     <h5 class="modal-title" id="exampleModalLongTitle">
                        <img src="{{asset('front/images/logo/language.png')}}" width="18" height="18" class="mt-1 ml-1">
                        حدد اللغة التي تريدها
                     </h5>
                     <button type="button" class="close ml-n3" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">
                     <i class="fa fa-times-circle"></i>
                     </span>
                     </button>
                  </div>
                  <div class="modal-body languages mt-n3">
                     <a href="{{airoute('aimeos_home.setLang', 'ar')}}">
                        <div class="language" data-dismiss="modal">
                           <img src="{{asset('front/images/icon/l1.png')}}" width="35">
                           <label>العربية</label>
                        </div>
                     </a>
                     <a href="{{airoute('aimeos_home.setLang', 'en')}}">
                        <div class="language" data-dismiss="modal">
                           <img src="{{asset('front/images/icon/l2.png')}}" width="35">
                           <label>English</label>
                        </div>
                     </a>
                  </div>
               </div>
            </div>
         </div>

			@yield('content')

         <!-- Footer -->
         <div id="footer" style="margin-top: 5rem;">
            <div class="footer">
               <div class="container">
                  <div class="row  d-flex pt-20">
                     <div style="width:20%; text-align: center; line-height:30px">
                        <img src="{{asset('front/images/logo/Logo-footer.png')}}" width="130">
                        <div style="color: white;">
                           متجر موثوق به تصميم وتصنيع الملابس للمشاغل اليدوية بأيدي فلسطينية
                        </div>
                     </div>
                     <div style="width:13%;margin-right: 3%;">
                        <ul style="line-height:30px">
                           <li><a class="a" href="#">أقسام تهمّك</a></li>
                           <li><a class="a"  href="#">خدمة العملاء</a></li>
                           <li><a class="a"  href="#">انضم لنا</a></li>
                           <li><a class="a"  href="#">الشروط والسياسات</a></li>
                           <li><a class="a"  href="#">سياسة الخصوصية </a></li>
                        </ul>
                     </div>
                     <div style="width:15%;margin-right: 2%;">
                        <ul style="line-height:30px">
                           <li><a class="a" href="#">اخرى</a></li>
                           <li><a class="a"  href="#">من نحن</a></li>
                           <li><a class="a"  href="#">سياسة الإرجاع والاسترداد النقدي</a></li>
                           <li><a class="a"  href="#">سياسة الشحن</a></li>
                           <li><a class="a"  href="#">عن الموقع </a></li>
                        </ul>
                     </div>
                     <div style="width:18%;margin-right: 3%;">
                        <a class="a" href="#">التواصل الاجتماعي</a>
                        <div class="footer_social d-flex flex-row mt-10px">
                           <button type="button" class="btn   btn-circle"><i class="fa fa-whatsapp"></i></button>
                           <button type="button" class="btn   btn-circle"><i class="fa fa-snapchat"></i></button>
                           <button type="button" class="btn   btn-circle"><i class="fa fa-instagram"></i></button>
                           <button type="button" class="btn   btn-circle"><i class="fa fa-facebook"></i></button>
                           <button type="button" class="btn   btn-circle"><i class="fa fa-twitter"></i></button>
                        </div>
                     </div>
                     <div style="width:20%;margin-right: 5%">
                        <a class="a" href="#">تواصل معنا</a>
                        <div class=" d-flex flex-row mt-10px">
                           <button type="button" class="btn mt-3px  btn-circle"><i class="fa fa-map-marker"></i></button>
                           <ul class="l-h-li">
                              <li><a class="a cursor-pointer">العنوان</a></li>
                              <li><a class="a cursor-pointer">فلسطين - غزة - شارع عمر المختار</a></li>
                           </ul>
                        </div>
                        <div class=" d-flex flex-row mt-10px">
                           <button type="button" class="btn mt-3px  btn-circle"><i class="fa fa-map-marker"></i></button>
                           <ul class="l-h-li">
                              <li><a class="a cursor-pointer">الهاتف</a></li>
                              <li><a class="a cursor-pointer">+970 59123 4567</a></li>
                           </ul>
                        </div>
                     </div>
                  </div>
                  <div class="row pt-40" >
                     <div class="col-6">
                        <div class=" d-flex flex-sm-row flex-column align-items-center justify-content-lg-start justify-content-center text-center">
                           <span class="text-white">جميع الحقوق محفوظة لدى تراث فلسطيني © 2022 </span>
                        </div>
                     </div>
                     <div class="col-6">
                        <div class="footer_social d-flex flex-row align-items-center justify-content-lg-end justify-content-center">
                           <ul>
                              <li><a class="cursor-pointer opacity-07"><img src="{{asset('front/images/icon/pay.png')}}" width="50"></a></li>
                              <li><a class="cursor-pointer opacity-07"><img src="{{asset('front/images/icon/paypal.png')}}" width="50"></a></li>
                              <li><a class="cursor-pointer opacity-07"><img src="{{asset('front/images/icon/mada.png')}}" width="50"></a></li>
                              <li><a class="cursor-pointer opacity-07"><img src="{{asset('front/images/icon/masterCard.png')}}" width="50"></a></li>
                              <li><a class="cursor-pointer opacity-07"><img src="{{asset('front/images/icon/visa.png')}}" width="50"></a></li>
                           </ul>
                        </div>
                     </div>
                  </div>
               </div>
               </footer>
            </div>
         </div> 
      </div>
      <!-- Footer -->
      <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
      <script src="{{asset('front/styles/bootstrap/js/popper.js')}}"></script>
      <script src="{{asset('front/styles/bootstrap/js/bootstrap.min.js')}}"></script>
      <script src="{{asset('front/js/plugins/Isotope/isotope.pkgd.min.js')}}"></script>
      <script src="{{asset('front/js/plugins/OwlCarousel2-2.2.1/owl.carousel.js')}}"></script>
      <script src="{{asset('front/js/plugins/easing/easing.js')}}"></script>
      <script src="{{asset('front/js/plugins/jquery-ui-1.12.1.custom/jquery-ui.js')}}"></script>
      <script src="{{asset('front/js/single_custom.js')}}"></script>
      <script src="{{asset('front/js/categories_custom.js')}}"></script>
      <script src="{{asset('front/js/custom.js')}}"></script>
      @yield('js')
   </body>
</html>