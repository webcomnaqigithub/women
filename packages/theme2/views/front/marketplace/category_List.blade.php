@extends('base')
@section('title') Category List | بازار - Bazaar @endsection

@section('content')
<div class="bigen-container-Shop-by ">
	<!-- Breadcrumbs -->
	<div class="container">
	   <div class="breadcrumbs d-flex flex-row align-items-center ">
		  <ul>
			 <li><a href="{{ airoute('aimeos_home', ['site' => 'default']) }}">{{aitrans('Main', [], 'client')}}</a></li>
			 <li><a><i class="fa fa-angle-left" aria-hidden="true"></i>{{aitrans('Shop by', [], 'client')}}</a></li>
			 <li class="active"><a><i class="fa fa-angle-left" aria-hidden="true"></i>{{$cat->label}}</a></li>
		  </ul>
	   </div>
	</div>
	<!--  search  -->
	<div class="container  ">
	   <div class="Shop-by  ">
		  <div>{{$cat->label}}</div>
		  <div>{{aitrans('All', [], 'client')}}</div>
	   </div>
	</div>
	<!--  content Shop-by -->
	<div class="container  ">
	   <div class="row">
		   @foreach ($subcategories as $item)
				<div class="col-md-3 text-center mb-5">
					<a href="{{route('front.product.category_shopping', ['locale'=>app()->getLocale(), 'code'=>$item->code])}}" class="img-Shop-by">
						<img src="/aimeos/{{$item->getRefItems('media')->first()->getPreview()}}">
					</a>
					<div class="title-img-shop-by">{{$item->getLabel()}}</div>
				</div>
		   @endforeach
	   </div>
	</div>
 </div>
@endsection

@section('js')
 
@endsection