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
            Galeri
        @endslot
        @slot('title')
            Galeri Listesi
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
                <div class="col-lg-8">
                    <form action="{{ route('gallery.update', $gallery->id) }}" method="POST"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Title Field -->
                        <div class="mb-3">
                            <label for="title" class="form-label">Başlık</label>
                            <input type="text" name="title" id="title" class="form-control"
                                   value="{{ $gallery->title }}" required>
                        </div>

                        <!-- Cover Image Field -->
                        <div class="mb-3">
                            <label for="cover_image" class="form-label">KApak Resmie</label>
                            <input type="file" name="cover_image" id="cover_image" class="form-control">
                            <img src="{{ asset('storage/' . $gallery->cover_image) }}" alt="{{ $gallery->title }}"
                                 width="100" class="mt-2 rounded">
                        </div>

                        <!-- Status Field -->
                        <div class="mb-3">

                            <select class="form-select" name="status" id="status" hidden="hidden">
                                <option value="active" {{ $gallery->status == 'active' ? 'selected' : '' }}>Active
                                </option>
                                <option value="inactive" {{ $gallery->status == 'inactive' ? 'selected' : '' }}>
                                    Inactive
                                </option>
                            </select>

                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary">Galeriyi Güncelle</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('addjs')
@endsection

