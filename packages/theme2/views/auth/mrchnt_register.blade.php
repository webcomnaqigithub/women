@extends('layouts.auth')
@section('title') register @endsection
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('front/styles/RegisterPageEdit.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('front/styles/profilePhoto.css')}}">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/8.4.6/css/intlTelInput.css" rel="stylesheet" />
@endsection
@section('content')
<div class="Register-Shop bigen-container-shop" style="margin-top: 50px;margin-bottom: 108px;">
    <div class="Register-Shop-content">
        <div class="row">
                <div class="col-md-8 text-center pt-2 pl-5  pr-5 col-row-1"  >
                    <form action="{{airoute('mrchnt_register')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <!-- section 1 -->
                            <a href="{{ airoute('aimeos_home', ['site' => 'default']) }}">
                                <img src="{{asset('front/images/logo/Logo.png')}}" width="120" class="py-2">
                            </a>
                            <div class="title py-2">{{aitrans('Join as a shop', [], 'client')}}</div>
                            {{-- @if (count($errors) > 0)
                                <div class="alert alert-danger alert-dismissible fade show mt-4" role="alert">
                                    @foreach ($errors->all() as $error)
                                        <div class="mt-1">{{ $error }}</div> <br>
                                    @endforeach
                                </div>
                            @endif --}}
                            <div class="containerPersonalImag">
                                <div>
                                    <div class="avatar-edit">
                                        <input type='file' name="icon" id="imageUpload" accept=".png, .jpg, .jpeg" />
                                        <label for="imageUpload"></label>
                                    </div>
                                    <div class="avatar-preview">
                                        <div id="imagePreview" style="background-image: url(https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcShI303PrApWb4AdQYGoqctcZZaC6nluhN8fcG5911GGPDXSWjY8YmJF4penid5FKYRvx0&usqp=CAU);">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="Register-Logo-shop ">
                                <div>
                                    {{aitrans('Store logo', [], 'client')}}
                                </div>
                                @error('icon')
                                    <span class="text-danger d-block pt-1" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="row Register-input  Register-input2">
                                <div class="col-md-12  mb-1">
                                    <label>{{aitrans('Store name', [], 'client')}}</label>
                                    <input type="text" class="form-control" value="{{old('label')}}" placeholder="{{aitrans('Store name', [], 'client')}}" name="label">
                                    @error('label')
                                        <span class="text-danger d-block pt-1" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-12  my-1">
                                    <label>{{aitrans('Brief', [], 'client')}}</label>
                                    <textarea rows="3" type="text" name="summary" class="form-control" placeholder="{{aitrans('Abstract', [], 'client')}}">{{old('summary')}}</textarea>
                                    @error('summary')
                                        <span class="text-danger d-block pt-1" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row Register-input mt-2" style="margin-top:0 !important;">
                                <div class="col-md-6 my-1">
                                    <label>{{aitrans('Full Name', [], 'client')}}</label>
                                    <input type="text" name="name" class="form-control" placeholder="{{aitrans('Full Name', [], 'client')}}" value="{{ old('name') }}">
                                    @error('name')
                                        <span class="text-danger d-block pt-1" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6 my-1 ">
                                    <label>{{aitrans('E-mail', [], 'client')}}</label>
                                    <input type="email" name="email" class="form-control text-right" placeholder="{{aitrans('E-mail', [], 'client')}}" value="{{ old('email') }}">
                                    @error('email')
                                    <span class="text-danger d-block pt-1" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6  my-1">
                                    <label>{{aitrans('Mobile number', [], 'client')}}</label>
                                    <!-- <input type="text" class="  form-control" placeholder="أدخل رقم الجوال"> -->
                                    <div>
                                        <input type="tel" id="phone" name="phone" class="form-control input-tel regxnum" max="10" min="9" value="{{ old('phone') }}">
                                    </div>
                                    @error('phone')
                                        <span class="text-danger d-block pt-1" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6 my-1">
                                    <label>{{aitrans('Password', [], 'client')}}</label>
                                    <div class="input-icon ">
                                        <input type="password" id="password-field" name="password" class="form-control text-right" placeholder="{{aitrans('Password', [], 'client')}}">
                                        <span toggle="#password-field" class="fa fa-fw field-icon toggle-password fa-eye"></span>
                                    </div>
                                    @error('password')
                                        <span class="text-danger d-block pt-1" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6  my-1">
                                    <label> {{aitrans('City', [], 'client')}}</label>
                                    <select class="form-control select" name="city">
                                        <option selected disabled>{{aitrans('Choose the city', [], 'client')}}</option>
                                        <option value="غزة" class="" @if(old('city') == 'غزة') selected @endif >غزة</option>
										<option value="الوسطى" class="" @if(old('city') == 'الوسطى') selected @endif>الوسطى</option>
										<option value="الشمال" class="" @if(old('city') == 'الشمال') selected @endif>الشمال</option>
										<option value="رفح" class="" @if(old('city') == 'رفح') selected @endif>رفح</option>
                                    </select>
                                    @error('city')
                                        <span class="text-danger d-block pt-1" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6 my-1 ">
                                <label>{{aitrans('the address', [], 'client')}}</label>
                                    <input type="text" class="form-control" name="address1" placeholder="{{aitrans('Example: Next to Palestine School', [], 'client')}}" value="{{ old('address1') }}">
                                    @error('address1')
                                        <span class="text-danger d-block pt-1" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="form-check text-right">
                                <input type="checkbox" name="privacy" class="form-check-input" id="myCheck" onclick="myFunction()">
                                <label class="form-check-label" for="myCheck">{{aitrans('I have read and agree to', [], 'client')}}</label>
                                <u><a href="#" class="text-danger font-weight-bold">{{aitrans('Read terms and conditions', [], 'client')}}</a></u>
                            </div>
                            <div class="Register-next mt-5">
                                <button type="submit" class="btn btn-danger cursor-pointer round-20" style="width: 50%;">
                                    {{aitrans('joining', [], 'client')}}
                                </button>
                            </div>
                            <div class="Register-next  mt-5">
                                <div class="have-account ">
                                    <span> {{aitrans('Already have an account?', [], 'client')}}</span>
                                    <a href="{{airoute('login', ['site' => 'default'])}}" class="text-danger d-block pt-1" style="line-height:3;width: unset;">{{aitrans('Login', [], 'client')}}</a>
                                </div>
                            </div>
                    </form>
                </div>
            <div class="col-md-4 Register-bg"></div>
        </div>
        <div class="Register-Shop-Footer d-flex justify-content-between" >
            <a href="#"  data-toggle="modal" data-target="#languages-modal" class="d-flex cursor-pointer text-white">
                <img src="{{asset('front/images/logo/language.png')}}" width="18" height="18" class="mt-1 ml-1">العربية
                <div>
                    <svg id="expand_more_black_24dp" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24">
                        <path id="Path_13265" data-name="Path 13265" d="M24,24H0V0H24Z" fill="none" opacity="0.87"/>
                        <path id="Path_13266" data-name="Path 13266" d="M15.88,9.29,12,13.17,8.12,9.29A1,1,0,0,0,6.71,10.7l4.59,4.59a1,1,0,0,0,1.41,0L17.3,10.7a1,1,0,0,0,0-1.41,1.017,1.017,0,0,0-1.42,0Z" fill="#525457"/>
                    </svg>
                </div>  
            </a>
            <div> {{aitrans('All rights reserved to ', [], 'client')}} <a href="https://mowa.gov.ps/" target="_blank">{{aitrans('Ministry of Women Affairs', [], 'client')}}</a> © 2022 </div>
        </div>
    </div>
    <div class="modal fade" id="languages-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered bd-example-modal-sm d-flex justify-content-center" role="document">
        <div class="modal-content modal-sm ">
            <div class="modal-header-cust text-right">
                <h5 class="modal-title" id="exampleModalLongTitle">
                    <img src="{{asset('front/images/logo/language.png')}}" width="18" height="18" class="mt-1 ml-1">
                    {{aitrans('Select the language you want', [], 'client')}}
                </h5>
                <button type="button" class="close ml-n3" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                        <i class="fa fa-times-circle"></i>
                    </span>
                </button>
            </div>
            <div class="modal-body languages mt-n3 ">
                <div class=" language " data-dismiss="modal">
                    <img src="{{asset('front/images/icon/l1.png')}}" width="35">
                    <label>العربية</label>
                </div>
                <div class=" language " data-dismiss="modal">
                    <img src="{{asset('front/images/icon/l2.png')}}" width="35">
                    <label>English</label>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
@endsection

@section('js')
    <script src="{{asset('front/js/personalImagUpload.js')}}"></script>
    <script>
        var allCountries = [ 
            [ "فلسطين", "ps", "970" ], 
            [ "فلسطين", "ps", "970" ], 
            [ "فلسطين", "ps", "970" ], 
        ];
    </script>
    <script src="{{asset('front/js/intlTelInput.js')}}"></script>
    {{-- <script>
        $(".input-tel").intlTelInput({
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/8.4.6/js/utils.js"
        });
    </script> --}}
    <script>
        var input = document.querySelector("#phone");
        // window.intlTelInput(input, {
        //     utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/8.4.6/js/utils.js",
        // });
        $(".input-tel").intlTelInput({
            utilsScript: "{{asset('front/js/utils.js')}}"
        });
        var iti = intlTelInput(input);
        $(document).ready(function(){
            $('#phone_code').val(iti.getSelectedCountryData().dialCode);
            input.addEventListener("countrychange", function() {
                // alert('ss');
                $('#phone_code').val(iti.getSelectedCountryData().dialCode);
            });
        });
    </script>
    {{-- <script>
        $('#previous').click(function(){
            $('#section2').hide();
            $('#section1').show();
        });
    </script> --}}
    <script>
        $('.regxnum').on('input', function() {
            $(this).val($(this).val().replace(/[^0-9]/gi, ''));
        });
    </script>
@endsection
