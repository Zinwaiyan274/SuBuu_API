@extends('auth.layout')

@section('contents')
<div class="login-wrapper">
    <div class="login-header">
        <a href="{{ url('/') }}">
            <img src="{{ asset(settings()->header_logo ?? '') }}" alt="logo">
        </a>
    </div>
    <div class="login-body">
        <h2>{{ __('Reset Your Password') }}</h2>
        @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <form action="{{ route('password.email') }}" method="post">
            @csrf
            <div class="input-group">
                <span><img src="{{ asset('assets/login/img/icons/mail.svg') }}" alt=""></span>
                <input type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="example@domain.com">
            </div>
            @if($errors->has('email')) <p class="text-danger">{{ $errors->first('email') }}</p> @endif
            <button type="submit" class="btn login-btn">{{ __('Send Verification Code') }}</button>
        </form>
        <div class="login-footer">
            <a href="{{ route('login') }}"><span><img src="{{ asset('assets/login/img/icons/Lock.svg') }}" alt=""></span>{{ __('Login Here') }}</a>
        </div>
    </div>
</div>
@endsection
