@extends('layouts.auth')
@section('title') {{aitrans('sign in', [], 'client')}} @endsection
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('front/styles/RegisterPageEdit.css')}}">
@endsection
@section('content')
<div class="Register-Shop split-login " >
   <div class="Register-Shop-content  ">
      <div class="row">
         <div class="col-md-8 text-center pt-2 pl-5  pr-5 col-row-1 " >
            <!-- section 1 -->
            <a href="{{ airoute('aimeos_home', ['site' => 'default']) }}">
               <img src="{{asset('front/images/logo/Logo.png')}}" width="120" class="py-2">
            </a>
            <div id="section-login">
               <div id="login-account">
                  <div class="title py-2">{{aitrans('sign in', [], 'client')}}</div>
                  {{-- @if (count($errors) > 0)
                  <div class="alert alert-danger alert-dismissible fade show mt-4" role="alert">
                     @foreach ($errors->all() as $error)
                           <div class="mt-1">{{ $error }}</div> <br>
                     @endforeach
                  </div>
               @endif --}}
                  <div class="login-by-button	">
                     <a href="{{ url('auth/google') }}" class="btn btn-round btn-About-instagram  btn-outline-light cursor-pointer round">
                     <i class="fa fa-google"></i>
                     جوجل
                     </a>
                     <a href="{{ url('auth/facebook') }}" class="btn facebook btn-round btn-outline-light cursor-pointer">
                     <i class="fa fa-facebook"></i>
                     فيس بوك
                     </a>
                  </div>
                  <div class="login-or mt-3">
                     <label class="lable">
                      عبر البريد الإلكتروني
                     </label>
                     <div class="border-b">
                        <div class="border-b col-md-6">
                        </div>
                     </div>
                  </div>
                  <form action="{{airoute('login', ['site' => 'default'])}}" method="POST">
                     @csrf
                     <div class="login-input mb-5">
                           <div class="row d-flex justify-content-center mt-2">
                              <div class="col-md-6  my-1">
                                 <label>{{aitrans('E-mail', [], 'client')}}</label>
                                 <input class="form-control login-input" type="email" name="email" :value="old('email')" placeholder="{{aitrans('E-mail', [], 'client')}}" required autofocus>
                                 @error('email')
                                       <span class="text-danger" role="alert">
                                          <strong>{{ $message }}</strong>
                                       </span>
                                 @enderror
                              </div>
                           </div>
                           <div class="row d-flex justify-content-center mt-2">
                              <div class="col-md-6 my-1 ">
                                 <label>{{aitrans('Password', [], 'client')}}</label>
                                 <div class="input-icon ">
                                 <input type="password" id="password-field" class="form-control login-input" placeholder="{{aitrans('Password', [], 'client')}}" type="password" name="password" required autocomplete="current-password">
                                 <span toggle="#password-field" class="fa fa-fw field-icon toggle-password fa-eye"></span>
                                    @error('password')
                                          <span class="text-danger" role="alert">
                                             <strong>{{ $message }}</strong>
                                          </span>
                                    @enderror
                                 </i>
                                 </div>
                              </div>
                           </div>
                           <div class="d-flex justify-content-center mt-2">
                              <div class="col-md-6 my-1 d-flex justify-content-between">
                                 <div class="form-check ">
                                 <input type="checkbox" name="remember" class="form-check-input" id="remember_me" onclick="myFunction()">
                                 <label class="form-check-label" for="remember_me">تذكرني</label>
                                 </div>
                                 @if (Route::has('password.request'))
                                       <a href="{{ airoute('password.request', ['site' => 'default']) }}">
                                          <div class="cursor-pointer" onclick="ForgotPassword()">
                                             هل نسيت كلمة المرور ؟
                                          </div>
                                       </a>
                                 @endif
                                 
                              </div>
                           </div>
                     </div>
                     <div class="Register-next  mt-5">
                           <button type="submit" class="btn btn-danger cursor-pointer round-20  ">
                           تسجيل الدخول
                           </button>
                           <div class="have-account ">
                              <span> هل لديك حساب ؟</span>
                              <a href="{{airoute('usr_register', ['site' => 'default'])}}" class="text-danger cursor-pointer">إنشاء حساب</a>
                           </div>
                     </div>
                  </form>
               </div>
               <div id="Create-account">
                  <div class="title py-2">إنشاء حساب</div>
                  <div class="login-by-button	">
                     <button class="btn  btn-About-twitter  btn-outline-light cursor-pointer round">
                     <i class="fa fa-twitter"></i>
                     تويتر
                     </button>
                     <button class="btn   btn-About-instagram  btn-outline-light cursor-pointer round">
                     <i class="fa fa-google"></i>
                     جوجل
                     </button>
                     <button class="btn facebook  btn-outline-light cursor-pointer">
                     <i class="fa fa-facebook"></i>
                     فيس بوك
                     </button>
                  </div>
                  <div class="login-or mt-3">
                     <label class="lable">
                     أو التسجيل
                     </label>
                     <div class="border-b">
                        <div class="border-b col-md-6">
                        </div>
                     </div>
                  </div>
                  <div class="row Create-account-input mb-5">
                     <div class="col-md-6">
                        <label>الاسم كامل</label>
                        <input type="text" class="  form-control" placeholder="أدخل الاسم كامل">
                     </div>
                     <div class="col-md-6 ">
                        <label>البريد الإلكتروني</label>
                        <input type="text" class="  form-control" placeholder="ادخل البريد الإلكتروني">
                     </div>
                     <div class="col-md-6">
                        <label>رقم الجوال</label>
                        <!-- <input type="text" class="  form-control" placeholder="أدخل رقم الجوال"> -->
                        <div >
                           <input  type="tel" class="form-control input-tel">
                        </div>
                     </div>
                     <div class="col-md-6 ">
                        <label>كلمة المرور</label>
                        <div class="input-icon ">
                           <input type="text" class="  form-control" placeholder="إبحث عن متجر">
                           <i class="btn btn-sm   cursor-pointer fa fa-eye mt-cust f-left">
                           </i>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <label>المدينة</label>
                        <select class="form-control select">
                           <option selected disabled>إختر المدينة</option>
                           <option>2</option>
                           <option>3</option>
                           <option>4</option>
                           <option>5</option>
                        </select>
                     </div>
                     <div class="col-md-6">
                        <label>العنوان</label>
                        <input type="text" class="  form-control" placeholder="مثال: بجانب مدرسة فلسطين">
                     </div>
                  </div>
                  <div class="Register-next  mt-5">
                     <a onclick="login()" class="btn  btn-danger cursor-pointer round-20  ">
                     إنشاء حساب
                     </a>
                     <div class="have-account ">
                        <span> لديك حساب بالفعل ؟</span>
                        <a onclick="login()" class="text-danger cursor-pointer">تسجيل الدخول</a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-md-4 Register-bg"> 
         </div>
      </div>
   </div>
</div>
@endsection

@section('js')
   <script>
      $(".toggle-password").click(function() {
         $(this).toggleClass("fa-eye fa-eye-slash");
         var input = $($(this).attr("toggle"));
         if (input.attr("type") == "password") {
            input.attr("type", "text");
         } else {
            input.attr("type", "password");
         }
      });
   </script>
@endsection
