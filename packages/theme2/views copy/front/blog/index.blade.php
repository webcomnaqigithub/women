@extends('base')

@section('content') 
<div class="bigen-container-Blog "  >
    <!-- Breadcrumbs -->
    <div class="container">
        <div class="breadcrumbs ">
            <ul>
                <li><a href="{{ airoute('aimeos_home', ['site' => 'default']) }}">{{aitrans('Main', [], 'client')}}</a></li>
                <li class="active"><a><i class="fa fa-angle-left" aria-hidden="true"></i>{{aitrans('Blog', [], 'client')}}</a></li>
            </ul>
        </div>
    </div>
    <div class="container  ">
        <div class="search-shop  ">
            <div>{{aitrans('research results', [], 'client')}}</div>
            <div> {{aitrans('result', [], 'client')}}  {{$blogs->count()}}</div>
            <div class="search-input">
                <div class="input-icon">
                <input type="text" class="input-icon-radius form-control" placeholder="{{aitrans('Looking for posts', [], 'client')}}">
                <button class="btn clear-input cursor-pointer round-20 mt-cust f-left d-none">
                <i class="fa fa-times-circle"></i>
                </button>
                <button class="btn btn-search  btn-danger cursor-pointer round-20 mt-cust f-left">
                <i class="fa fa-search"></i>
                </button>
                </div>
            </div>
        </div>
    </div>
    <div class="container Blog-content ">
        <div class="row">
            @foreach ($blogs as $item)
                <a href="{{route('front.blog.show', ['locale'=> app()->getlocale(), 'id'=> $item->id])}}" class="col-md-4">
                    <div class="Blog-img">
                    <img src="{{json_decode($item->images)[0] ?? ''}}">
                    </div>
                    <div class=" Blog-detail" style="line-height: 1.5;">
                    <img src="{{asset('front/images/icon/Calendar.svg')}}">
                    <span>{{Carbon\Carbon::parse($item->created_at)->format('M d Y')}}</span>
                    <img src="{{asset('front/images/icon/Category.svg')}}">
                    <span>{{$item->tag}}</span>
                    </div>
                    <div class=" Blog-Brief" style="line-height: 1.5;">
                        {{$item->title}}
                    </div>
                </a>
            @endforeach
        </div>
    </div>
    </div>
@endsection
