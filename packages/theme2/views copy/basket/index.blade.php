@extends('base')
@section('title') Cart | بازار - Bazaar @endsection

@section('aimeos_header')
    <title>{{ __( 'Basket') }}</title>
    <?= $aiheader['locale/select'] ?? '' ?>
    <?= $aiheader['catalog/search'] ?? '' ?>
    <?= $aiheader['catalog/tree'] ?? '' ?>
    <?= $aiheader['basket/bulk'] ?? '' ?>
    <?= $aiheader['basket/standard'] ?? '' ?>
    <?= $aiheader['basket/related'] ?? '' ?>
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

@section('aimeos_body')
    <div class="container-fluid">
        <?= $aibody['basket/standard'] ?? '' ?>
        <?= $aibody['basket/related'] ?? '' ?>
        <?= $aibody['basket/bulk'] ?? '' ?>
    </div>
 

@stop

@section('js')
<script>
    $("#quantity_value").on('DOMSubtreeModified',function(){
        $('#input_quantity_value').val($('#quantity_value').text());
    });
</script>

<script>
    $('.button-Products-like').click(function(){
        let d_name = $('#prodcod').val();
        let d_prodid = $('#prodid').val()
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