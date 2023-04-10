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
     <link rel="stylesheet" type="text/css" href="{{asset('front/js/plugins/themify-icons/themify-icons.css')}}">
      <link rel="stylesheet" type="text/css" href="{{asset('front/styles/main_styles.css')}}">
      <link rel="stylesheet" type="text/css" href="{{asset('front/styles/responsive.css')}}">
      {{-- <link rel="stylesheet" type="text/css" href="{{asset('front/styles/single_styles.css')}}">
      <link rel="stylesheet" type="text/css" href="{{asset('front/styles/single_responsive.css')}}"> --}}
      @if( in_array(app()->getLocale(), ['ar', 'az', 'dv', 'fa', 'he', 'ku', 'ur']) )
         {{-- <link type="text/css" rel="stylesheet" href="{{ asset('vendor/shop/themes/default/app.rtl.css?v=' . config( 'shop.version', 1 ) ) }}"> --}}
      @else
         {{-- <link type="text/css" rel="stylesheet" href="{{ asset('vendor/shop/themes/default/app.css?v=' . config( 'shop.version', 1 ) ) }}"> --}}
      @endif
      {{-- <link type="text/css" rel="stylesheet" href="{{ asset('vendor/shop/themes/default/aimeos.css?v=' . config( 'shop.version', 1 ) ) }}" /> --}}

      @yield('aimeos_header')
      @yield('css')
   </head>
   <body dir="rtl" class="{{ $page ?? '' }}">


		 {{-- @yield('aimeos_stage') --}}
		 @yield('aimeos_body')
		 @yield('content')


      <!-- Footer -->
      <script src="{{asset('front/js/jquery-3.2.1.min.js')}}"></script>
      <script src="{{asset('front/js/lottie_5.5.0.js')}}"></script>
      <script src="{{asset('front/js/lottie-player.js')}}"></script>
      <script src="{{asset('front/styles/bootstrap/js/popper.js')}}"></script>
      <script src="{{asset('front/styles/bootstrap/js/bootstrap.min.js')}}"></script>
      <script src="{{asset('front/js/plugins/Isotope/isotope.pkgd.min.js')}}"></script>
      <script src="{{asset('front/js/plugins/OwlCarousel2-2.2.1/owl.carousel.js')}}"></script>
      <script src="{{asset('front/js/plugins/easing/easing.js')}}"></script>
      <script src="{{asset('front/js/plugins/jquery-ui-1.12.1.custom/jquery-ui.js')}}"></script>
      <script src="{{asset('front/js/single_custom.js')}}"></script>
      <script src="{{asset('front/js/categories_custom.js')}}"></script>
      <script src="{{asset('front/js/custom.js')}}"></script>
      {{-- <script src="{{ asset('vendor/shop/themes/default/app.js?v=' . config( 'shop.version', 1 ) ) }}"></script>
		<script src="{{ asset('vendor/shop/themes/default/aimeos.js?v=' . config( 'shop.version', 1 ) ) }}"></script> --}}
		@yield('aimeos_scripts')
	   @yield('js')
   </body>
</html>