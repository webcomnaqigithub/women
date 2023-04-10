@extends('base')

@section('aimeos_header')
    <title>{{ __( 'Thank you') }}</title>
    <?= $aiheader['checkout/confirm'] ?>
    <?= $aiheader['catalog/search'] ?? '' ?>
    <?= $aiheader['catalog/tree'] ?? '' ?>
@stop

@section('aimeos_nav')
    <?= $aibody['catalog/tree'] ?? '' ?>
    <?= $aibody['catalog/search'] ?? '' ?>
@stop

@section('aimeos_body')
    <div class="container-fluid">
        <?= $aibody['checkout/confirm'] ?>
    </div>
@stop


@section('js')
    <script>
        $(document).ready(function(){
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
        });
    </script>
@endsection