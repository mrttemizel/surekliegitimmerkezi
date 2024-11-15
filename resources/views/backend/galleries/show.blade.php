@extends('backend.components.master')
@section('title')
    Ön Kayıt Listesi
@endsection
@section('css')
    <link href="{{asset('backend/assets/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">

@endsection
@section('content')
    @component('backend.components.breadcrumb')
        @slot('li_1')
            Galleries
        @endslot
        @slot('title')
            Galleries Listesi
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            @if (session()->get('success'))
                <div class="alert alert-success alert-dismissible alert-solid alert-label-icon fade show"
                     role="alert">
                    <i class="ri-check-double-line label-icon"></i><strong>  {{ session()->get('success') }}</strong></strong>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"
                            aria-label="Close"></button>
                </div>
            @endif
            @if (session()->get('error'))
                <div class="alert alert-danger alert-dismissible alert-solid alert-label-icon fade show"
                     role="alert">
                    <i class="ri-check-double-line label-icon"></i><strong>  {{ session()->get('error') }}</strong></strong>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"
                            aria-label="Close"></button>
                </div>
            @endif
            <div class="row">
                <div class="col-lg-12">
                    <h1>{{ $gallery->title }}</h1>
                    <img src="{{ asset('storage/' . $gallery->cover_image) }}" alt="{{ $gallery->title }}" width="200">
                    <p>Status: {{ ucfirst($gallery->status) }}</p>

                    <h2>Images</h2>
                    <form action="{{ route('admin.galleries.uploadImages', $gallery->id) }}" method="POST"
                          enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="images[]" multiple>
                        <button type="submit" class="btn btn-primary">Upload Images</button>
                    </form>

                    <div class="gallery-images">
                        @foreach($gallery->images as $image)
                            <img src="{{ asset('storage/' . $image->image_path) }}" alt="Gallery Image" width="100">
                        @endforeach
                    </div>

                </div>
            </div><!--end row-->
        </div>
    </div>

@endsection

@section('addjs')
@endsection

