@extends('base')
@section('title') List | بازار - Bazaar @endsection

@section('aimeos_header')
    <?= $aiheader['locale/select'] ?? '' ?>
    <?= $aiheader['basket/mini'] ?? '' ?>
    <?= $aiheader['catalog/search'] ?? '' ?>
    <?= $aiheader['catalog/filter'] ?? '' ?>
     <?= $aiheader['catalog/stage'] ?? '' ?>
    <?= $aiheader['catalog/lists'] ?? '' ?>
@stop

@section('aimeos_head_basket')
    <?= $aibody['basket/mini'] ?? '' ?>
@stop
 

@section('aimeos_head_locale')
    <?= $aibody['locale/select'] ?? '' ?>
@stop

@section('aimeos_head_search')
    <?= $aibody['catalog/search'] ?? '' ?>
@stop

@section('content')

<div class="bigen-container-shop-data">
	<div class="container">
		<div class="breadcrumbs ">
			<ul>
				<li><a href="{{ airoute('aimeos_home', ['site' => 'default']) }}">{{aitrans('Main', [], 'client')}}</a></li>
				<li class="active"><a href="#"><i class="fa fa-angle-left" aria-hidden="true"></i>{{aitrans('Shops', [], 'client')}}</a></li>
				{{-- <li class="active"><a href="#"><i class="fa fa-angle-left" aria-hidden="true"></i>متجر</a></li> --}}
			</ul>
		</div>
	</div>
	<div class="container ">
	<div class="row shop-profile">
		<div class="col">
			<img src="{{asset('front/images/Cover-Full.png')}}" class="cover-store">
		</div>
	</div>
   <?= $aibody['catalog/storenav'] ?? '' ?>
</div>

<div class="tabs_section_container">
    <div class="container">
       <div class="row">
          <div class="col">
             <div class="tabs_container">
                <ul class="tabs d-flex align-items-md-center justify-content-center">
                   <li class="tab active" data-active-tab="tab_1"><span>{{aitrans('Elements', [], 'client')}}</span></li>
                   <li class="tab" data-active-tab="tab_2"><span>{{aitrans('Reviews', [], 'client')}} (0)</span></li>
                   <li class="tab" data-active-tab="tab_3"><span>{{aitrans('Brief', [], 'client')}}</span></li>
                </ul>
             </div>
          </div>
       </div>
       <div class="row">
          <div class="col mt-n13">
             <!-- Tab Description -->
             <div id="tab_1" class="tab_container active">
                <div class="row ">
                   <div class="col-lg-12 d-flex justify-content-end">
                      {{-- <ul class="product_sorting">
                         <li>
                            <span class="type_sorting_text">ترتيب حسب</span>
                            <i class="fa fa-angle-down"></i>
                            <ul class="sorting_type">
                               <li class="type_sorting_btn"><span>العناصر</span></li>
                               <li class="type_sorting_btn"><span>السعر</span></li>
                               <li class="type_sorting_btn"><span>المنتج</span></li>
                            </ul>
                         </li>
                      </ul> --}}
                      <select onchange="document.getElementById('product_shopping').submit()" name="f_sort" form="product_shopping">
                           <option value="">{{aitrans('sort by', [], 'client')}}</option>
                           <option value="-ctime">الأخيرة</option>
                           <option value="price">{{aitrans('Price', [], 'client')}}</option>
                           <option value="name">{{aitrans('Product', [], 'client')}}</option>
                      </select>
                   </div>
                </div>
                <div class="row">
                    <?= $aibody['catalog/filter'] ?? '' ?>
                    <?= $aibody['catalog/lists'] ?>
                </div>
                <!-- Tab Additional Info -->
             </div>
             <div id="tab_2" class="tab_container">
                <div class="row ">
                   <div class="col-lg-6 d-flex justify-content-start">
                      <h4>0 {{aitrans('Reviews', [], 'client')}}</h4>
                   </div>
                   <div class="row mt-10px">
                      <!-- User Reviews -->
                      {{-- <div class="col-12 reviews_col">
                         <div class="user_review_container d-flex ">
                            <div class="user-Reviews-img">
                               <img src="{{asset('front/images/user.png')}}">
                            </div>
                            <div class="review">
                               <div class="user_name">فاطمة خلود</div>
                               <div class="review_date">27 Aug 2016</div>
                               <div class="review-word">جودة مذهلة! تبدو أفضل من الصورة! جميلة جدا وناعمة والشحن كان سريعا! وحصلت على ملاحظة خطية جميلة! بالتأكيد أوصي بهم!.</div>
                            </div>
                         </div>
                      </div> --}}
                   </div>
                </div>
             </div>
             <!-- Tab Reviews -->
             <div id="tab_3" class="tab_container">
               <?= $aibody['catalog/stage'] ?? '' ?>
             </div>
             <div class="row" style="margin-top: 10rem;">
               <div class="col-lg-7">
                  <h4>{{aitrans('Follow us', [], 'client')}}</h4>
                  <div class="social-media d-flex">
                     <a href="https://www.facebook.com/sharer/sharer.php?u=<?= url()->current() ?>&display=popup" class="btn btn-sm btn-About-facebook  btn-outline-light cursor-pointer round">
                        <i class="fa fa-facebook"></i>
                        {{aitrans('Facebook', [], 'client')}}
                     </a>
                     <a href="https://instagram.com/mowa.gaza?igshid=YmMyMTA2M2Y=" class="btn btn-sm btn-About-instagram btn-outline-light cursor-pointer round">
                        <i class="fa fa-instagram"></i>
                        {{aitrans('instagram', [], 'client')}}
                     </a>
                     <a href="https://twitter.com/intent/tweet?text=Bazar Product&url=<?= url()->current() ?>" class="btn btn-sm btn-About-twitter btn-outline-light cursor-pointer round">
                        <i class="fa fa-twitter"></i>
                        {{aitrans('twitter', [], 'client')}}
                     </a>
                     <a href="https://wa.me/?text=<?= url()->current() ?>" data-action="share/whatsapp/share" class="btn btn-sm btn-About-whatsapp  btn-outline-light cursor-pointer round">
                     <i class="fa fa-whatsapp"></i>
                        {{aitrans('Whats Up', [], 'client')}}
                     </a>
                  </div>
               </div>
            </div>
          </div>
       </div>
    </div>
</div>

</div>


<div class="modal fade" id="send-masg" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered " role="document">
      <div class="modal-content ">
         <div class="modal-header-cust">
            <h5 class="modal-title" id="exampleModalLongTitle">{{aitrans('Contact the store', [], 'client')}}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">
            <i class="fa fa-times-circle"></i>
            </span>
            </button>
         </div>
         <div class="modal-body text-center">
            <div class="d-flex justify-content-center">
               <div class="logo-shop-modal">
                  <img src="{{$aimeossite->getIcon()}}"  >  
               </div>
            </div>
            <div class="mt-2">
               <div>{{$aimeossite->getLabel() ?? ''}}</div>
               <div>
                  <span class="fa fa-map-marker"></span>
                  <span class=" ">{{$userSite->city ?? ''}} - {{$userSite->address1 ?? ''}}</span>
               </div>
            </div>
            <div class="form-group text-right font-weight-bold mt-3">
               <label for="exampleFormControlTextarea1">{{aitrans('the message', [], 'client')}}</label>
               <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>
            <div class="form-group send-masg-shop  font-weight-bold mt-5">
               <button type="button" class="btn btn-danger" data-dismiss="modal" data-toggle="modal" data-target="#message-success">
               {{aitrans('Resend', [], 'client')}}
               <i class="fa fa-paper-plane "></i>
               </button>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="modal fade" id="message-success" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered " role="document">
      <div class="modal-content ">
         <div class="modal-header-cust">
            <h5 class="modal-title" id="exampleModalLongTitle">{{aitrans('Contact the store', [], 'client')}}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">
            <i class="fa fa-times-circle"></i>
            </span>
            </button>
         </div>
         <div class="modal-body text-center">
            <div class="pt-5 px-5 font-weight-bold">
               تم إرسال رسالتك بنجاح 
            </div>
            <div class="pb-5 pt-1">
               سيتم الرد عليك بأقرب وقت ممكن شكراً لك 
            </div>
            <div class="form-group message-success-btn  font-weight-bold mt-3">
               <button type="button" class="btn " data-dismiss="modal">
               موافق
               </button>
            </div>
         </div>
      </div>
   </div>
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