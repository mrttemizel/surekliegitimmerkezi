<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">

<head>

    <meta charset="utf-8" />
    <title>@yield('title')| ABU - Yönetim Sistemleri</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Mpanel - Yönetim Sistemleri" name="description" />
    <meta content="murattemizel" name="author" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{asset('backend/my-image/favicon.png')}}">

    @include('backend.components._partials._head-css')

</head>

<body>
@section('body')
    @include('backend.components._partials._body')
@show
<div id="layout-wrapper">

    @include('backend.components._partials._topbar')
    @include('backend.components._partials._sidebar')

    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                @yield('content')
            </div>

        </div>


      @include('backend.components._partials._footer')
    </div>


</div>



@include('backend.components._partials._customizer')


@include('backend.components._partials._vendor-scripts')

</body>

</html>
