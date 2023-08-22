@extends('auth.layout')

@section('contents')
<div class="login-wrapper">
    <div class="login-header">
        <a href="{{ url('/') }}">
            <img src="{{ asset(settings()->header_logo ?? '') }}" alt="logo">
        </a>
    </div>
    <div class="login-body">
        <h2>{{ __('Forgot Your Password') }}</h2>
        <form action="{{ route('password.update') }}" method="post" >
            @csrf
            <div class="input-group">
                <span><img src="{{ asset('assets/login/img/icons/mail.svg') }}" alt=""></span>
                <input type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="example@domain.com">
                @if($errors->has('email')) <p class="text-danger">{{ $errors->first('email') }}</p> @endif
            </div>
            <div class="input-group">
                <span><img height="16px" width="18px" src="{{ asset('assets/login/img/icons/pin.png') }}" alt=""></span>
                <input type="text" name="verification_code" value="{{ old('verification_code') }}" class="form-control" placeholder="Verification Code">
                @if($errors->has('verification_code')) <p class="text-danger">{{ $errors->first('verification_code') }}</p> @endif
            </div>
            <div class="input-group">
                <span><img src="{{ asset('assets/login/img/icons/Lock.svg') }}" alt=""></span>
                <input type="password" id="myPass" name="password" class="form-control" placeholder="Password">
                @if($errors->has('password')) <p class="text-danger">{{ $errors->first('password') }}</p> @endif
            </div>
            <div class="input-group">
                <span><img src="{{ asset('assets/login/img/icons/Lock.svg') }}" alt=""></span>
                <input type="password" id="myPas" name="password_confirmation" class="form-control" placeholder="Re-type Password">
            </div>
            <button type="submit" class="btn login-btn">{{ __('Reset Password') }}</button>
        </form>
        <div class="login-footer">
            <a href="{{ route('login') }}"><span><img src="{{ asset('assets/login/img/icons/Lock.svg') }}" alt=""></span>{{ __('Login Here') }}</a>
        </div>
    </div>
</div>
@endsection
