@extends('base')
@section('title') Stores | بازار - Bazaar @endsection

@section('content') 
	<!-- container  -->
	<div class="bigen-container-shop "  >
		<!-- Breadcrumbs -->
		<div class="container">
			<div class="breadcrumbs">
				<ul>
					<li><a href="{{ airoute('aimeos_home', ['site' => 'default']) }}"> {{aitrans('Main', [], 'client')}}</a></li>
					<li class="active"><a href="#"><i class="fa fa-angle-left" aria-hidden="true"></i>المتاجر</a></li>
				</ul>
			</div>
		</div>
		<!-- search shop -->
		<div class="container  ">
			<div class="search-shop  ">
			<div>{{aitrans('Shops', [], 'client')}}</div>
			<div> {{$stores->count()}}  {{aitrans('result', [], 'client')}}</div>
			<div class="search-input">
                <form action="{{airoute('front.store.index')}}" method="GET">
                    <div class="input-icon">
                        <input type="text" name="key" class="input-icon-radius form-control" placeholder="{{aitrans('Search', [], 'client')}}  ">
                        {{-- <button class="btn clear-input cursor-pointer round-20 mt-cust f-left">
                            <i class="fa fa-times-circle"></i>
                        </button> --}}
                        <button type="submit" class="btn btn-danger cursor-pointer round-20 mt-cust f-left">
                            <i class="fa fa-search"></i>
                        </button>
                            
                    </div>
                </form>
			</div>
			</div>
		</div>
		<!-- All Store -->
		<div class="container All-Store">
			<div class="row"> 
                @foreach ($stores->toArray() as $item) 
                    <div class="col-lg-3 store-card">
                        <a href="shop/{{$item->code}}">
                            <div class="store-card-details">
                                <div class="store-background-img">
                                    <img src="{{asset('front/images/blog_3.jpg')}}">
                                </div>
                                <div class="store-logo">
                                    <img  src="{{asset($item['locale.site.icon'])}}">
                                </div>
                                <div class="store-name">
                                        {{$item->label}}
                                </div>
                                <div class="store-rating">
                                    {{str_repeat('<i class="star_rating fa fa-star" aria-hidden="true"></i>', $item->rating)}}
                                    {{$item->rating}}  
                                </div>
                                <div class="store-go-to">
                                    <button class="btn cursor-pointer mt-2 ">
                                      {{aitrans('Browse the store', [], 'client')}}
                                    </button>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
				
			</div>
		</div>
	</div>
@endsection
