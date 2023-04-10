@extends('layouts.auth')
@section('title') {{aitrans('confirm password', [], 'client')}}@endsection
@section('content')
<div class="Register-Shop split-login " >
    <div class="Register-Shop-content  ">
        <div class="row">
            <div class="col-md-8 text-center pt-2 pl-5  pr-5 col-row-1 " >
                <!-- section 1 -->
                <a href="{{ airoute('aimeos_home', ['site' => 'default']) }}">
                    <img src="{{asset('front/images/logo/Logo.png')}}" width="120" class="py-2">
                </a>
                <div>
                    <form method="POST" action="{{ airoute('password.confirm') }}">
                        @csrf
                        <div class="title py-2">{{aitrans('Verification code', [], 'client')}}</div>
                        <div class="my-3">{{aitrans('Enter the verification code sent to you via email', [], 'client')}}</div>
                        <div>Palestinian@gmail.com</div>
                        <br>
                        <div class="row d-flex justify-content-center py-4">
                            <div class="col-md-7">
                                <div class="row text-center">
                                <div class="col-2">
                                {{-- <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" /> --}}
                                    <input type="text" class="Code" placeholder="-">
                                </div>
                                <div class="col-2">
                                    <input type="text" class="Code" placeholder="-">
                                </div>
                                <div class="col-2">
                                    <input type="text" class="Code" placeholder="-">
                                </div>
                                <div class="col-2">
                                    <input type="text" class="Code" placeholder="-">
                                </div>
                                <div class="col-2">
                                    <input type="text" class="Code" placeholder="-">
                                </div>
                                <div class="col-2">
                                    <input type="text" class="Code" placeholder="-">
                                </div>
                                </div>
                                <div class="mt-3 text-right">
                                <span>{{aitrans('Did the code arrive?', [], 'client')}}</span>
                                <span>01:33</span>
                                <a href="#" class="text-danger">{{aitrans('Resend', [], 'client')}}</a>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-3"></div>
                            <div class="col">
                                <button type="submit" class="btn btn-danger cursor-pointer round-20" style="width: 100%;">
                                    {{aitrans('save', [], 'client')}}
                                </button>
                            </div>
                            <div class="col-md-3"></div>
                        </div>
                    </form>
                </div>
                <div id="Check-Verification-Code">
                    <div class="row d-flex justify-content-center mt-5 py-4">
                        <div class="col-md-7 text-center mt-5">
                            <div class="d-flex justify-content-center">
                            <lottie-player src="js/progress2.json"    background="transparent"  speed="1"  loop  autoplay></lottie-player>
                            </div>
                            <div class="mt-n4  msg-progres" >
                            {{aitrans('Verifying', [], 'client')}}
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


