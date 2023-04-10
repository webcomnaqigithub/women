@extends('layouts.mrchnt.layout')
@section('title') الملف الشخصي @endsection

@section('account')
<div >
   <div class="row">
      <div class="col-6">
         <h4>الحساب</h4>
      </div>
      <div class="col-6 add_Products">
         <button class="button-account-edit" onclick="account_edit()">
         <i class="fa  fa-pencil"></i>
         تعديل الحساب
         </button>
         <button class="button-account-save-edit" onclick="account_save_edit()">
         <i class="fa  fa-check"></i>
         حفظ التعديلات
         </button>
      </div>
   </div>
   <div class="row">
      <div class="col-12   add-logo-account">
         شعار المتجر
         <div class="logo-account">
            <i class="fa fa-camera"></i>
         </div>
      </div>
   </div>
   <div class="row mt-3">
      <div class="col-md-6  my-1">
         <label>الاسم كامل</label>
         <input type="text" class="  form-control" placeholder="أدخل الاسم كامل">
      </div>
      <div class="col-md-6  my-1">
         <label>الاسم كامل</label>
         <input type="text" class="  form-control" placeholder="أدخل الاسم كامل">
      </div>
      <div class="col-md-6  my-1">
         <label>رقم الجوال</label>
         <div >
            <input  type="tel" class="form-control input-tel">
         </div>
      </div>
      <div class="col-md-6  my-1">
         <label>المدينة</label>
         <select class="form-control select">
            <option selected disabled>إختر المدينة</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
            <option>5</option>
         </select>
      </div>
      <div class="col-md-6 my-1">
         <label>العنوان</label>
         <input type="text" class="  form-control" placeholder="مثال: بجانب مدرسة فلسطين">
      </div>
      <div class="col-md-6 my-1">
         <label>كلمة المرور</label>
         <div class="input-icon">
            <input type="text" class="  form-control" placeholder="كلمة المرور">
            <i class="btn btn-sm   cursor-pointer fa fa-eye mt-cust f-left"> </i>
         </div>
      </div>
      <div class="col-md-12  my-1">
         <label>إسم المتجر</label>
         <input type="text" class="  form-control" placeholder="أدخل الاسم كامل">
      </div>
      <div class="col-md-12  my-1">
         <label>نبذة</label>
         <textarea rows="3" type="text" class="  form-control" placeholder="نبذة مختصرة"></textarea>
      </div>
   </div>
   <div class="row mt-1 mb-3">
      <div class="col-12   add-img-account">
         صورة النبذة
         <div class="img-account">
            <i class="fa fa-camera"></i>
         </div>
      </div>
   </div>
   <div class="row mt-5 mb-5">
      <div class="col-6">
         <h4> كلمة المرور</h4>
         <button class="button-password-change" onclick="password_change()">
         <i class="fa  fa-pencil"></i>
         تغير كلمة المرور
         </button>
      </div>
      <div class="col-6 add_Products">
         <button class="button-password-edit" onclick="password_edit()">
         <i class="fa  fa-pencil"></i>
         تغير كلمة المرور
         </button>
         <button class="button-password-save-edit"  onclick="password_save_edit()">
         <i class="fa  fa-check"></i>
         حفظ التغير
         </button>
      </div>
      <div class="col-md-6 my-1 input-password">
         <label> كلمة المرور الحالية</label>
         <div class="input-icon">
            <input type="text" class="  form-control" placeholder="أدخل كلمة المرور الحالية">
            <i class="btn btn-sm   cursor-pointer fa fa-eye mt-cust f-left"> </i>
         </div>
      </div>
      <div class="col-md-6 my-1 input-password">
         <label> كلمة المرور الجديدة</label>
         <div class="input-icon">
            <input type="text" class="  form-control" placeholder="أدخل كلمة المرور الجديدة">
            <i class="btn btn-sm   cursor-pointer fa fa-eye mt-cust f-left"> </i>
         </div>
      </div>
      <div class="col-md-6 my-1 input-password">
         <label> تأكيد كلمة المرور الجديدة</label>
         <div class="input-icon">
            <input type="text" class="  form-control" placeholder="تأكيد كلمة المرور الجديدة">
            <i class="btn btn-sm   cursor-pointer fa fa-eye mt-cust f-left"> </i>
         </div>
      </div>
   </div>
</div>
@endsection