


@extends('layouts.auth')
@section('title') {{aitrans('Password Reset', [], 'client')}} @endsection
@section('content')
<div class="Register-Shop split-login " >
    <div class="Register-Shop-content  ">
        <div class="row">
            <div class="col-md-8 text-center pt-2 pl-5  pr-5 col-row-1 " >
                <!-- section 1 -->
                <a href="#">
                    <img src="{{asset('front/images/logo/Logo.png')}}" width="120" class="py-2">
                </a>
                <div>
                    <form method="POST" action="{{ airoute('password.update') }}">
                        @csrf
                        <!-- Password Reset Token -->
                        <input type="hidden" name="token" value="{{ $request->route('token') }}">
                        <!-- Email Address -->
                        <div class="title py-2">{{aitrans('Please enter a new password', [], 'client')}}</div>
                        <div class="mt-3">{{aitrans('Please enter a new password', [], 'client')}}</div>
                        <div class="login-input py-4">
                            <div class="row d-flex justify-content-center ">
                                <div class="col-md-6  my-1">
                                <label>{{aitrans('E-Mail', [], 'client')}}</label>
                                <input type="email" class="form-control" name="email" value="{{old('email', $request->email)}}" required autofocus placeholder="{{aitrans('E-Mail', [], 'client')}}">
                                @error('email')
                                    <span class="text-danger d-block pt-1" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                            </div>
                            <div class="row d-flex justify-content-center mt-2">
                                <div class="col-md-6 my-1 ">
                                <label>{{aitrans('new password', [], 'client')}}</label>
                                <div class="input-icon ">
                                    <input type="password" class="form-control" name="password" required >
                                    @error('password')
                                        <span class="text-danger d-block pt-1" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <i class="btn btn-sm cursor-pointer fa fa-eye mt-cust f-left">
                                    </i>
                                </div>
                                </div>
                            </div>
                            {{-- <div class="row d-flex justify-content-center ">
                                <div class="col-md-6  ">
                                <span>يجب أن يكون 8 أحرف على الأقل</span>
                                </div>
                            </div> --}}
                            <div class="row d-flex justify-content-center mt-2">
                                <div class="col-md-6 my-1 ">
                                <label>{{aitrans('Password Reset', [], 'client')}}</label>
                                <div class="input-icon ">
                                    <input type="password" class="form-control" name="password_confirmation" required>
                                    @error('password_confirmation')
                                        <span class="text-danger d-block pt-1" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <i class="btn btn-sm cursor-pointer fa fa-eye mt-cust f-left">
                                    </i>
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
                    
                </div>
          </div>
          <div class="col-md-4 Register-bg"> 
          </div>
       </div>
    </div>
</div>
@endsection
