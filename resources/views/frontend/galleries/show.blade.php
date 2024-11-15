@extends('frontend.components.master')
<style>
    .gallery-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 15px;
    }

    .gallery-item {
        position: relative;
        overflow: hidden;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .gallery-item:hover {
        transform: scale(1.05);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }

    .gallery-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 10px;
        transition: transform 0.3s ease;
    }

    .gallery-img:hover {
        transform: scale(1.1);
    }

    .btn-secondary {
        background-color: #6c757d;
        color: white;
        border: none;
        padding: 10px 20px;
        font-size: 14px;
        border-radius: 5px;
        text-decoration: none;
    }

    .btn-secondary:hover {
        background-color: #5a6268;
        color: white;
    }
</style>
@section('title')
    Galeri - {{ $gallery->title }}
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
                                <h1 class="breadcrumbs-title">{{ $gallery->title }}</h1>
                                <div class="back-nav">
                                    <ul>
                                        <li><a href="{{ route('home.index') }}">Anasayfa</a></li>
                                        <li><a href="{{ route('gallery.index') }}">Galeri</a></li>
                                        <li>{{ $gallery->title }}</li>
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
                <!-- Galeriye Dön Butonu -->
                <a href="{{ route('gallery.frontindex') }}" class="btn btn-secondary mt-3">Galeriye Dön</a>
                <div class="row">
                    <div class="gallery-grid">
                        @forelse($gallery->images as $image)
                            <div class="gallery-item">
                                <img src="{{ asset('storage/' . $image->image_path) }}" alt="{{ $gallery->title }}"
                                     class="gallery-img">
                            </div>
                        @empty
                            <p class="text-center">No images available in this gallery.</p>
                        @endforelse
                    </div>
                </div>
            </div>
            <!--================= Gallery Images Section End Here =================-->
        </div>
    </div>
    <!--================= Wrapper End Here =================-->
@endsection
