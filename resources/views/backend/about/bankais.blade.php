@extends('backend.components.master')
@section('title')
    Banka ve İş Birlikleri
@endsection

@section('css')

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">

@endsection

@section('content')
    @component('backend.components.breadcrumb')
        @slot('li_1')
            Banka ve İş Birlikleri
        @endslot
        @slot('title')
            Banka ve İş Birlikleri Düzenle
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div class="card ">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Banka ve İş Birlikleri</h4>
                </div><!-- end card header -->
                <form action="{{route('banka-is.update')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="live-preview">
                            <div class="row gy-3">
                                <div class="col-md-12">
                                    <div>
                                        <label class="form-label">Banka Hesap Bilgileri </label>
                                        <textarea name="banka" id="editor-1" class="form-control " rows="3">{{ $data->banka ?? 'Değer girilmemiş' }}</textarea>
                                        <span class="text-danger">
                                    @error('banka')
                                            {{ $message }}
                                            @enderror
                            </span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div>
                                        <label class="form-label">İş Birliği Yaptığımız Kurumlar</label>
                                        <textarea name="isbirligi" id="editor-2" class="form-control " rows="3">{{ $data->isbirligi ?? 'Değer girilmemiş' }}</textarea>
                                        <span class="text-danger">
                                    @error('isbirligi')
                                            {{ $message }}
                                            @enderror
                            </span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div>
                                        <label class="form-label">İş Birliği Yaptığımız Kurumlara Verilen Eğitimler </label>
                                        <textarea name="kurumlar" id="editor-3" class="form-control " rows="3">{{ $data->kurumlar ?? 'Değer girilmemiş' }}</textarea>
                                        <span class="text-danger">
                                    @error('kurumlar')
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
                    </div><!-- end card body -->
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
                // Editör ayarları
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
                    'insertTable'  // Tablo oluşturma düğmesi
                ],
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

        ClassicEditor
            .create(document.querySelector('#editor-2'), {
                // Editör ayarları
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
                    'insertTable'  // Tablo oluşturma düğmesi
                ],
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

        ClassicEditor
            .create(document.querySelector('#editor-3'), {
                // Editör ayarları
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
                    'insertTable'  // Tablo oluşturma düğmesi
                ],
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
