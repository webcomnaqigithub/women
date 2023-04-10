@extends('layouts.checkout_layout')
@section('title') Checkout | بازار - Bazaar @endsection

@section('aimeos_header')
    <title>{{ __( 'Checkout') }}</title>
    <?= $aiheader['checkout/standard'] ?>
    <?= $aiheader['catalog/search'] ?? '' ?>
    <?= $aiheader['catalog/tree'] ?? '' ?>
@stop

@section('aimeos_nav')
    <?= $aibody['catalog/tree'] ?? '' ?>
    <?= $aibody['catalog/search'] ?? '' ?>
@stop

@section('aimeos_body')
 
        <?= $aibody['checkout/standard'] ?>
 
@stop

@section('js')
    {{-- <script>
        $(document).ready(function(){
            if(!$('#addressDeliveryItems').hasClass('addressDeliveryItems')){
                $('.payment-button').attr('style', 'display: none !important');
            }
        });
    </script> --}}
    <script>
        $('#Continue_to_pay').click(function(e){
            e.preventDefault();
            $('#Payment-section-1').hide();
            $('#Payment-section-2').fadeIn('slow');
            $('.Shipping-addresses').removeClass('text-danger');
            $('.Shipping-addresses').addClass('text-success');
            $('.Paying-off').addClass('text-danger');
           
            let ca_billingoption = $('#ca_billingoption').val();
            $.ajax({
                type:"POST",
                url: '/{{app()->getLocale()}}/shop/default/checkout/delivery',
                data:{
                    ca_billingoption:ca_billingoption,
                _token:"{{ csrf_token() }}",
                },
                success: function(response) {
                if(response)
                {

                }
                }
            });  
        });
        function pay_now(){
            $('#Payment-section-2').hide();
            $('#Payment-section-3').fadeIn('slow');
            $('.Paying-off').removeClass('text-danger');
            $('.Paying-off').addClass('text-success');
            $('.Order-status').addClass('text-danger');
            $('.footer-Payment-page').addClass('fixed-footer-pay');
            window.setInterval(function()
            {
            $('.Order-status').removeClass('text-danger');
            $('.Order-status').addClass('text-success');
            $(".Pay-check").hide();
            $(".Pay-success").fadeIn('slow');
            }, 2000);
        }
    </script>

    <script>
        $('.button-add-addres').click(function(e){
            e.preventDefault();
            $('#Div-Add-New-Adrees').show();
            $('.address-Products-content').hide();
            $('.cont').hide();
            $('.payment-button').attr('style', 'display: none !important');
        });
    </script>
    <script>
        window.onload = function(){
            document.forms['confirm-pay'].submit();
        }
    </script>
@endsection