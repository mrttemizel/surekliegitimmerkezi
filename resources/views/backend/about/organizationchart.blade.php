@extends('backend.components.master')
@section('title')
    Organizasyon Şema Sayfası
@endsection

@section('css')

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">

@endsection

@section('content')
    @component('backend.components.breadcrumb')
        @slot('li_1')
            Organizasyon Şema Sayfası
        @endslot
        @slot('title')
            Organizasyon Şema Sayfası Düzenle
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div class="card ">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1"> Organizasyon Şema Sayfası İçerik Yönetim Sayfası</h4>
                </div><!-- end card header -->
                <form action="{{ route('organization-chart.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="live-preview">
                            <div class="row gy-3">
                                <div class="col-md-12">
                                    <div>
                                        <label class="form-label">Organizasyon Şema Sayfa İçeriği</label>
                                        <textarea name="pagecontent" id="editor-1" class="form-control" rows="3">
                            {{ $data->pagecontent ?? 'Değer girilmemiş' }}
                        </textarea>
                                        <span class="text-danger">
                            @error('pagecontent')
                                            {{ $message }}
                                            @enderror
                        </span>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="hstack gap-2 justify-content-end">
                                        <button type="submit" class="btn btn-primary">Ekle</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('addjs')

    <script src="{{asset('backend/assets/libs/@ckeditor/ckeditor5-build-classic/build/ckeditor.js')}}"></script>

    <script>
        ClassicEditor
            .create(document.querySelector('#editor-1'), {
                // Editör araç çubuğu
                toolbar: [
                    'heading',
                    '|',
                    'bold',
                    'italic',
                    'link',
                    'bulletedList',
                    'numberedList',
                    'blockQuote',
                    '|',
                    'undo',
                    'redo',
                    '|',
                    'imageUpload',
                    'insertTable'  // Tablo ekleme
                ],
                // Resim yükleme yapılandırması
                ckfinder: {
                    uploadUrl: "{{ route('organization-chart.upload') }}?_token=" + document.querySelector('meta[name="csrf-token"]').content, // Laravel route

                },
                table: {
                    contentToolbar: [
                        'tableColumn',
                        'tableRow',
                        'mergeTableCells',
                        'tableProperties',
                        'tableCellProperties'
                    ]
                }
            })
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
