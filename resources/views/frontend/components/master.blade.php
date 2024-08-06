<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">
<head>
    <!--================= Meta tag =================-->
    <meta charset="utf-8">
    <title>@yield('title')| ABU - Sürekli Eğitim Merkezi </title>
    <meta name="description" content="">
    <meta content="murattemizel" name="author" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!--================= Responsive Tag =================-->
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--================= Favicon =================-->
    <link rel="apple-touch-icon" href="{{asset('frontend/assets/images/fav.png')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('frontend/assets/images/logo/abu-favicon.png')}}">
    @include('frontend.components._partials._head-css')
</head>
<body>
<!--================= Preloader Section Start Here =================-->
@include('frontend.components._partials._preloader')
<!--================= Preloader Section End Here =================-->

<!--================= Header Section Start Here =================-->
@include('frontend.components._partials._header')
<!--================= Header Section End Here =================-->



<!--================= Wrapper Start Here =================-->
@yield('content')
<!--================= Wrapper End Here =================-->


<!-- WhatsApp Button -->
<a href="https://wa.me/905498086685" class="whatsapp-button" target="_blank">
    <img src="{{asset('backend/my-image/whatsapp.png')}}" alt="WhatsApp">
</a>

<!--================= Footer Section Start Here =================-->
@include('frontend.components._partials._footer')
<!--================= Footer Section End Here =================-->

<!--================= Scroll to Top Start =================-->
@include('frontend.components._partials._backscrollup')
<!--================= Scroll to Top End =================-->

@include('frontend.components._partials._vendor-scripts')
</body>
</html>
