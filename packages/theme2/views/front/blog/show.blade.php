@extends('base')

@section('content')
<div class="bigen-container-Blog ">
   <!-- Breadcrumbs -->
   <div class="container">
      <div class="breadcrumbs ">
         <ul>
            <li><a href="{{ airoute('aimeos_home', ['site' => 'default']) }}">{{aitrans('Main', [], 'client')}}</a></li>
            <li class="active"><a href="#"><i class="fa fa-angle-left" aria-hidden="true"></i>{{aitrans('Blog', [], 'client')}}</a></li>
            {{-- <li class="active"><a><i class="fa fa-angle-left" aria-hidden="true"></i>نعمل على ...</a></li> --}}
         </ul>
      </div>
   </div>
   <div class="container Blog-detail-content ">
      <div class="row my-1">
         <div class="col-md-12 Blog-detail-main-img">
            <img src="{{json_decode($blog->images)[0] ?? ''}}">
         </div>
      </div>
      <div class="row my-2">
         <div class="col-md-12">
            <div class="title">
               {{$blog->title}}
            </div>
            <div class="row Blog-detail">
               <div class="">
                  <img src="{{asset('front/images/icon/eye.svg')}}">
                  <span>{{$blog->views}}  مشاهدة</span>
               </div>
               <div class="border-cust ">
                  <img src="{{asset('front/images/icon/user.svg')}}">
                  <span>{{$blog->writer}}</span>
               </div>
               <div class="border-cust ">
                  <img src="{{asset('front/images/icon/Category.svg')}}">
                  <span>{{$blog->tag}}</span>
               </div>
               <div class="border-cust ">
                  <img src="{{asset('front/images/icon/Calendar.svg')}}">
                  <span>{{Carbon\Carbon::parse($blog->created_at)->format('M d Y')}}</span>
               </div>
               <div class="border-cust">
                  <img src="{{asset('front/images/icon/Location.svg')}}">
                  <span>{{$blog->country}} - {{$blog->city}}</span>
               </div>
            </div>
         </div>
      </div>
      <div class="row my-2">
         <div class="col-md-4 Blog-detail-other-img">
            <img src="{{json_decode($blog->images)[1] ?? ''}}">
         </div>
      </div>
      <div class="row my-2 paragraph">
         <div class="col-md-6 ">
            {!! $blog->description !!}
         </div>
      </div>
      <div class="row my-2">
         <div class="col-md-4 Blog-detail-other-img">
            <img src="{{json_decode($blog->images)[2] ?? ''}}">
         </div>
      </div>
      <div class="row mt-4">
         <div class="col-lg-7">
            <h4>{{aitrans('Share', [], 'client')}}</h4>
            <div class="social-media d-flex">
               <button class="btn ml-4 btn-About-facebook  btn-outline-light cursor-pointer round">
               <i class="fa fa-facebook"></i>
               {{aitrans('Facebook', [], 'client')}}
               </button>
               <button class="btn  ml-4 btn-About-instagram  btn-outline-light cursor-pointer round">
               <i class="fa fa-instagram"></i>
               {{aitrans('Whats Up', [], 'client')}}
               </button>
               <button class="btn  ml-4 btn-About-twitter  btn-outline-light cursor-pointer round">
               <i class="fa fa-twitter"></i>
               {{aitrans('Telegram', [], 'client')}}
               </button>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
@section('js')

@endsection