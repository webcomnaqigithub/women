@extends('base')
@section('title') Account | بازار - Bazaar @endsection

@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('front/styles/profilePhoto.css')}}">
@endsection
@section('aimeos_header')
    <title>{{ __( 'Profile') }}</title>
    <?= $aiheader['account/profile'] ?? '' ?>
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

@section('aimeos_body')
    <div class="page-body">
        <?= $aibody['account/editproduct'] ?>
    </div>
@stop

@section('aimeos_aside')
@stop


@section('aimeos_scripts')
    <script src="{{asset('front/js/personalImagUpload.js')}}"></script>
    <script>
        var InputNum = 0;
        $(".imgAdd").click(function() {
            InputNum++;
            $(this).closest(".row").find('.imgAdd').before(
                '<div class="col-sm-2 imgUp"><div class="imagePreview"></div><label class="btn btn-primary">تحميل صورة<input type="file" class="uploadFile img" name="media[' + InputNum + '][file]" style="width:143px;height:20px;overflow:hidden;">' +
                '<input type="hidden" name="media[' + InputNum + '][media.status]" value="1">'  +
                '<input type="hidden" name="media[' + InputNum + '][media.type]" value="default">'  +
                '<input type="hidden" name="media[' + InputNum + '][product.lists.type]" value="default">'  +
                '<input type="hidden" name="media[' + InputNum + '][media.label]" value="">'  +
                '</label><i class="fa fa-times del"></i></div>'
            );
        });
    </script>
    <script>
        $("#category").change(function(e){
            e.preventDefault();
            let id = $(this).val();
            let url = "{{route('front.mrchnt.product.get_sub_category', ['id' => 'ID', 'locale'=>'ar'])}}";
            $.ajax({
                type:"POST",
                url: url.replace('ID', id),
                data:{
                id:id,
                _token:"{{ csrf_token() }}",
                },
                success: function(response) { 
                if(response != null)
                {
                    $('#sub_categories').html('<option>اختر</option>')
                    $.each(response.sub_categories, function (key, val) {
                        $('#sub_categories').append('<option value="' + val.id + '">' + val.label + '</option>')
                    });
                }else{
                    $('#sub_categories').html('<option>اختر</option>')
                }
                }
            });
        });
    </script>
@endsection