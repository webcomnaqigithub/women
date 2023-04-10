@extends('layouts.mrchnt.layout')
@section('title') المنتجات @endsection
@section('products')
    <div id="products_list">
       <div class="row">
          <div class="col-6">
             <h4>المنتجات</h4>
          </div>
          <div class="col-6 add_Products">
             <button class="button-add-Products-new" onclick="add_Products_new()">
             <i class="fa fa-plus"></i>
             إضافة منتج جديد
             </button>
          </div>
       </div>
       @foreach ($products as $item)
         <div class="row Products_col">
            <div class="col-md-8 details_user_Products">
               <div class="img-Products">
                  <img src="{{asset('front/images/prod.png')}}">
               </div>
               <div class="details_Products">
                  <div class="Products_name" style="width: unset;">{{$item['product.label']}}</div>
                  <div class="Products_type">
                     @foreach ($item->getRefItems('catalog') as $itemeec)
                        {{($itemeec->getLabel() ?? '')}}
                     @endforeach
                  </div>
                  <div class="Products_number">#437952</div>
                  <div class="Products_price">
                     @foreach ($item->getRefItems('price') as $itemee)
                        {{($itemee->getValue() ?? '')}}
                        {{($itemee->getCurrencyId() ?? '')}}
                     @endforeach
                  </div>
               </div>
            </div>
            <div class="col-md-4 details_button_Products">
               <div class="Products-date-time">
                  <i class="fa fa-calendar"></i> 
                  <span>{{$item['product.ctime']}}</span> 
                  {{-- <span class="pr-b">AM10:30</span> --}}
               </div>
               <div class="button-Products">
                  <button class="button-Products-edit">
                  <i class="fa  fa-pencil"></i> 
                  تعديل
                  </button>
                  <button class="button-Products-delete deleteRecord" data-id="{{$item['product.id']}}">
                     <i class="fa  fa-trash"></i> 
                     حذف
                  </button>
               </div>
            </div>
         </div> 
       @endforeach

       {{-- <div class="row Products_col">
          <div class="col-md-8 details_user_Products">
             <div class="img-Products">
                <img src="{{asset('front/images/Image 9.png')}}">
             </div>
             <div class="details_Products">
                <div class="Products_name">جاكيت قصير مطرز بالكامل ، تطريز تقليدي ، تصميم فلسطيني</div>
                <div class="Products_type">  الأثواب  </div>
                <div class="Products_number">#437952</div>
                <div class="Products_price">$500</div>
             </div>
          </div>
          <div class="col-md-4 details_button_Products">
             <div class="Products-date-time">
                <i class="fa fa-calendar"></i> 
                <span>17/02/2022</span> 
                <span class="pr-b">AM10:30</span>
             </div>
             <div class="button-Products">
                <button class="button-Products-edit">
                <i class="fa  fa-pencil"></i> 
                تعديل
                </button>
                <button class=" button-Products-delete">
                <i class="fa  fa-trash"></i> 
                حذف
                </button>
             </div>
          </div>
       </div> --}}
    </div>
    <div id="create_product" style="display:none;">
       <h4>إضافة منتج جديد</h4>
       <form action="{{airoute('front.mrchnt.product.store', 'locale'=>'en')}}" method="POST">
          @csrf
          <div class="row Register-input mt-2">
             <div class="col-md-6  my-1">
                <label>إسم المنتج</label>
                <input type="text" class="form-control" name="label" placeholder="أدخل إسم المنتج">
                @error('label')
                   <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                   </span>
                @enderror
             </div>
             <div class="col-md-6  my-1">
                <label>التصنيف الأساسي</label>
                <select class="form-control select">
                   <option  selected  >إختر التصنيف الأساسي</option>
                   <option>2</option>
                </select>
             </div>
             <div class="col-md-6  my-1">
                <label>التصنيف الفرعي</label>
                <select class="form-control select">
                   <option selected disabled>إختر التصنيف الفرعي</option>
                   <option>2</option>
                </select>
             </div>
             <div class="col-md-6  my-1">
                <label>السعر</label>
                <div class="input-group">
                   <input type="text" class="form-control" name="price" aria-label="Text input with dropdown button" placeholder="أدخل السعر">
                   <div class="input-group-append">
                      <select class="form-control select-input-group-append">
                         <option>USD</option>
                      </select>
                      @error('price')
                         <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                         </span>
                      @enderror
                   </div>
                </div>
             </div>
             <div class="col-md-6  my-1">
                <label>الخصم</label>
                <div class="input-group">
                   <input type="text" class="form-control" name="tax" aria-label="Text input with dropdown button" placeholder="أدخل نسبة الخصم">
                   <div class="input-group-append">
                      <span class="input-group-text input-group-text-cust" >%</span>
                   </div>
                   @error('tax')
                      <span class="invalid-feedback" role="alert">
                         <strong>{{ $message }}</strong>
                      </span>
                   @enderror
                </div>
             </div>
             <div class="col-md-6  my-1">
                <label>الكمية</label>
                <input type="text" name="qnty" class="form-control" placeholder="أدخل الكمية">
             </div>
             <div class="col-md-6  my-1">
                <label> المقاسات  المتوفرة</label>
                <div class="group-label-chack">
                   <label class="label-chack">
                      <input type="radio" name="product" value="s" class="card-input-element" />
                      <div class="panel panel-default card-input">
                         <div class="panel-heading">S</div>
                      </div>
                   </label>
                   <label class="label-chack">
                      <input type="radio" name="product" value="m" class="card-input-element" />
                      <div class="panel panel-default card-input">
                         <div class="panel-heading">M</div>
                      </div>
                   </label>
                   <label class="label-chack">
                      <input type="radio" name="product" value="l" class="card-input-element" />
                      <div class="panel panel-default card-input">
                         <div class="panel-heading">L</div>
                      </div>
                   </label>
                   <label class="label-chack">
                      <input type="radio" name="product" value="xl" class="card-input-element" />
                      <div class="panel panel-default card-input">
                         <div class="panel-heading">XL</div>
                      </div>
                   </label>
                   <label class="label-chack">
                      <input type="radio" name="product" value="2xl" class="card-input-element" />
                      <div class="panel panel-default card-input">
                         <div class="panel-heading">2XL</div>
                      </div>
                   </label>
                </div>
             </div>
             <div class="col-md-12  my-1">
                <label>الوصف</label>
                <textarea rows="3" type="text" class="form-control" name="" placeholder="أدخل الوصف"></textarea>
             </div>
             <div class="col-md-12 my-2 Products-img">
                <div class="Products-Main">
                   <label>الصورة الرئيسية</label>
                   <div class="Products-Main-img">
                      <i class="fa fa-camera"></i>
                      <div>  إضافة الصورة الرئيسية</div>
                   </div>
                </div>
                <div class="Products-Sub mx-4">
                   <label>الصورة الفرعية</label>
                   <div class="Products-Sub-img">
                      <i class="fa fa-camera"></i>
                      <div>  إضافة الصورة الفرعية</div>
                   </div>
                </div>
                <div class="Products-Vedio">
                   <label>إضافة فيديو إختياري</label>
                   <div class="Products-Vedio-img">
                      <i class="fa fa-camera"></i>
                      <div>  إضافة فيديو فقط</div>
                   </div>
                </div>
             </div>
             <div class="col-12 mt-2 Button_Add_New_Products">
                <button class="button-Products-cancel ml-2" onclick="Products_save()">
                إلغاء
                </button>
                <button class="button-Products-save mr-2" type="submit"  onclick="Products_save()">
                <i class="fa fa-check"></i>
                حفظ المنتج
                </button>
             </div>
          </div>
       </form>
    </div>
@endsection

@section('js')
    <script>
        function add_Products_new(){
            $('#products_list').hide();
            $('#create_product').show();
        }
    </script>

   <script>
   $(".deleteRecord").click(function(e){
       e.preventDefault();
       let answer = window.confirm('هل أنت متأكد من عملية الحذف؟');
       let id = $(this).data("id");
       let url = "{{airoute('front.mrchnt.product.destroy', ['ID'])}}";
       var $tr = $(this).parents('.Products_col').first();
       if (answer)
       {
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
       }
       else {
       e.stopImmediatePropagation();
       e.preventDefault();
       }
 });
 </script>
@endsection
