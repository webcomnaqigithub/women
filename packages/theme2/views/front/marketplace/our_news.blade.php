@extends('base')
@section('title') Our New | بازار - Bazaar @endsection

@section('content')
<div class="bigen-container-shop-data ">
	<!-- Breadcrumbs -->
	<div class="container">
	<div class="breadcrumbs d-flex flex-row align-items-center ">
		<ul>
			<li><a href="{{ airoute('aimeos_home', ['site' => 'default']) }}">{{aitrans('Main', [], 'client')}}</a></li>
			<li class="active"><a><i class="fa fa-angle-left" aria-hidden="true"></i>{{aitrans('our new', [], 'client')}}</a></li>
		</ul>
	</div>
	</div>
	<!--  search  -->
	<div class="container  ">
	<div class="search-shop  ">
		<div>{{aitrans('our new', [], 'client')}}</div>
		<div>{{$productItems->count()}} {{aitrans('result', [], 'client')}}</div>
		<div class="search-input">
			<div class="input-icon">
				<input type="text" name="sk" class="input-icon-radius form-control" value="{{$request->sk}}" placeholder="{{aitrans('embroidery handbag', [], 'client')}}" form="product_shopping">
				{{-- <button class="btn clear-input cursor-pointer round-20 mt-cust f-left">
				<i class="fa fa-times-circle"></i>
				</button> --}}
				<button type="submit" class="btn btn-danger cursor-pointer round-20 mt-cust f-left" form="product_shopping">
				<i class="fa fa-search"></i>
				</button>
			</div>
		</div>
	</div>
	</div>
	<!--  search filter -->
	<div class="container">
	<div class="row ">
		<div class="col-lg-12 d-flex-space-between">
			<div id="filter" class="filter-hide">
				<div class="d-flex-space-between">
				<div>
					<img src="{{asset('front/images/icon/Filter.svg')}}">
					  {{aitrans('filter', [], 'client')}}
				</div>
				<img class="filter-icon-show" src="{{asset('front/images/icon/filter-show.svg')}}">
				<img class="filter-icon-hide d-none" class="d-none" src="{{asset('front/images/icon/filter-hide.svg')}}">
				</div>
			</div>
			<select onchange="$('#product_shopping').submit()" name="f_sort" form="product_shopping">
				<option value="">{{aitrans('sort by', [], 'client')}}</option>
				<option value="ctime">{{aitrans('Older', [], 'client')}}</option>
				<option value="rating">{{aitrans('Rating', [], 'client')}}</option>
				<option value="name">{{aitrans('Product', [], 'client')}}</option>
		   </select>
		</div>
	</div>
	<div class="row">
		<div class="filter-option d-none">
			<form action="{{airoute('front.ournews')}}" method="GET" id="product_shopping">
				<div class="sidebar">
					<!-- Elements -->
					<div class="row ">
					<div class="sidebar_section mt-2">
						<ul class="checkboxes">
							{{-- <li><input type="radio" name="" id="">&nbsp;<span>{{aitrans('Product Rating', [], 'client')}}</span></li> --}}
							{{-- <li><i class="fa fa-square-o" aria-hidden="true"></i><span>{{aitrans('We rate the seller', [], 'client')}}</span></li> --}}
							<li><i class="fa fa-square-o" aria-hidden="true"></i><span>{{aitrans('Price', [], 'client')}}</span></li>
							<li class="">
								<div class="d-flex price">
									<input type="number" name="l_price" value="{{$request->l_price}}" class="input-price form-control " placeholder="{{aitrans('from', [], 'client')}}">
									<span class="px-2"> -- </span>
									<input type="number" name="h_price" value="{{$request->h_price}}" class="input-price form-control" placeholder="{{aitrans('to', [], 'client')}}">
								</div>
							</li>
						</ul>
					</div>
					</div>
					<!-- SEctions -->
					<div class="row ">
					<div class="sidebar_section">
						<div class="row ">
							<span class="col-9 d-flex justify-content-start sidebar_title">
								<h5> {{aitrans('sections', [], 'client')}}</h5>
							</span>
							<span class="col-3 d-flex justify-content-end">
							<i class="fa fa-angle-up"></i>
							</span>
						</div>
						<ul class="checkboxes ">
							@foreach ($sub_categories as $item)
								<li>
									<input type="radio" value="{{$item->getId()}}" id="{{$item->getCode()}}" name="categoryId" @if($request->categoryId == $item->getId()) checked @endif>&nbsp;
									<label for="{{$item->getCode()}}">{{$item->label}}</label><span class="f-left"></span>
								</li>
							@endforeach
							
						</ul>
					</div>
					</div> 
					<!-- size -->
					<div class="row ">
					<div class="sidebar_section">
						<div class="row ">
							<span class="col-9 d-flex justify-content-start sidebar_title">
								<h5>  {{aitrans('Size', [], 'client')}}</h5>
							</span>
							<span class="col-3 d-flex justify-content-end">
							<i class="fa fa-angle-down"></i>
							</span>
						</div>
						<ul class="checkboxes ">
							@foreach ($attributes as $item)
								<li><input type="radio" name="attributeId" value="{{$item->getId()}}" id="{{$item->getCode()}}" @if($request->attributeId == $item->getId()) checked @endif>&nbsp; <label for="{{$item->getCode()}}">{{$item->getLabel()}}</label></li> 
							@endforeach
							{{-- <li><input type="radio" name="f_attrid[]" id="2xl">&nbsp; <label for="2xl">2XL</label></li> 
							<li><input type="radio" name="f_attrid[]" id="xl">&nbsp; <label for="xl">XL</label></li> 
							<li><input type="radio" name="f_attrid[]" id="l">&nbsp; <label for="l">L</label></li> 
							<li><input type="radio" name="f_attrid[]" id="m">&nbsp; <label for="m">M</label></li> 
							<li><input type="radio" name="f_attrid[]" id="s">&nbsp; <label for="s">S</label></li>  --}}
						</ul>
					</div>
					</div>
				</div>
			</form>
		</div>
		<div class="filter-content col-md-12">
			<div class="row mt-3">
				@foreach ($productItems as $productItem)
					<div class="store-categories col-md-3 mb-5 discount">
						<div class="store-categories-details">
							<a href="{{airoute('aimeos_shop_detail', ['d_name' => $productItem->getName( 'url' ), 'd_prodid' => $productItem->getId(), 'locale'=>app()->getLocale(), 'site'=>'default'])}}">
								<div class="store-categories-img">
									<?php foreach( $productItem->getRefItems('media') as $media ) : ?>
										<img src="/aimeos/{{$media->getPreview()}}" >
										<?php break; ?>
									<?php endforeach ?>	
								</div>
							</a>
							<div class="favorite favorite_left button-Products-like" data-d_prodid="{{$productItem->getId()}}" data-d_name="{{$productItem->getLabel()}}"></div>
							<a href="{{airoute('aimeos_shop_detail', ['d_name' => $productItem->getName( 'url' ), 'd_prodid' => $productItem->getId(), 'locale'=>app()->getLocale(), 'site'=>'default'])}}">
								<div class="product_info l-h-product-info">
									<div class="row ">
										<div class="col-6">
										<div class=" text-right">
											<span>
												@foreach($productItem->getRefItems('catalog')->getNode() as $item)
													@if($item->status == 1 && $item->level)
														{{$item->label}}
														@break
													@endif
												@endforeach
											</span>
										</div>
										</div>  
										<div class="col-6">
										<div class=" text-left">
											<i class="star_rating fa fa-star" aria-hidden="true"></i> <span>
											{{$productItem->getRating() ?? '0.0'}}</span>
										</div>
										</div>
									</div>
									<div class="row">
										<div class="col-12 product_title text-right">
										{{$productItem->getLabel()}}
										</div>
									</div>
									<div class="row ">
										<?php foreach( $productItem->getRefItems('price') as $price ) : ?>
											<div class="col-7 text-right" >
												<div class="product_price ">
													{{$price->getValue() . ' ' . aitrans( $price->getCurrencyid(), [],'client' )}}
													@if($price->getRebate() > 0)		
														<span>{{$price->getValue() + ($price->getValue() * $price->getRebate()/100)}}</span>
													@endif 
												</div>
											</div>
											<?php if($price->getRebate() != 0 ) : ?>
												<div class="col-5 text-left">
													<div class="product_bubble_decount ">
														{{ $price->getRebate() . ' %' }}   {{aitrans('Discount', [], 'client')}}
													</div>
												</div>
											<?php endif ?>
											<?php break; ?>
										<?php endforeach ?>
									</div>
								</div>
							</a>
						</div>
					</div>
				@endforeach
			</div>
			<!--  navigation  -->
			{{-- <nav aria-label="..." class="my-3">
				<ul class="pagination">
				<li class="page-item">
					<a class="page-link" href="#" tabindex="-1"><i class="fa fa fa-angle-right"></i></a>
				</li>
				<li class="page-item active"><a class="page-link" href="#">1</a></li>
				<li class="page-item"><a class="page-link" href="#">2</a></li>
				<li class="page-item"><a class="page-link" href="#">3</a></li>
				<li class="page-item"><a class="page-link" href="#">4</a></li>
				<li class="page-item"><a class="page-link" href="#">5</a></li>
				<li class="page-item"><a class="page-link" href="#">6</a></li>
				<li class="page-item">
					<a class="page-link" href="#"><i class="fa fa fa-angle-left"></i></a>
				</li>
				</ul>
			</nav> --}}
		</div>
	</div>
	</div>
	{{-- <div class="container">
		<div class="row justify-content-center">
			<nav aria-label="..." class="my-3">
				<ul class="pagination">
					<li class="page-item">
						<a class="page-link" href="#" tabindex="-1"><i class="fa fa fa-angle-right"></i></a>
					</li>
					<li class="page-item active"><a class="page-link" href="#">1</a></li>
					<li class="page-item"><a class="page-link" href="#">2</a></li>
					<li class="page-item"><a class="page-link" href="#">3</a></li>
					<li class="page-item"><a class="page-link" href="#">4</a></li>
					<li class="page-item"><a class="page-link" href="#">5</a></li>
					<li class="page-item"><a class="page-link" href="#">6</a></li>

					<li class="page-item">
						<a class="page-link" href="#"><i class="fa fa fa-angle-left"></i></a>
					</li>
				</ul>
			</nav>
		</div>
	</div> --}}
</div>

@endsection

@section('js')
<script>
	$('#filter').click(function () {
		$('.filter-icon-show').toggleClass('filter-icon-show  filter-icon-show d-none');
		$('.filter-icon-hide').toggleClass('filter-icon-hide d-none filter-icon-hide');
		$('#filter').toggleClass('filter-hide filter-show');
		$('.filter-option').toggleClass('filter-option  d-none filter-option filter-option-show col-md-3  ');
		$('.filter-content').toggleClass('filter-content col-md-12 filter-content col-md-9');
		$('.store-categories').toggleClass('store-categories col-md-3 mb-5 store-categories col-md-4 mb-5');
	});
</script>
<script>
	$('input[type=radio]').on('change', function() {
    	$(this).closest("form").submit();
});
</script>
<script>
	$('.button-Products-like').click(function(){
		let d_name = $(this).data('d_name');
		let d_prodid = $(this).data('d_prodid')
		$.ajax({
			type:"post",
			url: '/ar/profile/default/favorite',
			data:{
				fav_action:'add',
				fav_id:d_prodid,
				d_prodid:d_prodid,
				d_name:d_name,
				// d_pos:0,
				_token:"{{ csrf_token() }}",
			},
			success: function(response) {
				if(response)
				{
					$(".Add-To-Cart svg").show();
					// menu.play();
				}
			}
		});
	});
</script>
@endsection