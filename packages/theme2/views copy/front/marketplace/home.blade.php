@extends('base')
@section('title') Home | بازار - Bazaar @endsection

@section('content')
<!-- container  -->
	<div class="bigen-container">
		<div class="container "  id="container-carousel" >
			<!-- Banner  -->
			<div id="demo" class="carousel slide p-n" data-ride="carousel">
				<!-- Indicators -->
				<ul class="carousel-indicators">
					@if($sliders)
						<?php $x = 1 ;?>
						@foreach ($sliders as $key=>$item)
							<li data-target="#demo" data-slide-to="{{$key}}" {{$x==1 ? 'class="active"' : ''}} <?php $x++;?>></li>
						@endforeach
					@endif
				</ul>
				<!-- The slideshow -->
				<div class="carousel-inner" >
					@if($sliders)
						<?php $x = 1 ;?>
						@foreach ($sliders as $item)
							<div class="carousel-item carousel-item-slider carousel-item-slider-title {{$x==1 ? 'active' : ''}} <?php $x++;?>" style="background-image: url({{$item->image}});">
								<div class="carousel-slider">
									@if($item->header)
										<h1 class="title-lider font-weight-bold">{{$item->header}}</h1><br>
									@endif
									@if($item->subheader)
										<h1 class="title-lider text-danger mt-10px font-weight-bold">{{$item->subheader}}</h1><br>
									@endif
									@if($item->body)
										<h5 class="  font-weight-normal mt-10px">{{$item->body}}</h5><br>
									@endif
									@if($item->link)
										<button class=" dark_button shop_now_button mt-10px"><a href="{{$item->link}}">{{aitrans('Shop now', [], 'client')}}</a></button>
									@endif
								</div>
							</div>
						@endforeach
					@endif

				</div>
				<!-- Left and right controls -->
				<a  class="carousel-control-prev" href="#demo" data-slide="prev">
				<span id="prev" class="carousel-circle carousel-control-prev-icon"></span>
				</a>
				<a  class="carousel-control-next" href="#demo" data-slide="next">
				<span id="next" class="carousel-circle carousel-control-next-icon"></span>
				</a>
			</div>
		</div>
	</div>

	<!-- Benefit -->
	<br>
	<div class="benefit">
		<div class="container">
			<div class="row benefit_row ">
				<!-- سياسة الارجاع -->
				<div class="col-lg-3 benefit_col">
					<div class="benefit_item b-l d-flex flex-row ">
						<div class="benefit_icon d-flex">
							<img src="{{asset('front/images/icon/Return Policy.svg')}}">						  
						</div>
						<div class="benefit_details">
							<div class="details-title">{{aitrans('Return Policy', [], 'client')}}</div>
							<div class="details-sub-title">100%{{aitrans('money back guarantee', [], 'client')}}</div>
							
						</div>
				
					</div>
				</div>
				<!-- طرق دفع آمنة -->
				<div class="col-lg-3 benefit_col">
					<div class="benefit_item b-l d-flex flex-row ">
						<div class="benefit_icon d-flex">
							<img src="{{asset('front/images/icon/Safe Payment Methods.svg')}}">						  
						</div>
						<div class="benefit_details">
							<div class="details-title">{{aitrans('Safe Payment Methods', [], 'client')}}</div>
							<div class="details-sub-title">{{aitrans('multi payment', [], 'client')}}</div>
							
						</div>
				
					</div>
				</div>
				<!-- مركز المساعدة -->
				<div class="col-lg-3 benefit_col">
					<div class="benefit_item b-l d-flex flex-row ">
						<div class="benefit_icon d-flex">
							<img src="{{asset('front/images/icon/Help Center.svg')}}">
						</div>
						<div class="benefit_details">
							<div class="details-title">{{aitrans('Help Center', [], 'client')}}</div>
							<div class="details-sub-title">{{aitrans('24/7 support system', [], 'client')}}</div>
							
						</div>
				
					</div>
				</div>
				<!-- شحن لجميع الدول -->
				<div class="col-lg-3 benefit_col">
					<div class="benefit_item d-flex flex-row ">
						<div class="benefit_icon d-flex">
							<img src="{{asset('front/images/icon/Shipping to all countries.svg')}}">
						</div>
						<div class="benefit_details">
							<div class="details-title">{{aitrans('Shipping to all countries', [], 'client')}}</div>
							<div class="details-sub-title">{{aitrans('fast and instant', [], 'client')}}</div>
							
						</div>
				
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Shop by category -->
	<div class="Shop_category">
		<div class="container">
			<div class="row">
				<div class="col text-center">
					<div class="section_title Shop_category_title">
						<label class="store_by_lable">{{aitrans('Shop by category', [], 'client')}}</label>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col">
					<div class="category_slider_container">
						<div class="owl-carousel-circl owl-theme category_slider">
							@foreach ($sub_categoriess as $item)
									<div class="owl-item category_slider_item">
										
											<div class="product-item-circle">
												<a href="{{route('front.product.category_shopping', ['locale'=>app()->getLocale(), 'code'=>$item->code])}}" >
													<div class="product_image">
														@foreach ($item->getRefItems('media') as $media)
															<img src="/aimeos/{{$media->getPreview()}}" class="image--cover" loading="lazy">
															@break
														@endforeach
													</div>
												</a>
											</div>
											<div class="favorite favorite_left button-Products-like"></div>
											<a href="{{route('front.product.category_shopping', ['locale'=>app()->getLocale(), 'code'=>$item->code])}}" >
												<div class="product_info">
													<h3 class="product_name text-center"><a>{{$item->label}}</a></h6>
												</div>
											</a>
									</div>
							@endforeach
						</div>

						<!-- Slider Navigation -->
					 

						
						<div class="carousel-circle category_slider_nav_left category_slider_nav_left-best-sellers category_slider_nav d-flex align-items-center justify-content-center flex-column">
							<i class="fa fa-chevron-left" aria-hidden="true"></i>
						</div>
						<div class="carousel-circle category_slider_nav_right category_slider_nav_right-best-sellers category_slider_nav d-flex align-items-center justify-content-center flex-column">
							<i class="fa fa-chevron-right" aria-hidden="true"></i>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Best Sellers -->
	<div class="best_sellers">	
		<div class="container">
				{{-- <div class="col-6"> --}}
					<div class=" d-flex flex-sm-row flex-column justify-content-between text-center">
						<h2>{{aitrans('Best seller', [], 'client')}}</h2>
						<a href="{{'/' . app()->getLocale() . '/category/product/best-sellers'}}"><h6>{{aitrans('view all', [], 'client')}}</h4></a>

					</div>
				{{-- </div> --}}
				{{-- <div class="col-6 mt-25px"> --}}
					{{-- <div class=" d-flex flex-row align-items-center justify-content-lg-end justify-content-center">
					</div> --}}
				{{-- </div> --}}
			<div class="row">
				<div class="col">
					<div class="product_slider_container1" style="margin-top: 5px;">
						<div class="owl-carousel owl-theme product_slider1">
							@foreach ($best_seller_products as $productItem)
								<div class="owl-item product_slider_item1"> 
										<div class="product-item">
											<div class="product discount">
												<a href="{{airoute('aimeos_shop_list', ['locale'=>app()->getLocale(), 'site'=>'default']). '/' . $productItem->getUrl()}}">
													<div class="product_image">
														<?php foreach( $productItem->getRefItems('media') as $media ) : ?>
															<img src="/aimeos/{{$media->getPreview()}}"  loading="lazy">
															<?php break; ?>
														<?php endforeach ?>											
													</div>
												</a>
												<div class="favorite favorite_left button-Products-like" data-d_prodid="{{$productItem->getId()}}" data-d_name="{{$productItem->getLabel()}}"></div>
												@if($productItem->getRefItems('price')->getRebate()->first() > 0)
													<div class="product_bubble Best-Offers d-flex flex-column align-items-center">
														<span>خصم {{$productItem->getRefItems('price')->getRebate()->first()}}%</span>
													</div>
												@endif
												{{-- <div class="product_bubble product_bubble_right product_bubble_green d-flex flex-column align-items-center"><span style="padding-top: 7px;">جديد</span></div> --}}
												<a href="{{airoute('aimeos_shop_list', ['locale'=>app()->getLocale(), 'site'=>'default']). '/' . $productItem->getUrl()}}">
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
																<i class="star_rating fa fa-star" aria-hidden="true"></i> 
																<span>
																	<?= $productItem->rating ?? '0.0'?>
																</span>
															</div>
														</div>
														</div>
														<div class="product_title ">{{$productItem->getLabel()}}</div>
														<div class="row ">
															<?php foreach( $productItem->getRefItems('price') as $price ) : ?>
																<div class="col-7">
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
																			{{ $price->getRebate() . ' %' }}  {{aitrans('Discount', [], 'client')}}
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
								</div>
							@endforeach
						</div>

						<!-- Slider Navigation -->
						<div class="carousel-circle product_slider_nav_left1 product_slider_nav_left-best-sellers1 product_slider_nav1 d-flex align-items-center justify-content-center flex-column">
							<i class="fa fa-chevron-left" aria-hidden="true"></i>
						</div>
						<div class="carousel-circle product_slider_nav_right1 product_slider_nav_right-best-sellers1 product_slider_nav1 d-flex align-items-center justify-content-center flex-column">
							<i class="fa fa-chevron-right" aria-hidden="true"></i>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


	<!-- Best Offers -->
	<div class="best_sellers mt-5">	
		<div class="container">
			<div class=" d-flex flex-sm-row flex-column justify-content-between text-center">
				<h2>{{aitrans('Best Selling Offers', [], 'client')}}</h2>
				<a href="{{'/' . app()->getLocale() . '/category/product/best-offers'}}"><h6>{{aitrans('view all', [], 'client')}}</h4></a>
			</div>
			{{-- <div class=" d-flex flex-row align-items-center justify-content-lg-end justify-content-center">
				<a href="{{'/' . app()->getLocale() . '/category/product/best-offers'}}"><h6>{{aitrans('view all', [], 'client')}}</h4></a>
			</div> --}}
			<div class="row">
				<div class="col">
					<div class="product_slider_container2" style="margin-top: 5px;">
						<div class="owl-carousel owl-theme product_slider2">
							@foreach ($best_offer_products as $productItem)
								<div class="owl-item product_slider_item2">
									
										<div class="product-item">
											<div class="product discount">
												<a href="{{airoute('aimeos_shop_list', ['locale'=>app()->getLocale(), 'site'=>'default']). '/' . $productItem->getUrl()}}">
												<div class="product_image">
													<?php foreach( $productItem->getRefItems('media') as $media ) : ?>
														<img src="/aimeos/{{$media->getPreview()}}" loading="lazy">
														<?php break; ?>
													<?php endforeach ?>											
												</div>
												</a>
												<div class="favorite favorite_left button-Products-like" data-d_prodid="{{$productItem->getId()}}" data-d_name="{{$productItem->getLabel()}}"></div>
												<div class="product_bubble product_bubble_right product_bubble_green d-flex flex-column align-items-center"><span >جديد</span></div>
												<a href="{{airoute('aimeos_shop_list', ['locale'=>app()->getLocale(), 'site'=>'default']). '/' . $productItem->getUrl()}}">
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
																<i class="star_rating fa fa-star" aria-hidden="true"></i> 
																<span>
																	<?= $productItem->rating ?? '0.0'?>
																</span>
															</div>
														</div>
														</div>
														<div class="product_title ">{{$productItem->getLabel()}}</div>
														<div class="row ">
															<?php foreach( $productItem->getRefItems('price') as $price ) : ?>
																<div class="col-7">
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
								</div>
							@endforeach
						</div>

						<!-- Slider Navigation -->
						<div class="carousel-circle product_slider_nav_left2 product_slider_nav_left-best-sellers2 product_slider_nav2 d-flex align-items-center justify-content-center flex-column">
							<i class="fa fa-chevron-left" aria-hidden="true"></i>
						</div>
						<div class="carousel-circle product_slider_nav_right2 product_slider_nav_right-best-sellers2 product_slider_nav2 d-flex align-items-center justify-content-center flex-column">
							<i class="fa fa-chevron-right" aria-hidden="true"></i>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- subcat -->
	<div class="blogs">
		<div class="container">
		<div class="row " >
			<div class="col-6">
				<div class=" d-flex flex-sm-row flex-column align-items-center justify-content-lg-start justify-content-center text-center">
				<h2>{{aitrans('Miscellaneous ads', [], 'client')}}</h2>
				</div>
			</div>
		</div>
		<div class="row blogs_container mt-25px">
			@foreach ($sub_categories->slice(1,2) as $item)
				<div class="col-lg-6 blog_item_col">
					<a href="{{route('front.product.category_shopping', ['locale'=>app()->getLocale(), 'code'=>$item->code])}}">
						<div class="blog_item-big">
							<div class="blog_background" style="background-image:url(/aimeos/{{ $item->getRefItems('media')->first() != null ? $item->getRefItems('media')->first()->getPreview() : ''}})"></div>
							<div class="blog_content d-flex flex-column align-items-center justify-content-center text-center">
								<div class="blog_more">{{$item->getLabel()}}</h4>
								</div>
							</div>
						</div>
					</a>
				</div>
			@endforeach
			{{-- @foreach ($sub_categories->slice(2,1) as $item)
				<div class="col-lg-3 blog_item_col">
					<div class="blog_item-big">
						<div class="blog_background" style="background-image:url(aimeos/{{ $item->getRefItems('media')->first() != null ? $item->getRefItems('media')->first()->getPreview() : ''}})"></div>
					<div class="blog_content d-flex flex-column align-items-center justify-content-center text-center">
						<div class="blog_more"><a href="{{route('front.product.category_shopping', ['locale'=>app()->getLocale(), 'code'=>$item->code])}}">{{$item->getLabel()}}</a></h4>
						</div>
					</div>
					</div>
				</div>
			@endforeach --}}
			{{-- <div class="col-lg-3 blog_item_col">
				@foreach ($sub_categories->slice(1,2) as $item)
					<div class="blog_item mb-3">
						<div class="blog_background" style="background-image:url(/aimeos/{{ $item->getRefItems('media')->first() != null ? $item->getRefItems('media')->first()->getPreview() : ''}})"></div>
						<div class="blog_content d-flex flex-column align-items-center justify-content-center text-center">
							<div class="blog_more"><a href="{{route('front.product.category_shopping', ['locale'=>app()->getLocale(), 'code'=>$item->code])}}">{{$item->getLabel()}}</a></h4>
							</div>
						</div>
					</div>
				@endforeach
			</div> --}}
		</div>
		<div class="row blogs_container mt-25px"> 
			@foreach ($sub_categories->slice(3,4) as $item)
				<div class="col-lg-3 blog_item_col">
					<a href="{{route('front.product.category_shopping', ['locale'=>app()->getLocale(), 'code'=>$item->code])}}">
						<div class="blog_item">
							<div class="blog_background" style="background-image:url(/aimeos/{{ $item->getRefItems('media')->first() != null ? $item->getRefItems('media')->first()->getPreview() : ''}})"></div>
							<div class="blog_content d-flex flex-column align-items-center justify-content-center text-center">
								<div class="blog_more">{{$item->getLabel()}}</h4>
								</div>
							</div>
						</div>
					</a>
				</div>
			@endforeach
		</div>
	</div>
	</div>


	<!-- Best Sellers -->
	<div class="best_sellers mt-5">	
		<div class="container">
			<div class=" d-flex flex-sm-row flex-column justify-content-between text-center">
				<h2> {{aitrans('Featured Products', [], 'client')}}</h2>
				<a href="{{'/' . app()->getLocale() . '/category/product/featured-products'}}"><h6>{{aitrans('view all', [], 'client')}}</h4></a>
			</div>
			{{-- <div class=" d-flex flex-row align-items-center justify-content-lg-end justify-content-center">
				<a href="{{'/' . app()->getLocale() . '/category/product/featured-products'}}"><h6>{{aitrans('view all', [], 'client')}}</h4></a>
			</div> --}}
			<div class="row">
				<div class="col">
					<div class="product_slider_container3" style="margin-top: 5px;">
						<div class="owl-carousel owl-theme product_slider3">
							@foreach ($featured_products as $productItem)
								<div class="owl-item product_slider_item3">
										<div class="product-item">
											<div class="product discount">
												<a href="{{airoute('aimeos_shop_list', ['locale'=>app()->getLocale(), 'site'=>'default']). '/' . $productItem->getUrl()}}">
												<div class="product_image">
													<?php foreach( $productItem->getRefItems('media') as $media ) : ?>
														<img src="/aimeos/{{$media->getPreview()}}"  loading="lazy">
														<?php break; ?>
													<?php endforeach ?>											
												</div>
												</a>
												<div class="favorite favorite_left button-Products-like" data-d_prodid="{{$productItem->getId()}}" data-d_name="{{$productItem->getLabel()}}"></div>
												{{-- <div class="product_bubble product_bubble_right product_bubble_green d-flex flex-column align-items-center"><span style="padding-top: 7px;"> {{aitrans('new', [], 'client')}}</span></div> --}}
												<a href="{{airoute('aimeos_shop_list', ['locale'=>app()->getLocale(), 'site'=>'default']). '/' . $productItem->getUrl()}}">
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
																<i class="star_rating fa fa-star" aria-hidden="true"></i> 
																<span>
																	<?= $productItem->rating ?? '0.0'?>
																</span>
															</div>
														</div>
														</div>
														<div class="product_title ">{{$productItem->getLabel()}}</div>
														<div class="row ">
															<?php foreach( $productItem->getRefItems('price') as $price ) : ?>
																<div class="col-7">
																	<div class="product_price ">
																		{{$price->getValue() . ' ' .  aitrans( $price->getCurrencyid(), [],'client' )}}		
																		@if($price->getRebate() > 0)	
																			<span>{{$price->getValue() + ($price->getValue() * $price->getRebate()/100)}}</span> 
																		@endif
																	</div>
																</div>
																<?php if($price->getRebate() != 0 ) : ?>
																	<div class="col-5 text-left">
																		<div class="product_bubble_decount ">
																			{{ $price->getRebate() . ' %' }}  {{aitrans('Discount', [], 'client')}}
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
								</div>
							@endforeach
						</div>

						<!-- Slider Navigation -->

						
						<div class="carousel-circle product_slider_nav_left3 product_slider_nav_left-best-sellers3 product_slider_nav3 d-flex align-items-center justify-content-center flex-column">
							<i class="fa fa-chevron-left" aria-hidden="true"></i>
						</div>
						<div class="carousel-circle product_slider_nav_right3 product_slider_nav_right-best-sellers3 product_slider_nav3 d-flex align-items-center justify-content-center flex-column">
							<i class="fa fa-chevron-right" aria-hidden="true"></i>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Register here to get-->
	<div class="container Register_here my-5" id="newsletter">
		<div class="d-flex-space-between">
			<div>
				<div class="">
					<h4>{{aitrans('Register here for the weekly newsletter', [], 'client')}}</h4>
					<span class="text-right">{{aitrans('We send you the best and latest relevant offers, we send you a flyer with the best products for you', [], 'client')}}</p>
				</div>
				<div class="input-icon" style="width: 97%;">
					<form action="{{route('newsletter.subscribe')}}" method="POST">
						@csrf
						<input type="email" name="email" class="input-icon-radius form-control text-right" placeholder="{{aitrans('E-Mail', [], 'client')}}"  value="{{old('email')}}">
						<button type="submit" class="btn btn-sm btn-danger cursor-pointer round-20 mt-cust float-direction">
						 {{aitrans('Subscription', [], 'client')}}
						<i class="fa fa-chevron-circle-left"></i>
						</button>
						@error('email')
							<div class="text-danger">{{$message}}</div>
						@enderror
					</form>
				</div>
			</div>
			<div>
				<div class="img-loading mt-n13">
					<div class="img-circle"  >
						<lottie-player class="my-0 welcome-circle " src="{{asset('front/js/loading.json')}}"   background="transparent" loop speed="1" autoplay></lottie-player>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection


@section('js')
	<script src="{{asset('front/js/lottie_5.5.0.js')}}"></script>
	<script src="{{asset('front/js/lottie-player.js')}}"></script>
	@if( session()->has('errors') == 'email')
        <script>
        	window.location.hash = '#newsletter';
        </script>
	@endif
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