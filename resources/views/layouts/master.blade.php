<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="{{__('IE=edge')}}">
    <meta name="viewport" content="{{__('width=device-width, initial-scale=1.0')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ env("APP_NAME") ? env("APP_NAME").' - ':'' }} @yield('title')</title>
    <link rel="apple-touch-icon" href="{{ asset(settings()->favicon) }}">
    <link rel="icon" href="{{ asset(settings()->favicon) }}">
    @include('layouts.partials.styles')
</head>
<body>

<!-- Side Bar Start -->
@include('layouts.partials.side-bar')
<!-- Side Bar End -->
<div class="section-container">
    <!-- header start -->
    @include('layouts.partials.header')
    <!-- header end -->
    <!-- erp-state-overview-section start -->
    @yield('main_content')
    <!-- erp-state-overview-section end -->
    @yield('modal')
</div>

@include('layouts.partials.script')

</body>
</html>
