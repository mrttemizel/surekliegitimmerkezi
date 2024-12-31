@extends('backend.components.master')
@section('title')
    Eğitmenlerimiz
@endsection

@section('css')
    <link href="{{asset('backend/assets/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('backend/assets/libs/bootstrap-toogle/bootstrap-toggle.min.css')}}" rel="stylesheet" type="text/css" />



@endsection


@section('content')
    @component('backend.components.breadcrumb')
        @slot('li_1')
            Eğitmenlerimiz
        @endslot
        @slot('title')
            Eğitmenlerimizi Listesi
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-3">
            <div class="card ">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Eğitmen Ekle</h4>
                </div><!-- end card header -->
                <form action="{{route('egitmenler.store')}}" method="POST" enctype="multipart/form-data">
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
                                        <label class="form-label">E-Posta <span class="text-danger">*</span></label>
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
                    <h4 class="card-title mb-0 flex-grow-1">Eğitmen Listesi</h4>

                </div><!-- end card header -->
                <div class="card-body">
                    <table id="alternative-pagination" class="table nowrap dt-responsive align-middle table-hover table-bordered" style="width:100%">
                        <thead>
                        <tr>
                            <th>Sıralama </th>
                            <th>Resim </th>
                            <th>Ad Soyad </th>
                            <th>Unvan </th>
                            <th>Gösterim</th>
                            <th>Düzenle</th>
                        </tr>
                        </thead>
                        <tbody id="orders">

                        @foreach($data as $datas)

                            <tr id="egitmen_{{$datas->id}}">
                                <td style="width: 3%!important;"><i class="ri-drag-move-fill ri-2x handle" style="cursor: move"></i></td>

                                <td style="width: 10%"><img src="{{ asset('egitmenlerimiz/'.$datas->image)}}" alt="" class="rounded-circle avatar-sm"></td>
                                <td>{{ $datas->name ?? 'Değer girişmemiş' }}</td>
                                <td>{{$datas->title}}</td>
                                <td style="width: 5%!important;"><input class="switchStatus" data-id={{ $datas->id }} type="checkbox" {{$datas->status == 0 ? '' : 'checked' }} data-toggle="toggle" data-on="Aktif" data-off="Pasif" data-onstyle="success" data-offstyle="danger"></td>

                                <td style="width: 3%!important;">
                                    <div class="hstack gap-3 fs-15">
                                        <a data-id="{{ $datas->id }}" class="btn btn-sm btn-success edit-click"><i class="ri-settings-4-line"></i></a>
                                        <a href="javascript:void(0)" data-url={{route('egitmenler.delete', ['id'=>$datas->id]) }} data-id="{{ $datas->id }}"  class="btn btn-sm btn-danger" id="delete-egitmenler"><i class="ri-delete-bin-2-fill"></i></a>
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
                <form action="{{ route('egitmenler.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel">Kişi Düzenle</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                    </div>

                    <div class="modal-body">
                        <div class="card-body">
                            <div class="live-preview">
                                <div class="row gy-3">
                                    <!-- Güncellenecek kaydın ID'sini gizli olarak taşıyoruz -->
                                    <input type="hidden" name="id" id="edit_id">

                                    <!-- Ad Soyad -->
                                    <div class="col-md-12">
                                        <div>
                                            <label class="form-label">Ad Soyad</label>
                                            <input type="text" id="edit_name" name="name" placeholder="Ad Soyad" class="form-control" value="{{ old('name') }}">
                                            <span class="text-danger">
                                            @error('name') {{ $message }} @enderror
                                        </span>
                                        </div>
                                    </div>

                                    <!-- Unvan -->
                                    <div class="col-md-12">
                                        <div>
                                            <label class="form-label">Unvan <span class="text-danger">*</span></label>
                                            <input type="text" id="edit_title" name="title" placeholder="Unvan" class="form-control" value="{{ old('title') }}">
                                            <span class="text-danger">
                                            @error('title') {{ $message }} @enderror
                                        </span>
                                        </div>
                                    </div>

                                    <!-- E-Posta -->
                                    <div class="col-md-12">
                                        <div>
                                            <label class="form-label">E-Posta <span class="text-danger">*</span></label>
                                            <input type="text" id="edit_email" name="email" placeholder="E-Posta" class="form-control" value="{{ old('email') }}">
                                            <span class="text-danger">
                                            @error('email') {{ $message }} @enderror
                                        </span>
                                        </div>
                                    </div>

                                    <!-- Mevcut Görsel Önizlemesi (JS ile src ayarlanacak) -->
                                    <div class="col-md-12">
                                        <img src="" id="edit_image_preview" alt="" class="img-thumbnail avatar-xl d-none">
                                    </div>

                                    <!-- Yeni Görsel Seç -->
                                    <div class="col-md-12">
                                        <div>
                                            <label class="form-label">
                                                Resim
                                                <span class="text-danger">270 x 400 px</span>
                                            </label>
                                            <input type="file" name="image" class="form-control">
                                            <span class="text-danger">
                                            @error('image') {{ $message }} @enderror
                                        </span>
                                        </div>
                                    </div>

                                    <!-- Mevcut Görseli Silme Checkbox -->
                                    <div class="col-md-12">
                                        <div class="form-check d-none" id="deleteImageWrapper">
                                            <input class="form-check-input" type="checkbox" id="edit_delete_image" name="delete_image" value="1">
                                            <label class="form-check-label" for="edit_delete_image">
                                                Mevcut görseli sil
                                            </label>
                                        </div>
                                    </div>

                                </div> <!-- row -->
                            </div> <!-- live-preview -->
                        </div> <!-- card-body -->
                    </div> <!-- modal-body -->

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Kapat</button>
                        <button type="submit" class="btn btn-success">Kaydet</button>
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
        $(function () {
            $('.edit-click').click(function () {
                var id = $(this).attr('data-id');
                $.ajax({
                    type: 'GET',
                    url: '{{ route('egitmenler.getData') }}',
                    data: { id: id },
                    success: function (data) {
                        // Modal aç
                        $('#editModal').modal('show');

                        // Gözden geçirelim: data.name, data.title, data.email, data.image, data.id geliyor mu?
                        console.log(data);

                        // Artık yeni ID'lere atama yapıyoruz:
                        $('#edit_id').val(data.id);
                        $('#edit_name').val(data.name);
                        $('#edit_title').val(data.title);
                        $('#edit_email').val(data.email);

                        // Resim için:
                        if (data.image) {
                            // Resmi göster
                            $('#edit_image_preview')
                                .attr('src', '{{ asset("egitmenlerimiz") }}/' + data.image)
                                .removeClass('d-none');

                            // "Mevcut görseli sil" checkbox wrapper'ını da gösterelim
                            $('#deleteImageWrapper').removeClass('d-none');
                        } else {
                            // Görsel yoksa preview'ı sakla
                            $('#edit_image_preview').addClass('d-none');
                            // Mevcut görseli sil checkbox'ını da sakla
                            $('#deleteImageWrapper').addClass('d-none');
                        }

                        // Checkbox'ı default olarak unchecked yapalım
                        $('#edit_delete_image').prop('checked', false);
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
                $.get("{{route('egitmenler.orders')}}?"+siralama,function (data,status){
                    toastr.success('Güncelleme Başarılı');
                });
            }
        });


        $(function (){
            $('.switchStatus').change(function (){
                var status = $(this).prop('checked');
                var id=$(this).attr('data-id');

                $.get("{{route('egitmenler.switch')}}",{id:id,status:status}, function (data,status){

                });
            });

        })

        $(document).on('click', '#delete-egitmenler', function () {
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
