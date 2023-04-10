@extends('base')
@section('title') Notifications | بازار - Bazaar @endsection

@section('content')
<div class="bigen-container-shop-data mb-3 ">
	<!-- Breadcrumbs -->
	<div class="container">
	<div class="breadcrumbs ">
		<ul>
			<li><a href="{{ airoute('aimeos_home', ['site' => 'default']) }}">{{aitrans('Main', [], 'client')}}</a></li>
			<li><a href="/<?= app()->getLocale() . '/profile/' . app('aimeos.context')->get()->locale()->getSiteItem()->getCode()?>"><i class="fa fa-angle-left" aria-hidden="true"></i>{{aitrans('Profile personly', [], 'client')}}</a></li>
			<li class="active"><a href="#"><i class="fa fa-angle-left" aria-hidden="true"></i>{{aitrans('Alerts', [], 'client')}}</a></li>
		</ul>
	</div>
	</div>
	<div class="container">
	<div class="row ">
		<div class="col-6">
			<h5> {{aitrans('Attention', [], 'client')}} {{count($orders)}}</h5>
		</div>
		<div class="col-6  d-flex justify-content-end">
			<ul class="product_sorting">
				<li>
				<span class="type_sorting_text">
				<i class="fa fa-filter f-right"></i>
				 {{aitrans('sort by', [], 'client')}}
				</span>
				<i class="fa fa-angle-down"></i>
				<ul class="sorting_type">
					<li class="type_sorting_btn" data-isotope-option="{ &quot;sortBy&quot;: &quot;original-order&quot; }"><span> {{aitrans('Elements', [], 'client')}}</span></li>
					<li class="type_sorting_btn" data-isotope-option="{ &quot;sortBy&quot;: &quot;price&quot; }"><span> {{aitrans('Price', [], 'client')}}</span></li>
					<li class="type_sorting_btn" data-isotope-option="{ &quot;sortBy&quot;: &quot;name&quot; }"><span> {{aitrans('Product', [], 'client')}}</span></li>
				</ul>
				</li>
			</ul>
		</div>
	</div>
	</div>
	<div class="container">
	<div class="row mt-2">
		@foreach ($orders as $item)
			<div class="col-12 notifications">
				<div class="notifications_col d-flex ">
					<div class="user-Reviews-img">
					<img src="{{asset('front/images/User-avatar.png')}}">
					</div>
					<div class="review">
					<div class="user_name">
						@foreach($item->getBaseItem()->getAddress(\Aimeos\MShop\Order\Item\Base\Address\Base::TYPE_PAYMENT) as $address)
							{{$address->getFirstName() . ' ' . $address->getFirstName()}}
							@break
						@endforeach
					</div>
					<div class="review_date">{{$item->getBaseItem()['order.base.mtime']}}</div>
					<div class="review-word">
						@foreach($item->getBaseItem()->getProducts() as $product)
							{{$product->getName()}}
							@break
						@endforeach
					</div>
					</div>
				</div>
			</div>
		@endforeach
	</div>
	</div>
</div>
@endsection

@section('js')

@endsection