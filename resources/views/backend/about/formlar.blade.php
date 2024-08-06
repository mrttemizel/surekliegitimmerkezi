@extends('backend.components.master')
@section('title')
    Formlar
@endsection

@section('css')
    <link href="{{asset('backend/assets/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('backend/assets/libs/bootstrap-toogle/bootstrap-toggle.min.css')}}" rel="stylesheet" type="text/css" />



@endsection


@section('content')
    @component('backend.components.breadcrumb')
        @slot('li_1')
            Formlar
        @endslot
        @slot('title')
            Formlar Listesi
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-4">
            <div class="card ">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Form Ekle</h4>
                </div><!-- end card header -->
                <form action="{{route('formlar.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="live-preview">
                            <div class="row gy-3">

                                <div class="col-md-12">
                                    <div>
                                        <label class="form-label">Form Adı <span class="text-danger">*</span></label>
                                        <input type="text" name="name" placeholder="Ad Soyad" class="form-control" value="{{ old('name') }}">
                                        <span class="text-danger">
                                    @error('name')
                                            {{ $message }}
                                            @enderror
                            </span>
                                    </div>
                                </div>
                                <!--end col-->

                                <div class="col-md-12">
                                    <div>
                                        <label class="form-label">Dosya</label>
                                        <input type="file" name="file"  class="form-control">
                                        <span class="text-danger">
                                    @error('file')
                                            {{ $message }}
                                            @enderror
                            </span>
                                    </div>
                                </div>
                                <!--end col-->


                                <div class="col-lg-12">
                                    <div class="hstack gap-2  d-grid">
                                        <button type="submit" class="btn btn-primary">Ekle</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- end card body -->
                </form>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card ">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Formlar Listesi</h4>

                </div><!-- end card header -->
                <div class="card-body">
                    <table id="alternative-pagination" class="table nowrap dt-responsive align-middle table-hover table-bordered" style="width:100%">
                        <thead>
                        <tr>
                            <th>Dosya </th>
                            <th>Form Adı </th>
                            <th>Gösterim</th>
                            <th>Düzenle</th>
                        </tr>
                        </thead>
                        <tbody id="orders">

                        @foreach($data as $datas)

                            <tr>

                                <td style="width: 10%"><a href="{{ asset('formlar/'.$datas->file)}}" target="_blank" class="btn btn-sm btn-secondary"><i class="ri-download-2-fill"></i> İndir</a></td>
                                <td>{{ $datas->name }}</td>
                                <td style="width: 5%!important;"><input class="switchStatus" data-id={{ $datas->id }} type="checkbox" {{$datas->status == 0 ? '' : 'checked' }} data-toggle="toggle" data-on="Aktif" data-off="Pasif" data-onstyle="success" data-offstyle="danger"></td>

                                <td style="width: 3%!important;">
                                    <div class="hstack gap-3 fs-15">
                                        <a data-id="{{ $datas->id }}" class="btn btn-sm btn-success edit-form"><i class="ri-settings-4-line"></i></a>
                                        <a href="javascript:void(0)" data-url={{route('formlar.delete', ['id'=>$datas->id]) }} data-id="{{ $datas->id }}"  class="btn btn-sm btn-danger" id="delete-form"><i class="ri-delete-bin-2-fill"></i></a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>

                </div>

            </div>
        </div>
    </div>



    <!-- Default Modals -->

    <div id="editModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{route('formlar.update')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel">Formu Düzenle</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                    </div>

                    <div class="modal-body">
                        <div class="card-body">
                            <div class="live-preview">
                                <div class="row gy-3">
                                    <input type="hidden" name="id" id="category_id">
                                    <div class="col-md-12">
                                        <div>
                                            <label class="form-label">Form Adı <span class="text-danger">*</span></label>
                                            <input type="text" name="name" id="name" placeholder="Ad Soyad" class="form-control" value="{{ old('name') }}">
                                            <span class="text-danger">
                                    @error('name')
                                                {{ $message }}
                                                @enderror
                            </span>
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-md-12">
                                        <a id="file" href="#" class="btn-danger btn btn-sm"><i class="ri-download-2-fill"></i> Dosyayı İndir</a>
                                        <div class="mt-2">
                                            <label class="form-label">Dosya</label>
                                            <input type="file" name="file"  class="form-control">
                                            <span class="text-danger">
                                    @error('file')
                                                {{ $message }}
                                                @enderror
                            </span>
                                        </div>
                                    </div>
                                    <!--end col-->

                                    <!--end col-->


                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Kapat</button>
                        <button type="submit" class="btn btn-success ">Kaydet</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->



@endsection

@section('addjs')
    <!--datatable js-->

    <script src="{{ asset('backend/assets/libs/bootstrap-toogle/bootstrap-toggle.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/pages/sweetalerts.init.js') }}"></script>
    <script>
        $(function (){
            $('.edit-form').click(function (){
                var id = $(this).attr('data-id');
                $.ajax({
                    type: 'GET',
                    url: '{{ route('formlar.getData') }}',
                    data: { id: id },
                    success: function (data) {
                        $('#editModal').modal('show');
                        $('#name').val(data.name);
                        $('#file').attr('href', '{{ asset("formlar") }}/' + data.file);
                        $('#category_id').val(data.id);
                    },
                    error: function (xhr, status, error) {
                        console.error('AJAX Error: ', status, error);
                    }
                });
            });
        });



        $(function (){
            $('.switchStatus').change(function (){
                var status = $(this).prop('checked');
                var id=$(this).attr('data-id');

                $.get("{{route('formlar.switch')}}",{id:id,status:status}, function (data,status){

                });
            });

        })

        $(document).on('click', '#delete-form', function () {
            var user_id = $(this).attr('data-id');
            const url = $(this).attr('data-url');
            Swal.fire({
                title: 'Emin misiniz?',
                text: "Bu kişiyi silmek istediğinize emin misiniz?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Evet, sil!',
                cancelButtonText: 'Vazgeç'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = url;
                }
            });
        });
    </script>

@endsection
