@extends('auth.layout')

@section('contents')
<div class="login-wrapper">
    <div class="login-header">
        <a href="{{ url('/') }}">
            <img src="{{ asset(settings()->header_logo ?? '') }}" alt="logo">
        </a>
    </div>
    <div class="login-body">
        <h2>{{ __(env("APP_NAME").' Login Panel') }}</h2>
        <form method="POST" action="{{ route('login.custom') }}">
            @csrf
            @if ($errors->has('email'))
                <div class="text-danger">{{ $errors->first('email') }}</div>
            @endif
            @if ($errors->has('password'))
                <span class="text-danger">{{ $errors->first('password') }}</span>
            @endif
            <div class="input-group">
                <span><img src="{{ asset('assets/login/img/icons/mail.svg') }}" alt="img"></span>
                <input type="email" class="form-control" id="email" placeholder="Email" name="email" value="{{ old('email') ?? 'admin@admin.com' }}">
            </div>
            <div class="input-group">
                <span><img src="{{ asset('assets/login/img/icons/Lock.svg') }}" alt="img"></span>
                <span class="hide-pass">
                    <img src="{{ asset('assets/login/img/icons/Hide.svg') }}" alt="{{ asset('assets/login/img/icons/Hide.svg') }}">
                    <img src="{{ asset('assets/login/img/icons/show.svg') }}" alt="{{ asset('assets/login/img/icons/show.svg') }}">
                </span>
                <input type="password" id="password" name="password" class="form-control" placeholder="Password" value="admin">
            </div>
            <button type="submit" class="btn login-btn">{{ __('Login') }}</button>
        </form>

        <div class="login-footer">
            <a href="{{ route('password.request') }}"><span><img src="{{ asset('assets/login/img/icons/Lock.svg') }}" alt=""></span>{{ __('Forgot Password?') }}</a>
        </div>
    </div>
</div>
@endsection
