@extends('backend.components.master')
@section('title')
    Galleries
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
                <h1>Manage Images for {{ $gallery->title }}</h1>

                <!-- Resim Yükleme Formu -->
                <form action="{{ route('gallery.uploadImages', $gallery->id) }}" method="POST" enctype="multipart/form-data" class="mb-4">
                    @csrf
                    <div class="mb-3">
                        <label for="images" class="form-label">Select Images</label>
                        <input type="file" name="images[]" id="images" class="form-control" multiple required>
                    </div>
                    <button type="submit" class="btn btn-primary">Upload Images</button>
                </form>

                <!-- Resimleri Listeleme -->
                <h3>Uploaded Images</h3>
                <div class="row">
                    @forelse($gallery->images as $image)
                        <div class="col-md-3 mb-4">
                            <div class="card">
                                <img src="{{ asset('storage/' . $image->image_path) }}" class="card-img-top" alt="Gallery Image">
                                <div class="card-body text-center">
                                    <form action="{{ route('gallery.deleteImage', $image->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p>No images uploaded for this gallery yet.</p>
                    @endforelse
                </div>



            </div>
        </div>
    </div>

@endsection

@section('addjs')
@endsection

