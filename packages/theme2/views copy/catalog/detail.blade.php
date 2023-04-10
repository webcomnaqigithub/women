@extends('base')
@section('title') Product Details | بازار - Bazaar @endsection

@section('aimeos_header')
    <?= $aiheader['locale/select'] ?? '' ?>
    <?= $aiheader['basket/mini'] ?? '' ?>
    <?= $aiheader['catalog/tree'] ?? '' ?>
    <?= $aiheader['catalog/search'] ?? '' ?>
    <?= $aiheader['catalog/stage'] ?? '' ?>
    <?= $aiheader['catalog/detail'] ?? '' ?>
@stop

@section('aimeos_head_basket')
    <?= $aibody['basket/mini'] ?? '' ?>
@stop

@section('aimeos_head_nav')
    <?= $aibody['catalog/tree'] ?? '' ?>
@stop

@section('aimeos_head_locale')
    <?= $aibody['locale/select'] ?? '' ?>
@stop

@section('aimeos_head_search')
    <?= $aibody['catalog/search'] ?? '' ?>
@stop

@section('aimeos_stage')
    <?= $aibody['catalog/stage'] ?? '' ?>
@stop

@section('aimeos_body')
    <?= $aibody['catalog/detail'] ?? '' ?>
@stop
 


@section('js')
    <script src="{{asset('front/js/lottie_5.5.0.js')}}"></script>
    <script src="{{asset('front/js/lottie-player.js')}}"></script>
    <script>
		$(document).ready(function () {
			var menu = bodymovin.loadAnimation({
                container: document.getElementById('Add-To-Cart'),
                renderer: 'svg',
                loop: false,
                autoplay: false,
                path: '{{asset('front/js/1 s.json')}}',
            });
        document.getElementById('Add-To-Cart').addEventListener('click', function () {
            let checkout_items = $('#checkout_items').text();
            document.getElementById("Add-To-Cart").disabled = true;
            $.ajax({
                type:"post",
                url: '/ar/shop/default/basket',
                data:{
                    b_action:'add',
                    'b_prod[0][prodid]':$('#d_prodid').val(),
                    'b_prod[0][quantity]':$('#quantity_value').html(),
                    _token:"{{ csrf_token() }}",
                },
                success: function(response) {
                    if(response)
                    {
                        $(".Add-To-Cart svg").show();
                        menu.play();
                        $('#Modal-Added-Cart').modal('show');
                        setInterval(function(){
                            $('#Modal-Added-Cart').modal('hide');
                        }, 4000); 
                        window.location.reload();
                    }
                }
            });
        });

        // $('#Added-To-Cart').click(function () {
        //     $('#Modal-Added-Cart').modal('show');
        //     setInterval(function(){
        //         $('#Modal-Added-Cart').modal('hide');
        //     }, 4000); 
        // });

		$('.show-more').click(function () {
			$('.All-Reviews').toggleClass('overflow-y-hidden overflow-y-scroll');
		});
    }); 

    </script>
    <script>
        $("#quantity_value").on('DOMSubtreeModified',function(){
            $('#input_quantity_value').val($('#quantity_value').text());
        });
    </script>
    <script>
        if($('.plus').length && $('.minus').length && $('#stock_number').html() > $('#quantity_value'))
		{
			var plus = $('.plus');
			var minus = $('.minus');
			var value = $('#quantity_value');

			plus.on('click', function()
			{
				var x = parseInt(value.text());
				value.text(x + 1);
			});

			minus.on('click', function()
			{
				var x = parseInt(value.text());
				if(x > 1)
				{
					value.text(x - 1);
				}
			});
		}
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