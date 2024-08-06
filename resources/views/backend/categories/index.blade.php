@extends('backend.components.master')
@section('title')
    Kategoriler
@endsection

@section('css')
    <link href="{{asset('backend/assets/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('backend/assets/libs/bootstrap-toogle/bootstrap-toggle.min.css')}}" rel="stylesheet" type="text/css" />



@endsection


@section('content')
    @component('backend.components.breadcrumb')
        @slot('li_1')
            Kategori
        @endslot
        @slot('title')
            Kategori Listesi
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-4">
            <div class="card ">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Kategori Ekle</h4>
                </div><!-- end card header -->
                <form action="{{route('categories.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                <div class="card-body">
                    <div class="live-preview">
                        <div class="row gy-3">

                            <div class="col-md-12">
                                <div>
                                    <label class="form-label">Kategori Adı</label>
                                    <input type="text" name="name" placeholder="Kategori Adı" class="form-control" value="{{ old('name') }}">
                                    <span class="text-danger">
                                    @error('name')
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
                    <h4 class="card-title mb-0 flex-grow-1">Kategori Listesi</h4>

                </div><!-- end card header -->
                <div class="card-body">
                    <table id="alternative-pagination" class="table nowrap dt-responsive align-middle table-hover table-bordered" style="width:100%">
                        <thead>
                        <tr>
                            <th>Kategori Adı </th>
                            <th>Bağlı Eğitim Sayısı </th>
                            <th>Kategori Durumu</th>
                            <th>Düzenle</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($data as $datas)

                            <tr>
                                <td>{{ $datas->name ?? 'Değer girişmemiş' }}</td>
                                <td>{{ $datas->courseCount() }}</td>
                                <td><input class="switchStatus" data-id={{ $datas->id }} type="checkbox" {{$datas->status == 0 ? '' : 'checked' }} data-toggle="toggle" data-on="Aktif" data-off="Pasif" data-onstyle="success" data-offstyle="danger"></td>

                                <td>
                                    <div class="hstack gap-3 fs-15">
                                        <a data-id="{{ $datas->id }}" class="btn btn-sm btn-success edit-click"><i class="ri-settings-4-line"></i></a>
                                        <a href="javascript:void(0)" data-url={{route('categories.delete', ['id'=>$datas->id]) }} data-id="{{ $datas->id }}" data-count="{{$datas->courseCount()}}" class="btn btn-sm btn-danger" id="delete-click"><i class="ri-delete-bin-2-fill"></i></a>
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
                <form action="{{route('categories.update')}}" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Kategoriyi Düzenle</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                    @csrf
                <div class="modal-body">
                        <div class="card-body">
                            <div class="live-preview">
                                <div class="row gy-3">
                                    <input type="hidden" name="id" id="category_id">
                                    <div class="col-md-12">
                                        <div>
                                            <label class="form-label">Kategori Adı</label>
                                            <input type="text"  id="name" name="name" placeholder="Kategori Adı" class="form-control" value="{{ old('name') }}">
                                            <span class="text-danger">
                                            @error('name')
                                                {{ $message }}
                                                @enderror
                                             </span>
                                        </div>
                                    </div>


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
            $('.edit-click').click(function (){
                var id = $(this).attr('data-id');
                $.ajax({
                    type: 'GET',
                    url: '{{ route('categories.getData') }}',
                    data: { id: id },
                    success: function (data) {
                        $('#editModal').modal('show');
                        $('#name').val(data.name);
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

                $.get("{{route('categories.switch')}}",{id:id,status:status}, function (data,status){

                });
            });

        })

        $(document).on('click', '#delete-click', function () {
            var user_id = $(this).attr('data-id');
            const url = $(this).attr('data-url');
            var data_count = $(this).attr('data-count');

            var text;
            if (data_count > 0) {
                text = 'Bu kategoriye ait ' + data_count + ' eğitim bulunmaktadır!  Silmek istediğinize emin misiniz?';
            } else {
                text = 'Bu kategoriyi silmek istediğinize emin misiniz?';
            }
            Swal.fire({
                title: 'Emin misiniz?',
                text: text,
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
