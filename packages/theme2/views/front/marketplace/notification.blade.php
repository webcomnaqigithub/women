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
			<h5> {{count($Notifications)}} {{aitrans('Attention', [], 'client')}} </h5>
		</div>
		 
	</div>
	</div>
	<div class="container">
	<div class="row mt-2">
		@foreach ($Notifications as $item) 
			<div class="col-12 notifications">
				<a href="{{$item->path}}">
					<div class="notifications_col d-flex ">
						<div class="user-Reviews-img"> 
						<img src="{{asset($item->receiver_image)}}">
						</div>
						<div class="review">
						<div class="user_name">
							{{$item->receiver_name}}
							@php($diffInDays = \Carbon\Carbon::parse($item->created_at)->diffInDays())
							@php($showDiff = \Carbon\Carbon::parse($item->created_at)->diffForHumans())
							<div>{{$showDiff}}</div>
						</div>
						<div class="review-word">
							{{$item->content}}  {{$item->product_name}}
						</div>
						</div>
					</div>
				</a>
			</div>
		@endforeach
	</div>
	</div>
</div>
@endsection

@section('js')

@endsection