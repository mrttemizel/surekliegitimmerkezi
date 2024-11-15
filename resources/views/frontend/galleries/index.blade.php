@extends('frontend.components.master')
<style>
    /* Gallery Card Styling */
    .gallery-card {
        position: relative;
        overflow: hidden;
        border-radius: 15px;
        transition: transform 0.3s ease;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .gallery-card:hover {
        transform: scale(1.02);
    }

    .gallery-image-container {
        position: relative;
    }

    .gallery-image-container img {
        border-radius: 15px;
        transition: transform 0.3s ease;
    }

    .gallery-image-container:hover img {
        transform: scale(1.05);
    }

    .gallery-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        border-radius: 15px;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .gallery-image-container:hover .gallery-overlay {
        opacity: 1;
    }

    .gallery-title-container {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
        z-index: 2;
        color: white;
        font-weight: bold;
        font-size: 1.5rem;
        text-shadow: 0px 2px 5px rgba(0, 0, 0, 0.7);
        transition: all 0.3s ease;
    }

    .gallery-title {
        margin: 0;
        color: white;
        font-weight: bold;
    }

    .text-decoration-none {
        text-decoration: none !important;
    }
</style>
@section('title')
    Galeri
@endsection

@section('content')
    <div class="react-wrapper">
        <div class="react-wrapper-inner">
            <!--================= Breadcrumbs Section Start Here =================-->
            <div class="react-breadcrumbs">
                <div class="breadcrumbs-wrap">
                    <img class="desktop" src="{{ asset('frontend/assets/images/egitimler.jpg') }}" alt="Breadcrumbs">
                    <img class="mobile" src="{{ asset('frontend/assets/images/egitimler.jpg') }}" alt="Breadcrumbs">
                    <div class="breadcrumbs-inner">
                        <div class="container">
                            <div class="breadcrumbs-text">
                                <h1 class="breadcrumbs-title">Galeri</h1>
                                <div class="back-nav">
                                    <ul>
                                        <li><a href="{{ route('home.index') }}">Anasayfa</a></li>
                                        <li><a href="{{ route('gallery.index') }}">Galeri</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--================= Breadcrumbs Section End Here =================-->

            <!--================= Gallery Images Section Start Here =================-->
            <div class="container my-5">
                <div class="row">
                    @foreach($galleries as $gallery)
                        <div class="col-md-4 col-sm-6 mb-4">
                            <div class="gallery-card position-relative">
                                <a href="{{ route('gallery.frontshow', $gallery->id) }}" class="text-decoration-none">
                                    <div class="gallery-image-container">
                                        <img src="{{ asset('storage/' . $gallery->cover_image) }}" alt="{{ $gallery->title }}" class="img-fluid w-100 rounded">
                                        <div class="gallery-overlay"></div>
                                        <div class="gallery-title-container">
                                            <h5 class="gallery-title">{{ $gallery->title }}</h5>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <!--================= Gallery Images Section End Here =================-->
        </div>
    </div>
    <!--================= Wrapper End Here =================-->
@endsection
