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
    <div class="container-fluid page-body">
        <?=$aibody['account/profile'] ?? '';?> 
    </div>
@stop

@section('aimeos_aside')
    <?= $aibody['catalog/session'] ?>
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
        var InputNum = 0;
        $(".summary_img").click(function() {
            InputNum++;
            $(this).closest(".row").find('.summary_img').before(
                '<div class="col-sm-2 imgUp"><div class="imagePreview"></div><label class="btn btn-primary">تحميل صورة<input type="file" class="uploadFile img" name="summary_pics[' + InputNum + ']" style="width:143px;height:20px;overflow:hidden;">' +
                '</label><i class="fa fa-times del"></i></div>'
            );
        });
    </script>
    <script>
        $(function() {
            $(document).on("change", ".uploadFile", function() {
                var uploadFile = $(this);
                var files = !!this.files ? this.files : [];
                if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support

                if (/^image/.test(files[0].type)) { // only image file
                    var reader = new FileReader(); // instance of the FileReader
                    reader.readAsDataURL(files[0]); // read the local file

                    reader.onloadend = function() { // set image data as background of div
                        //alert(uploadFile.closest(".upimage").find('.imagePreview').length);
                        uploadFile.closest(".imgUp").find('.imagePreview').css("background-image", "url(" + this.result + ")");
                        $('#profile-bckgrnd-btn').show();
                    }
                }

            });
        });
    </script>
    <script>
        $('#add_Products_new').click(function(){
            $('#Div_All_Products').hide();
            $('#create_product').show();
        });
        $('.edit_productfn').click(function(e){
            e.preventDefault();
            let id = $(this).data("id"); 
            $('.Products_col').hide();
            $('#Div_All_Products').hide();
            $('#EditProductDiv').show();
            $('#item_product_label').val('');
            $('#price').val('');
            $('#priceid').val('');
            $('#rebate').val('');
            $('#stock').val('');
            $('#stockid').val('');
            $('#text').val('');
            $('#textid').val('');
            $('#edit_form_images').html('');
            $.ajax({
                type:"GET",
                url: '/jsonapi/default/product?currency=ILS',
                data:{
                id:id,
                include:'media,catalog,price,stock,text',
                _token:"{{ csrf_token() }}",
                },
                success: function(response) {
                if(response)
                {
                    // console.log(response)
                    $('#productId').val(response.data.attributes['product.id']);
                    $('#productCode').val(response.data.attributes['product.code']);
                    $('#item_product_label').val(response.data.attributes['product.label']);
                    $('select option[value*='+ response.data.relationships.catalog.data[0].id +']').prop('selected', true);
                    // $('select option[value*='+ response.data.relationships.catalog.data[1].id +']').prop('selected', true);
                    
                    $.each(response.included, function (key, val) {
                        if(val.type == 'price' && val.attributes['price.domain'] == 'product'){
                            $('#price').val(val.attributes['price.value']);
                            $('#priceid').val(val.attributes['price.id']);
                            $('#priceCurrency').val(val.attributes['price.currencyid']);
                            $('select option[value*='+ val.attributes['price.currencyid'] +']').prop('selected', true);
                            $('#rebate').val(val.attributes['price.rebate']);
                        }
                        if(val.type == 'media' && val.attributes['media.domain'] == 'product'){
                            $('#edit_form_images').append('<img src="/aimeos/' + val.attributes['media.preview'] +'" alt="" style="width: 134px;">');
                        }
                        if(val.type == 'stock'){
                            $('#stock').val(val.attributes['stock.stocklevel']);
                            $('#stockid').val(val.attributes['stock.id']);
                        }
                        if(val.type == 'text'){
                            $('#text').val(val.attributes['text.content']);
                            $('#textid').val(val.attributes['text.id']);
                        }
                    });

                }
                }
            });  
        });
    </script>
    <script>
        $(".deleteRecord").click(function(e){
                e.preventDefault();
                $('#confirm-delete').modal('show');
                // let answer = window.confirm('هل أنت متأكد من عملية الحذف؟');
                let id = $(this).data("id");
                let url = "{{airoute('front.mrchnt.product.destroy', ['site' => app('aimeos.context')->get(false)->locale()->getSiteItem()->getCode(), 'resource' => 'product','id' => 'ID'])}}";
                var $tr = $(this).parents('.Products_col').first();
                document.getElementById('confirm-del-button').onclick = function(){
                    $.ajax({
                        type:"DELETE",
                        url: url.replace('ID', id),
                        data:{
                        id:id,
                        _token:"{{ csrf_token() }}",
                        },
                        success: function(response) {
                        if(response)
                        {
                            //on success, hide element user wants to delete.
                            $tr.fadeOut(500,function(){
                            $tr.remove();
                            });
                            swal("تم الحذف بنجاح", "", "success");
                        }
                        }
                    });   
                };
        });
    </script>
    <script>
        $(".delete-address").click(function(e){
            e.preventDefault();
            $('#confirm-delete').modal('show');
            let id = $(this).data("id");
            let url = "{{route('front.destroy_address', ['locale' => app()->getLocale()])}}";
            var $tr = $(this).parents('.Address_col').first();
            document.getElementById('confirm-del-button').onclick = function(){
                $.ajax({
                    type:"POST",
                    url: url,
                    data:{
                        id:id,
                        usid:{{auth()->user()->id}},
                        _token:"{{ csrf_token() }}",
                    },
                    success: function(response) {
                    if(response)
                    {
                        //on success, hide element user wants to delete.
                        $tr.fadeOut(500,function(){
                        $tr.remove();
                        });
                        swal("تم الحذف بنجاح", "", "success");
                    }
                    }
                });   
            };
        });
    </script>
    <script>
        var loadFile = function(event) {
            var output = document.getElementById('output');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
            URL.revokeObjectURL(output.src) // free memory
            }
        };
    </script>
    <script>
        $(document).on('click', '#save-product', function (e) {
        e.preventDefault();
        document.getElementById("overlay").style.display = "block";
        var formData = new FormData(document.getElementById('createProductForm'));
        $.ajax({
            type: 'post',
            url: "{{ airoute('front.mrchnt.product.store', ['locale'=>'en', 'site'=>app('aimeos.context')->get()->locale()->getSiteItem()->getCode(), 'resource' => 'product']) }}",
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            success: function (data) {
                if (data.status == 'error') {
                    // alert('sdds');
                    // Swal.fire({
                    //     title: 'خطأ!',
                    //     text: 'حدث خطأ أثناء عملية التسجيل الرجاء التأكد ان جميع المدخلات صحيحة!',
                    //     icon: 'error',
                    //     showConfirmButton: false,
                    //     timer: 2500
                    // });
                } else {
                    // Swal.fire({
                    //     text: 'تم تسجيل الدخول',
                    //     icon: 'success',
                    //     showConfirmButton: false,
                    //     timer: 2000
                    // });
                    window.location = '/{{app()->getLocale()}}/profile/{{app('aimeos.context')->get()->locale()->getSiteItem()->getCode()}}#Products';
                    location.reload();
                }
            }, error: function (reject) {
                var response = $.parseJSON(reject.responseText);
                $.each(response.errors, function (key, val) {
                    mystring = key.replace('item.product.','').replace('price.0.price.rebate.','').replace('price.0.price.','').replace('text.0.text.','').replace('item.product.','').replace('media.0.','');
                    // alert(mystring);
                    $("#" + mystring + "_error").html(val[0]);
                });
            }
        });
        });
    </script>
    {{-- <script>
        $(document).on('click', '#edit-product', function (e) {
        e.preventDefault();
        var formData = new FormData(document.getElementById('EditProductForm'));
        $.ajax({
            type: 'post',
            url: "{{ airoute('front.mrchnt.product.store', ['locale'=>'en', 'site'=>app('aimeos.context')->get()->locale()->getSiteItem()->getCode(), 'resource' => 'product']) }}",
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            success: function (data) {
                if (data.status == 'error') {
                    // alert('sdds');
                    // Swal.fire({
                    //     title: 'خطأ!',
                    //     text: 'حدث خطأ أثناء عملية التسجيل الرجاء التأكد ان جميع المدخلات صحيحة!',
                    //     icon: 'error',
                    //     showConfirmButton: false,
                    //     timer: 2500
                    // });
                } else {
                    // Swal.fire({
                    //     text: 'تم تسجيل الدخول',
                    //     icon: 'success',
                    //     showConfirmButton: false,
                    //     timer: 2000
                    // });
                    window.location = '/{{app()->getLocale()}}/profile/{{app('aimeos.context')->get()->locale()->getSiteItem()->getCode()}}';
                }
            }, error: function (reject) {
                var response = $.parseJSON(reject.responseText);
                $.each(response.errors, function (key, val) {
                    mystring = key.replace('item.product.','').replace('price.0.price.rebate.','').replace('price.0.price.','').replace('text.0.text.','').replace('item.product.','').replace('media.0.','');
                    // alert(mystring);
                    $("#" + mystring + "_error").html(val[0]);
                });
            }
        });
        });
    </script> --}}
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
    <script>
        function Add_New_Adrees(){
            $('#Div-All-Adrees').hide();
            $('#Div-Add-New-Adrees').fadeIn('slow');
        }
        function Addres_save(){
            $('#Div-Add-New-Adrees').hide();
            $('#Div-All-Adrees').fadeIn('slow');
            $('html, body').animate({
               scrollTop: $("#Div_All_Products").offset().top
           }, 1000)};
        function account_edit(){
            $('.button-account-edit').hide();
            $('.button-account-save-edit').show();
        }
        function account_save_edit(){
            $('.button-account-save-edit').hide();
            $('.button-account-edit').show();
        }
        function password_change(){
            $('.button-password-change').hide();
            $('.button-password-edit').show();
            $('.input-password').show();
        }
        function password_edit(){
            $('.button-password-edit').hide();
            $('.button-password-save-edit').show();
        }
        function password_save_edit(){
            $('.button-password-save-edit').hide();
            $('.button-password-edit').hide();
            $('.button-password-change').show();
            $('.input-password').hide();
        }
     </script>
     <script>
         $('.products-list, .button-Products-cancel').click(function(){
            $('#create_product').hide();
            $('#EditProductDiv').hide();
            $('#Div_All_Products').show();
            $('.Products_col').show();
         });
     </script>
    <script>
        $('.regxnum').on('input', function() {
            $(this).val($(this).val().replace(/[^0-9]/gi, ''));
        });
    </script>
    <script>
        $('#sub_categories').on('change', function() { 
            if($(this).val() == 16){
                $('#size-attribute').attr('disabled', false);
                $('#available-sizes').show();
            }else{
                $('#size-attribute').attr('disabled', true);
                $('#available-sizes').hide();
            }
            
        });
    </script>

    <script>
    $('.vendor-rating-btn').click(function(e){
        e.preventDefault();
        let siteid = $(this).data('id');
        $('#siteid').val(siteid);
        let orderid = $(this).data('orderid'); 
        $('#orderid').val(orderid);

    });
    $('#send-vendor-rating').click(function(e){
        e.preventDefault();
        let orderid = $('#orderid').val();
        var formData = new FormData(document.getElementById('rating-form'));
        formData.append('_token' , "{{ csrf_token() }}");
        let url = "{{ route('front.mrchnt.order.vendor_rating', ['locale'=>'en', 'id' => 'ID']) }}";
        $.ajax({
            type: 'POST',
            url: url.replace('ID', orderid),
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            success: function (data) {
                if (data.status == 'success') {
                $("#myModalNew").modal();
                }
            }, error: function (reject) {
            
            }
        });
    });
    </script>
    <script>
        $(document).ready(function() {
            if (location.hash) {
                $("a[href='" + location.hash + "']").tab("show");
            }
            $(document.body).on("click", "a[data-toggle='tab']", function(event) {
                location.hash = this.getAttribute("href");
                $("html, body").animate({ scrollTop: 120 }, "slow");
                return false;
            });
        });
        $(window).on("popstate", function(event) {
            var anchor = location.hash || $("a[data-toggle='tab']").first().attr("href");
            $("a[href='" + anchor + "']").tab("show");
            $("html, body").animate({ scrollTop: 120 }, "slow");
            return false;
        });
    </script>
    <script>
        $(document).ready(function () {
            $('a[href="#{{ old('tab') }}"]').tab('show');
        });
    </script>
@endsection


