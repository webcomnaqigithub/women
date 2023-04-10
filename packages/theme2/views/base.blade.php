<!DOCTYPE html>
<html lang="en">
   <head>
      <title>@yield('title') Women Store</title>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="description" content="Colo Shop Template">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" type="text/css" href="{{asset('front/js/plugins/font-awesome-4.7.0/css/font-awesome.min.css')}}">
      <link rel="stylesheet" type="text/css" href="{{asset('front/js/plugins/jquery-ui-1.12.1.custom/jquery-ui.css')}}">
      <link rel="stylesheet" type="text/css" href="{{asset('front/js/plugins/OwlCarousel2-2.2.1/owl.carousel.css')}}">
      <link rel="stylesheet" type="text/css" href="{{asset('front/js/plugins/OwlCarousel2-2.2.1/owl.theme.default.css')}}">
      <link rel="stylesheet" type="text/css" href="{{asset('front/js/plugins/OwlCarousel2-2.2.1/animate.css')}}">
      <link rel="stylesheet" type="text/css" href="{{asset('front/js/plugins/themify-icons/themify-icons.css')}}">
      {{-- <link rel="stylesheet" type="text/css" href="{{asset('front/styles/nice-select.css')}}"> --}}
		<link rel="icon" href="{{asset('front/images/logo/Logo.png')}}"/>
      @yield('title')

      @if( app()->getLocale()== 'ar')
         <link rel="stylesheet" type="text/css" href="{{asset('front/styles/bootstrap/css/bootstrap-rtl.css')}}">
         <link rel="stylesheet" type="text/css" href="{{asset('front/styles/main_styles.css')}}">
         <link rel="stylesheet" type="text/css" href="{{asset('front/styles/responsive.css')}}">
      @else
         <link rel="stylesheet" type="text/css" href="{{asset('front/styles/bootstrap/css/bootstrap-ltr.css')}}">
         <link rel="stylesheet" type="text/css" href="{{asset('front/styles/main_styles-ltr.css')}}">
         <link rel="stylesheet" type="text/css" href="{{asset('front/styles/responsive-ltr.css')}}">
      @endif

      @yield('aimeos_header')
      @yield('css')
   </head>
   <body class="{{ $page ?? '' }} {{app()->getLocale()== 'ar' ? 'rtlcarousel' : 'ltrcarousel'}} text-right">
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
                              {{$selectCurrencyId}}
                           </div>
                           <div class="d-flex cursor-pointer"  data-toggle="modal" data-target="#languages-modal">
                              <div class=" mx-2 mt-0.5">
                                 <img src="{{asset('front/images/logo/language.png')}}" width="18">
                              </div>
                              <div class="d-flex">
                                 @if ($selectLanguageId == 'ar')
                                     العربية
                                 @elseif($selectLanguageId == 'en')
                                     English
                                 @endif
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
                     <div class="col-md-4 ">
                        <div class="top_nav-center">
                           <a href="{{ airoute('aimeos_home', ['site' => 'default']) }}"><img src="{{asset('front/images/logo/Logo.png')}}" style="width: 148px;"></a>
                        </div>
                     </div>
                     <div class="col-md-4 header-index" >
                        <div class="mt-13 ">
                           <ul class="navbar_user float-direction">
                              <li>
                                 <a href="{{'/' . app()->getLocale() . '/shop/default/basket'}}">
                                    <img src="{{asset('front/images/icon/shopping-cart.png')}}" width="20">
                                    <span id="checkout_items" class="checkout_items">{{$basket->getProducts()->count()}}</span>
                                 </a>
                              </li>
                              @if (Auth::guest())
                                 <li><a href="#">				
                                    <img src="{{asset('front/images/icon/huart.png')}}" width="20"></a>
                                 </li>
                                 <li>
                                    <a href="{{airoute('login', ['site' => 'default'])}}">				
                                       <img src="{{asset('front/images/icon/users.png')}}" width="14">
                                    </a>
                                 </li>
                                 {{-- <li class="mr-3">
                                    <button class="btn  btn-outline-danger cursor-pointer round-20 mt-n13  entry-reg-shop">
                                    <a  href="{{airoute('usr_register')}}">{{aitrans('New user', [], 'client')}}</a>
                                    </button>
                                    </a>
                                 </li> --}}
                                 <li>
                                    <div class="dropdown">
                                       <button class="btn  btn-outline-danger cursor-pointer round-20 mt-n13  entry-reg-shop dropdown-toggle" type="button" id="sign-as" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                         إنضم لنا
                                       </button>
                                       <div class="dropdown-menu" aria-labelledby="dropdown">
                                         <a  href="{{airoute('mrchnt_register', ['site' => 'default'])}}" class="dropdown-item mr-3 sign-as">{{aitrans('Join as a shop', [], 'client')}}</a>
                                         <a  href="{{airoute('usr_register', ['site' => 'default'])}}" class="dropdown-item mr-3 sign-as" style="padding-right: 37px;">إنضم كمستخدم</a>
                                       </div>
                                     </div>
                                    {{-- <button class="btn  btn-outline-danger cursor-pointer round-20 mt-n13  entry-reg-shop">
                                       <a  href="{{airoute('mrchnt_register', ['site' => 'default'])}}">{{aitrans('Join as a shop', [], 'client')}}</a>
                                    </button> --}}
                                 </li>
                              @elseif(Auth::check() && Auth::user()->superuser != 1)
                                 <li>
                                    <a href="{{airoute('front.usr.favorite', ['usid'=>auth()->user()->id, 'site'=>'default'])}}">				
                                       <img src="{{asset('front/images/icon/huart.png')}}" width="20">
                                       <span id="checkout_items" class="checkout_items">{{$fav_number->count()}}</span>
                                    </a>
                                 </li>
                                 {{-- <li>
                                    <a href="#">
                                       <img src="{{asset('front/images/icon/truck-fast.png')}}" width="20">
                                       <span id="checkout_items" class="checkout_items">2</span>
                                    </a>
                                 </li>	 --}}
                                 <li>
                                    <a href="{{airoute('front.notification', ['site' => 'default'])}}">			
                                       <img src="{{asset('front/images/icon/Notification.png')}}" width="16">
                                       <span id="checkout_items" class="checkout_items">{{$notifications}}</span>
                                    </a>
                                 </li>
                                 <li class="mr-2">
                                    <a href="{{airoute('aimeos_shop_account', ['site' =>$site->getCode(), 'locale' => app()->getLocale()])}}">
                                       <div style="border-radius: 50px;border: 1px solid rgb(154, 154, 154);height: 55px;width: 55px;">
                                          <div class="logo-img-header-store">
                                             <img src="{{auth()->user()->icon ?? '/front/images/User-avatar.png' }}">
                                          </div>
                                       </div>
                                    </a>
                                 </li>	
                              @elseif(Auth::check() && Auth::user()->superuser == 1)
                                 <li>
                                    <a href="{{airoute('front.usr.favorite', ['usid'=>auth()->user()->id, 'site' => 'default'])}}">				
                                       <img src="{{asset('front/images/icon/huart.png')}}" width="20">
                                    </a>
                                 </li>
                                 {{-- <li>
                                    <a href="#">
                                       <img src="{{asset('/front/images/icon/truck-fast.png')}}" width="20">
                                       <span id="checkout_items" class="checkout_items">2</span>
                                    </a>
                                 </li>	 --}}
                                 <li>
                                    <a href="#">				
                                       <img src="{{asset('front/images/icon/Notification.png')}}" width="16">
                                       {{-- <span id="checkout_items" class="checkout_items">2</span> --}}
                                    </a>
                                 </li>
                                 <li class="mr-2">
                                    <a href="{{route('aimeos_shop_admin', ['locale'=>'en'])}}">
                                       <div style="border-radius: 50px;border: 1px solid rgb(154, 154, 154);height: 55px;width: 55px;">
                                          <div class="logo-img-header-store">
                                             <img src="{{asset('/front/images/User-avatar.png')}}">
                                          </div>
                                       </div>
                                    </a>
                                 </li>	
                              @endif
                           </ul>
                        </div>
                     </div>

                     <div class="col-md-4 header-profile-store">
                        <div class="mt-13 ">
                           <ul class="navbar_user f-left">
                              <li>
                                 <a href="#">
                                 <img src="{{asset('front/images/icon/truck-fast.png')}}" width="20">
                                 <span id="checkout_items" class="checkout_items">0</span>
                                 </a>
                              </li>
                              <li><a href="#">				
                                 <img src="{{asset('front/images/icon/Notification.png')}}" width="16">
                                 {{-- <span id="checkout_items" class="checkout_items">2</span> --}}
                                 </a>
                              </li>
                              <li class="mr-2">
                                 <div style="border-radius: 50px;border: 1px solid rgb(154, 154, 154);height: 55px;width: 55px;">
                                    <div class="logo-img-header-store">
                                       <img src="{{asset('front/images/logo/User-avatar.png')}}">
                                    </div>
                                 </div>
                                 </a>
                              </li>
                           </ul>
                        </div>
                     </div>
                     <div class="col-md-4 header-profile-user">
                        <div class="mt-13 ">
                           <ul class="navbar_user float-direction">
                              <li>
                                 <a href="{{'/' . app()->getLocale() . '/shop/default/basket'}}">
                                    <img src="{{asset('front/images/icon/shopping-cart.png')}}" width="20">
                                 <span id="checkout_items" class="checkout_items">0</span>
                                 </a>
                              </li>
                              <li><a href="#">				
                                 <img src="{{asset('front/images/icon/huart.png')}}" width="20"></a>
                              </li>
                              <li>
                                 <a href="#">				
                                 <img src="{{asset('front/images/icon/Notification.png')}}" width="16">
                                 {{-- <span id="checkout_items" class="checkout_items">2</span> --}}
                                 </a>
                              </li>
                              <li class="mr-2">
                                 <div class="img-user-profile">
                                    <img src="{{asset('front/images/logo/user.png')}}" >
                                 </div>
                                 </a>
                              </li>
                           </ul>
                        </div>
                     </div>
                  </div>
               </div> 
            </div>

            <!-- Main Navigation -->
            <div class="main_nav_container">
               <div class="container">
                  <div class="row d-flex-space-between">
                     <div>
                        <nav class="navbar">
                           <ul class="navbar_menu">
                              <li><a  href="{{ airoute('aimeos_home', ['site' => 'default']) }}">{{aitrans('Main', [], 'client')}}</a></li>
                              <li class="dropdown ">
                                 <a class="dropdown-toggle" data-toggle="dropdown"  href="#" aria-expanded="true">{{aitrans('Shop by', [], 'client')}}<span class="caret"></span></a>
                                 <div class="row dropdown-menu p-3 dropdown-menu-right">
                                    <div class="container d-bolck text-right">
                                       <h4>{{aitrans('Shop by', [], 'client')}}</h4>
                                       <div class="row mt-4">
                                          @foreach($sub_categories as $item)
                                             <div class="ml-4 text-center cursor-pointer cat-tree-2" data-id="{{($item->getId())}}" data-label="{{($item->getLabel())}}">
                                                <div class="product-nav-bar bg-navbar-1 mb-2">		
                                                   <img src="/aimeos/{{ $item->getRefItems('media')->first()? $item->getRefItems('media')->first()->getPreview():'' }}" alt="">
                                                </div>
                                                <h5 class="title-product-nav-bar">{{ ($item->getRefItems('text')->first()['text.content'] ?? $item->label) }}</h5>
                                             </div>
                                          @endforeach
                                       </div>
                                       <div class="Sub-Categories Clothes" id="subcat" style="display: none;">
                                          <hr>
                                          <h4 id="maincat-name" class="text-right">{{aitrans('Category', [], 'client')}}</h4>
                                          <nav class="navbar navbar-cust">
                                             <ul class="navbar_menu" id="cat-tree-3">
                                                {{-- <li><a class="font-15px" href="Shop-by.html">الكل</a></li> --}}
                                             </ul>
                                          </nav>
                                       </div>
                                    </div>
                                 </div>
                              </li>
                              <li><a href="{{airoute('front.ournews', ['site' => 'default'])}}">{{aitrans('our new', [], 'client')}}</a></li>
                              <li><a  href="{{airoute('front.store.index', ['site' => 'default'])}}">{{aitrans('Shops', [], 'client')}}</a></li>
                              <li><a href="{{airoute('front.blog.index', ['site' => 'default'])}}">{{aitrans('Blog', [], 'client')}}</a></li>
                              <li><a href="{{airoute('front.contactus.index', ['site' => 'default'])}}">{{aitrans('contact us', [], 'client')}}</a></li>
                           </ul>
                           <div class="hamburger_container">
                              <i class="fa fa-bars" aria-hidden="true"></i>
                           </div>
                        </nav>
                     </div>

                     {{-- ---------------------------Mobile Header----------------------- --}}
                     @guest
                        <ul class="navbar_user navbar logo_container-mobile">
                           <img src="{{asset('front/images/logo/Logo.png')}}" width="70">
                        </ul>
                        <div class="logo_container-mobile " style="display:none;"> 
                           
                           <ul class="navbar_user navbar f-left">
                              <li>
                                 <a href="{{'/' . app()->getLocale() . '/shop/default/basket'}}">
                                    <img src="{{asset('front/images/icon/shopping-cart.png')}}" width="20">
                                    <span id="checkout_items" class="checkout_items">0</span>
                                 </a>
                              </li>	
                              <li>
                                 <a href="{{airoute('login', ['site' => 'default'])}}">				
                                    <img src="{{asset('front/images/icon/users.png')}}" width="14">
                                 </a>
                              </li>
                              <li class="mr-1 mt-2">
                                 <button class="btn btn-outline-danger cursor-pointer round-20 mt-n13  entry-reg-shop">
                                    <a href="{{airoute('mrchnt_register', ['site' => 'default'])}}">{{aitrans('Join as a shop', [], 'client')}}</a>
                                 </button>
                              </li>	
                           </ul>
                        </div>
                     @endguest
                     @if(Auth::check() && Auth::user()->superuser != 1)
                        <ul class="navbar_user navbar logo_container-mobile">
                           <img src="{{asset('front/images/logo/Logo.png')}}" width="70">
                        </ul>
                        <div class="logo_container-mobile " style="display:none;"> 
                           <ul class="navbar_user navbar f-left">
                              <li>
                                 <a href="{{'/' . app()->getLocale() . '/shop/default/basket'}}">
                                    <img src="{{asset('front/images/icon/shopping-cart.png')}}" width="20">
                                    <span id="checkout_items" class="checkout_items">{{$basket->getProducts()->count()}}</span>
                                 </a>
                              </li>
                              
                           </ul>
                        </div>
                     @endif
                     {{-- ---------------------------Mobile Header----------------------- --}}

                     <div class="logo_container">
                        <div class="input-icon ">
                           <form action="{{airoute('front.product_shopping', ['site' => 'default'])}}" method="GET">
                              <input type="text" name="sk" class="input-icon-radius form-control" placeholder=" {{aitrans('I look for', [], 'client')}}">
                              <button class="btn btn-sm cursor-pointer round-20 mt-cust logo_container-icon-search" type="submit">
                                 <i class="fa fa-search"></i>
                              </button>
                           </form>
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
                  <li class="menu_item"><a class="active" href="{{airoute('aimeos_home', ['site' => 'default'])}}">{{aitrans('Main', [], 'client')}}</a></li>
                  {{-- <li class="menu_item"><a href="#">{{aitrans('Shop by category', [], 'client')}}</a></li> --}}
                  <li class="menu_item"><a href="{{airoute('front.ournews', ['site' => 'default'])}}"> {{aitrans('our new', [], 'client')}}</a></li>
                  <li class="menu_item"><a href="{{airoute('front.store.index', ['site' => 'default'])}}"> {{aitrans('Shops', [], 'client')}}</a></li>
                  <li class="menu_item"><a href="{{airoute('front.blog.index', ['site' => 'default'])}}"> {{aitrans('Blog', [], 'client')}}</a></li>
                  <li class="menu_item"><a href="{{airoute('front.contactus.index', ['site' => 'default'])}}">{{aitrans('contact us', [], 'client')}}</a></li>
                  @auth
                     <li class="menu_item"><a href="{{airoute('aimeos_shop_account', ['site' =>$site->getCode(), 'locale' => app()->getLocale()])}}">حسابي</a></li>
                  @endauth
                  @guest
                     <li><a href="{{airoute('login', ['site' => 'default'])}}"><i class="fa fa-sign-in" aria-hidden="true"></i>تسجيل دخول</a></li>
                     <li><a href="{{airoute('mrchnt_register', ['site' => 'default'])}}"><i class="fa fa-user-plus" aria-hidden="true"></i>تسجيل جديد</a></li>
                  @endguest
                     {{-- <li class="menu_item has-children">
                        <a href="#">
                           حسابي
                        <i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="menu_selection">
                           <li><a href="{{airoute('login', ['site' => 'default'])}}"><i class="fa fa-sign-in" aria-hidden="true"></i>تسجيل دخول</a></li>
                           <li><a href="{{airoute('mrchnt_register', ['site' => 'default'])}}"><i class="fa fa-user-plus" aria-hidden="true"></i>تسجيل جديد</a></li>
                        </ul>
                     </li> --}}
               </ul>
            </div>
         </div>
         {{-- <div class="modal fade" id="Shipping-to-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
         </div> --}}
         <div class="modal fade" id="languages-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered bd-example-modal-sm d-flex justify-content-center" role="document">
               <div class="modal-content modal-sm">
                  <div class="modal-header-cust text-right">
                     <h5 class="modal-title" id="exampleModalLongTitle">
                        <img src="{{asset('front/images/logo/language.png')}}" width="18" height="18" class="mt-1 ml-1">
                         {{aitrans('Select the language you want', [], 'client')}}
                     </h5>
                     <button type="button" class="close ml-n3" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">
                     <i class="fa fa-times-circle"></i>
                     </span>
                     </button>
                  </div>
                  <div class="modal-body languages mt-n3">
                     <a href="{{str_replace('/'. Request::get( 'locale', app()->getLocale() ), '/ar', Request::getRequestUri())}}">
                        <div class="language">
                           <img src="{{asset('front/images/icon/l1.png')}}" width="35">
                           <label>العربية</label>
                        </div>
                     </a>
                     <a href="{{str_replace('/'. Request::get( 'locale', app()->getLocale() ), '/en', Request::getRequestUri())}}">
                        <div class="language">
                           <img src="{{asset('front/images/icon/l2.png')}}" width="35">
                           <label>English</label>
                        </div>
                     </a>
                  </div>
               </div>
            </div>
         </div>
         <div class="modal fade" id="Shipping-to-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered bd-example-modal-sm d-flex justify-content-center" role="document">
               <div class="modal-content modal-sm">
                   
                  <div class="modal-body languages mt-n3">
                     <h5 class="mt-4">
                     <img src="{{asset('front/images/icon/Shippingto.png')}}" width="18" height="18" class="mt-1 ml-1">
                         {{aitrans('Choose the type of currency', [], 'client')}}
                     </h5>
                     <div class=" language">
                        <a href="?currency=ILS">
                           <img src="{{asset('front/images/icon/shekel.png')}}" width="35">
                           <label>شيكل</label>
                        </a>
                     </div>
                     <div class=" language">
                        <a href="?currency=USD">
                           <img src="{{asset('front/images/icon/dollar.png')}}" width="35">
                           <label>دولار</label>
                        </a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
		 {{-- @yield('aimeos_stage') --}}
		 @yield('aimeos_body')  
		 @yield('content')

         <!-- Footer -->
         <div class="footer fixed-bottom">
            <div class="start-footer">
            <div class="container">
               <div class="row  d-flex pt-20">
                 <div class="div-footer-1">
                     <a href="{{ airoute('aimeos_home', ['site' => 'default']) }}">
                        <img src="{{asset('front/images/logo/Logo.png')}}" width="130">
                     </a>
                   <div style="color: white;">
                       {{aitrans('A trusted store designing and manufacturing clothes for handicrafts made by Palestinian hands', [], 'client')}}
                   </div>
                 </div>
                 <div class="div-footer-2">
                     <ul style="line-height:30px">
                        <li><a class="a" href="/{{ app()->getLocale() }}/p/sections_interest">{{aitrans('Sections that interest you', [], 'client')}}</a></li>
                        <li><a class="a"  href="/{{ app()->getLocale() }}/p/customers_service">{{aitrans('customers service', [], 'client')}}</a></li>
                        <li><a class="a"  href="/{{ app()->getLocale() }}/p/join_us">{{aitrans('Join us', [], 'client')}}</a></li>
                        <li><a class="a"  href="/{{ app()->getLocale() }}/p/terms_and_policies">{{aitrans('Terms and Policies', [], 'client')}}</a></li>
                        <li><a class="a"  href="/{{ app()->getLocale() }}/p/privacy_policy">{{aitrans('privacy policy', [], 'client')}}</a></li>
                     </ul>
                 </div>
                 <div class="div-footer-3">
                   <ul style="line-height:30px">
                     <li><a class="a" href="/{{ app()->getLocale() }}/p/other">  {{aitrans('other', [], 'client')}}</a></li>
                     <li><a class="a"  href="/{{ app()->getLocale() }}/p/who_are_we">{{aitrans('who are we', [], 'client')}}</a></li>
                     <li><a class="a"  href="/{{ app()->getLocale() }}/p/return_and_cashback">{{aitrans('Return and cashback policy', [], 'client')}}</a></li>
                     <li><a class="a"  href="/{{ app()->getLocale() }}/p/shipping_policy">{{aitrans('Shipping Policy', [], 'client')}}</a></li>
                     <li><a class="a"  href="/{{ app()->getLocale() }}/p/about_the_site">{{aitrans('About the site', [], 'client')}}</a></li>
                   </ul>
                 </div>
                 <div class="div-footer-4">
                   <a class="a" href="#">{{aitrans('Social Media', [], 'client')}}</a>
                   <div class="footer_social d-flex flex-row mt-10px">
                     <a href="https://wa.me/+972598880593/?text=Hello" class="btn btn-circle"><i class="fa fa-whatsapp"></i></a>
                     <a href="https://t.me/mowgaza" class="btn btn-circle"><i class="fa fa-telegram"></i></a>
                     <a href="https://instagram.com/mowa.gaza?igshid=YmMyMTA2M2Y=" class="btn btn-circle"><i class="fa fa-instagram"></i></a>
                     <a href="https://www.facebook.com/MOWGAZA" class="btn btn-circle"><i class="fa fa-facebook"></i></a>
                     <a href="https://twitter.com/mowa_min?t=Psiq9Ilu3BYPDSTVKoiMbQ&s=08" class="btn btn-circle"><i class="fa fa-twitter"></i></a>
                   </div>
                 </div>
                 <div class="div-footer-5">
                   <a class="a" href="#">{{aitrans('contact us', [], 'client')}}</a>
                   <div class=" d-flex flex-row mt-10px">
                     <button type="button" class="btn mt-3px  btn-circle"><i class="fa fa-map-marker"></i></button>
                     <ul class="l-h-li">
                        <li><a class="a cursor-pointer">{{aitrans('address', [], 'client')}}</a></li>
                        <li><a class="a cursor-pointer">{{aitrans('Palestine - Gaza', [], 'client')}}</a></li>
                     </ul>
                   </div>
                   <div class=" d-flex flex-row mt-10px">
                     <button type="button" class="btn mt-3px  btn-circle"><i class="fa fa-phone"></i></button>
                     <ul class="l-h-li">
                        <li><a class="a cursor-pointer">{{aitrans('the phone', [], 'client')}}</a></li>
                        <li><a class="a cursor-pointer"> 59-888-0593 970+</a></li>
                     </ul>
                   </div>
                 </div>
               </div>
              </div>
              <img src="{{asset('front/images/tape.png')}}"  style="width: 100%; height: 40px; margin-top:10px ;">

            <div class="end-footer" >
               <div class="container">
                  <div class=" row d-flex-justify-center ">
                     <div class="end-footer-2">
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


                     <div class="end-footer-1">
                        <div class="d-flex flex-sm-row flex-column align-items-center justify-content-between">
                           <span></span>
                           <span class="text-white"> {{aitrans('All rights reserved to ', [], 'client')}} <a href="https://mowa.gov.ps/" target="_blank">{{aitrans('Ministry of Women Affairs', [], 'client')}}</a> © 2022 </span>&nbsp;&nbsp;
                           <span class="text-white"> {{aitrans('Developed by ', [], 'client')}} <a href="webcom.technology" target="_blank">{{aitrans('Webcom Technology', [], 'client')}}</a></span>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>


      <!-- Footer -->
      <script src="{{asset('front/js/jquery-3.2.1.min.js')}}"></script>
      <script src="{{asset('front/styles/bootstrap/js/popper.js')}}"></script>
      <script src="{{asset('front/styles/bootstrap/js/bootstrap.min.js')}}"></script>
      <script src="{{asset('front/js/plugins/Isotope/isotope.pkgd.min.js')}}"></script>
      <script src="{{asset('front/js/plugins/OwlCarousel2-2.2.1/owl.carousel.js')}}"></script>
      <script src="{{asset('front/js/plugins/easing/easing.js')}}"></script>
      <script src="{{asset('front/js/plugins/jquery-ui-1.12.1.custom/jquery-ui.js')}}"></script>
      <script src="{{asset('front/js/sweetalert.min.js')}}" type="text/javascript"></script>
      <script src="{{asset('front/js/single_custom.js')}}"></script>
      <script src="{{asset('front/js/categories_custom.js')}}"></script>
      <script src="{{asset('front/js/custom.js')}}"></script>
      {{-- <script src="{{asset('front/js/nice-select.js')}}"></script> --}}
      {{-- <script src="{{ asset('vendor/shop/themes/default/app.js?v=' . config( 'shop.version', 1 ) ) }}"></script>
		<script src="{{ asset('vendor/shop/themes/default/aimeos.js?v=' . config( 'shop.version', 1 ) ) }}"></script> --}}
      <script>
         //لإظهار واخفاء القائمة بالضغط على تسوق حسب
         // $(".dropdown-toggle").on("click", function () {
         //     $(".dropdown-menu").toggle(); 
         // }); 
         // لاغلاق القائمة خارج إطار النافذة
         $(document).click(function (e) {
             e.stopPropagation();
             var container = $(".dropdown ");
             if (container.has(e.target).length === 0) {
                 $(".dropdown-menu").hide(); 
             }
             else{
                 
             }
         })
 
         $('.cat-tree-2').click(function (e) {
               e.preventDefault();
               let id = $(this).data('id'); 
               let label = $(this).data('label'); 
               let url = "{{airoute('front.mrchnt.product.get_sub_category', ['id' => 'ID', 'locale'=>'ar'])}}";
               $.ajax({
                  type:"POST",
                  url: url.replace('ID', id),
                  data:{
                  id:id,
                  _token:"{{ csrf_token() }}",
                  },
                  success: function(response) {
                  if(response != null)
                  { 
                     $('#subcat').show(); 
                     $('#cat-tree-3').html('');
                     $('#maincat-name').html(label);
                     $('#cat-tree-3').append('<li><a class="font-15px" href="/{{app()->getLocale()}}/category/' + id +'">الكل</a></li>');
                     $.each(response.sub_categories, function (key, val) {
                        $('#cat-tree-3').append('<li><a class="font-15px" href="/{{app()->getLocale()}}/category/product/' + val.code +'">' + val.label + '</a></li>')
                     });
                  }else{   
                        $('#sub_categories').html('<option>اختر</option>')
                  }
                  }
               });
         });
         $('#bags-product').click(function () {
         $('.Clothes').hide();
         $('.bags').show();  
         })
      </script>
      @if( session()->has('msg_status') == 'success')
         <script>
            $( document ).ready(function(){
               swal('{{session('msg_title')}}', '{{session('msg_content')}}', '{{session('msg_status')}}');
         });
         </script>
      @endif
      @yield('aimeos_scripts')
	   @yield('js')
   </body>
</html>

