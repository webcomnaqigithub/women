<!DOCTYPE html>
<html lang="en">
<head>
	<title> @yield('title') -Shop</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="description" content="Colo Shop Template">
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="{{asset('front/styles/bootstrap/css/bootstrap-rtl.css')}}">
	<link href="{{asset('front/js/plugins/font-awesome-4.7.0/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="{{asset('front/styles/main_styles.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('front/styles/responsive.css')}}">
	@yield('css')
</head>
<body dir="rtl">

	@yield('content')
	
	<div class="Register-Shop-Footer  " >
		<a href="#"  data-toggle="modal" data-target="#languages-modal" class="d-flex cursor-pointer text-white">
		   <img src="{{asset('front/images/logo/language.png')}}" width="18" height="18" class="mt-1 ml-1">
		   العربية
		   <div>
			  <svg id="expand_more_black_24dp" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24">
				 <path id="Path_13265" data-name="Path 13265" d="M24,24H0V0H24Z" fill="none" opacity="0.87"/>
				 <path id="Path_13266" data-name="Path 13266" d="M15.88,9.29,12,13.17,8.12,9.29A1,1,0,0,0,6.71,10.7l4.59,4.59a1,1,0,0,0,1.41,0L17.3,10.7a1,1,0,0,0,0-1.41,1.017,1.017,0,0,0-1.42,0Z" fill="#525457"/>
			  </svg>
		   </div>
		</a>
		<div>
			 {{aitrans('All rights reserved to ', [], 'client')}} <a href="https://mowa.gov.ps/" target="_blank">{{aitrans('Ministry of Women Affairs', [], 'client')}}</a> © 2022
		</div>
		<div>
		</div>
	 </div>
	<script>
		function nextstep(){
			$('#section1').hide();
			$('#section2').show();
		}
		function myFunction() {
			var checkBox = document.getElementById("myCheck");
			var text = document.getElementById("text");
			if (checkBox.checked == true){
				$('.join').removeClass('btn-dark');
				$('.join').addClass('btn-danger');
			} else {
				$('.join').removeClass('btn-danger');
				$('.join').addClass('btn-dark');
			}
		}
	</script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	{{-- <script src="{{asset('front/js/jquery-3.2.1.min.js')}}"></script> --}}
	<script src="{{asset('front/styles/bootstrap/js/popper.js')}}"></script>
	<script src="{{asset('front/styles/bootstrap/js/bootstrap.min.js')}}"></script>
	@yield('js')
</body>
</html>
