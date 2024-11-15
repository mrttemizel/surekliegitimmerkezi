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
                <div class="col-lg-12">

                    <a href="{{ route('gallery.admincreate') }}" class="btn btn-primary">Yeni Galeri Ekle</a>
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Başlık</th>
                            <th>Kapak REsmi</th>
                            <th>Aksiyon</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($galleries as $gallery)
                            <tr>
                                <td>{{ $gallery->title }}</td>
                                <td><img src="{{ asset('storage/' . $gallery->cover_image) }}" alt="{{ $gallery->title }}" width="100"></td>
                                <td>
                                    <a href="{{ route('gallery.edit', $gallery->id) }}" class="btn btn-warning">Düzenle</a>
                                    <!--<a href="" class="btn btn-info">Add Images</a> -->
                                    <a href="{{ route('gallery.manageImages', $gallery->id) }}" class="btn btn-info">Resimleri Yönet</a>

                                    <form action="{{ route('gallery.delete', $gallery->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Sil</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div><!--end row-->
        </div>
    </div>

@endsection

@section('addjs')
@endsection

