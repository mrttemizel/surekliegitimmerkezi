@extends('backend.components.master')
@section('title')
    Yönetim Kurulu
@endsection

@section('css')
    <link href="{{asset('backend/assets/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('backend/assets/libs/bootstrap-toogle/bootstrap-toggle.min.css')}}" rel="stylesheet" type="text/css" />



@endsection


@section('content')
    @component('backend.components.breadcrumb')
        @slot('li_1')
            Yönetim Kurulu
        @endslot
        @slot('title')
            Yönetim Kurulu Listesi
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-3">
            <div class="card ">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Yönetim Kurulu Ekle</h4>
                </div><!-- end card header -->
                <form action="{{route('yonetimkurulu.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="live-preview">
                            <div class="row gy-3">

                                <div class="col-md-12">
                                    <div>
                                        <label class="form-label">Ad Soyad <span class="text-danger">*</span></label>
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
                                        <label class="form-label">Unvan <span class="text-danger">*</span></label>
                                        <input type="text" name="title" placeholder="Unvan" class="form-control" value="{{ old('title') }}">
                                        <span class="text-danger">
                                    @error('title')
                                            {{ $message }}
                                            @enderror
                            </span>
                                    </div>
                                </div>
                                <!--end col-->

                                <div class="col-md-12">
                                    <div>
                                        <label class="form-label">Pozisyon <span class="text-danger">*</span></label>
                                        <input type="text" name="pozisyon" placeholder="Unvan" class="form-control" value="{{ old('pozisyon') }}">
                                        <span class="text-danger">
                                    @error('pozisyon')
                                            {{ $message }}
                                            @enderror
                            </span>
                                    </div>
                                </div>
                                <!--end col-->


                                <div class="col-md-12">
                                    <div>
                                        <label class="form-label">E-Posta</label>
                                        <input type="text" name="email" placeholder="E-Posta" class="form-control" value="{{ old('email') }}">
                                        <span class="text-danger">
                                    @error('email')
                                            {{ $message }}
                                            @enderror
                            </span>
                                    </div>
                                </div>
                                <!--end col-->

                                <div class="col-md-12">
                                    <div>
                                        <label class="form-label">Resim<span class="text-danger"> 270 x 400 px</span></label>
                                        <input type="file" name="image"  class="form-control">
                                        <span class="text-danger">
                                    @error('image')
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
        <div class="col-lg-9">
            <div class="card ">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Yönetim Kurulu Listesi</h4>

                </div><!-- end card header -->
                <div class="card-body">
                    <table id="alternative-pagination" class="table nowrap dt-responsive align-middle table-hover table-bordered" style="width:100%">
                        <thead>
                        <tr>
                            <th>Sıralama </th>
                            <th>Resim </th>
                            <th>Ad Soyad </th>
                            <th>Unvan </th>
                            <th>Pozisyon </th>
                            <th>Gösterim</th>
                            <th>Düzenle</th>
                        </tr>
                        </thead>
                        <tbody id="orders">

                        @foreach($data as $datas)

                            <tr id="yonetimkurulu_{{$datas->id}}">
                                <td style="width: 3%!important;"><i class="ri-drag-move-fill ri-2x handle" style="cursor: move"></i></td>

                                <td style="width: 10%"><img src="{{ asset('yonetimkurulu/'.$datas->image)}}" alt="" class="rounded-circle avatar-sm"></td>
                                <td>{{ $datas->name ?? 'Değer girişmemiş' }}</td>
                                <td>{{$datas->title}}</td>
                                <td>{{$datas->pozisyon}}</td>
                                <td style="width: 5%!important;"><input class="switchStatus" data-id={{ $datas->id }} type="checkbox" {{$datas->status == 0 ? '' : 'checked' }} data-toggle="toggle" data-on="Aktif" data-off="Pasif" data-onstyle="success" data-offstyle="danger"></td>

                                <td style="width: 3%!important;">
                                    <div class="hstack gap-3 fs-15">
                                        <a data-id="{{ $datas->id }}" class="btn btn-sm btn-success edit-click"><i class="ri-settings-4-line"></i></a>
                                        <a href="javascript:void(0)" data-url={{route('yonetimkurulu.delete', ['id'=>$datas->id]) }} data-id="{{ $datas->id }}"  class="btn btn-sm btn-danger" id="delete-yonetimkurulu"><i class="ri-delete-bin-2-fill"></i></a>
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

    <div id="editModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('yonetimkurulu.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel">Kişi Düzenle</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                    </div>
                    <div class="modal-body">
                        <div class="card-body">
                            <div class="live-preview">
                                <div class="row gy-3">

                                    <!-- Kayıt ID'si -->
                                    <input type="hidden" name="id" id="category_id">

                                    <!-- Ad Soyad -->
                                    <div class="col-md-12">
                                        <label class="form-label">Ad Soyad</label>
                                        <input type="text" id="name" name="name" placeholder="Kategori Adı"
                                               class="form-control" value="{{ old('name') }}">
                                        <span class="text-danger">
                                        @error('name') {{ $message }} @enderror
                                    </span>
                                    </div>

                                    <!-- Unvan -->
                                    <div class="col-md-12">
                                        <label class="form-label">Unvan <span class="text-danger">*</span></label>
                                        <input type="text" id="title" name="title" placeholder="Unvan"
                                               class="form-control" value="{{ old('title') }}">
                                        <span class="text-danger">
                                        @error('title') {{ $message }} @enderror
                                    </span>
                                    </div>

                                    <!-- Pozisyon -->
                                    <div class="col-md-12">
                                        <label class="form-label">Pozisyon <span class="text-danger">*</span></label>
                                        <input type="text" id="pozisyon" name="pozisyon" placeholder="Pozisyon"
                                               class="form-control" value="{{ old('pozisyon') }}">
                                        <span class="text-danger">
                                        @error('pozisyon') {{ $message }} @enderror
                                    </span>
                                    </div>

                                    <!-- E-posta -->
                                    <div class="col-md-12">
                                        <label class="form-label">E-Posta</label>
                                        <input type="text" id="email" name="email" placeholder="E-Posta"
                                               class="form-control" value="{{ old('email') }}">
                                        <span class="text-danger">
                                        @error('email') {{ $message }} @enderror
                                    </span>
                                    </div>

                                    <!-- Mevcut görsel önizlemesi -->
                                    <div class="col-md-12">
                                        <img src="" id="image" alt="" class="img-thumbnail avatar-xl d-none">
                                    </div>

                                    <!-- Mevcut Görseli Sil (Checkbox) -->
                                    <!-- Bu alanı ekledik: -->
                                    <div class="col-md-12 d-none" id="deleteImageWrapper">
                                        <div class="form-check my-2">
                                            <input class="form-check-input" type="checkbox"
                                                   id="delete_image" name="delete_image" value="1">
                                            <label class="form-check-label" for="delete_image">
                                                Mevcut görseli sil
                                            </label>
                                        </div>
                                    </div>

                                    <!-- Yeni Resim -->
                                    <div class="col-md-12">
                                        <label class="form-label">Resim
                                            <span class="text-danger">270 x 400 px</span>
                                        </label>
                                        <input type="file" name="image" class="form-control">
                                        <span class="text-danger">
                                        @error('image') {{ $message }} @enderror
                                    </span>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Kapat</button>
                        <button type="submit" class="btn btn-success">Kaydet</button>
                    </div>
                </form>
            </div><!-- modal-content -->
        </div><!-- modal-dialog -->
    </div><!-- modal -->
@endsection

@section('addjs')
    <!--datatable js-->

    <script src="{{ asset('backend/assets/libs/bootstrap-toogle/bootstrap-toggle.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/pages/sweetalerts.init.js') }}"></script>
    <script>
        $(function () {
            $('.edit-click').click(function () {
                var id = $(this).attr('data-id');
                $.ajax({
                    type: 'GET',
                    url: '{{ route('yonetimkurulu.getData') }}',
                    data: { id: id },
                    success: function (data) {
                        // Modal'ı aç
                        $('#editModal').modal('show');

                        // Inputları doldur
                        $('#name').val(data.name);
                        $('#title').val(data.title);
                        $('#pozisyon').val(data.pozisyon);
                        $('#email').val(data.email);
                        $('#category_id').val(data.id);

                        // Resim kontrolü
                        if (data.image) {
                            // Resim varsa, önizleme göster
                            $('#image')
                                .removeClass('d-none')
                                .attr('src', '{{ asset("yonetimkurulu") }}/' + data.image);

                            // "Mevcut görseli sil" checkbox alanını göster, checkbox'ı unchecked yap
                            $('#deleteImageWrapper').removeClass('d-none');
                            $('#delete_image').prop('checked', false);
                        } else {
                            // Resim yoksa önizleme sakla, sil checkbox'ını sakla
                            $('#image')
                                .addClass('d-none')
                                .attr('src', '');
                            $('#deleteImageWrapper').addClass('d-none');
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error('AJAX Error: ', status, error);
                    }
                });
            });
        });

        $('#orders').sortable({
            handle:'.handle',
            update:function (){
                var siralama = $('#orders').sortable('serialize');
                $.get("{{route('yonetimkurulu.orders')}}?"+siralama,function (data,status){
                    toastr.success('Güncelleme Başarılı');
                });
            }
        });


        $(function (){
            $('.switchStatus').change(function (){
                var status = $(this).prop('checked');
                var id=$(this).attr('data-id');

                $.get("{{route('yonetimkurulu.switch')}}",{id:id,status:status}, function (data,status){

                });
            });

        })

        $(document).on('click', '#delete-yonetimkurulu', function () {
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
