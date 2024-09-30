@extends('backend.components.master')
@section('title')
    Kesin Kayıt Listesi
@endsection
@section('css')
    <link href="{{asset('backend/assets/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
    <link href="{{asset('backend/assets/libs/bootstrap-toogle/bootstrap-toggle.min.css')}}" rel="stylesheet" type="text/css" />

@endsection
@section('content')
    @component('backend.components.breadcrumb')
        @slot('li_1')
            Kesin Kayıt
        @endslot
        @slot('title')
            Kesin Kayıt Listesi
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
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">Kesin Kayıt Olanların Listesi</h5><div class="buttons">
                                <div>
                                    <select class="form-select me-2" id="egitimSec" aria-label="Eğitim Seç">
                                        <option selected="" disabled="">Eğitim Seç</option>
                                        @foreach($courses as $course)
                                            <option value="{{ $course->id }}">{{ $course->egitim_adi }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <a href="#" class="btn btn-success me-2" id="excelBtn">
                                    <i class="ri-file-excel-2-line me-1"></i> Excel İndir
                                </a>


                            </div>
                        </div>
                        <div class="card-body">
                            <table id="alternative-pagination" class="table nowrap dt-responsive align-middle table-hover table-bordered" style="width:100%">
                                <thead>
                                <tr>

                                    <th>Ad Soyad</th>
                                    <th>Kurs Adı</th>
                                    <th>E-Posta</th>
                                    <th>Telefon</th>
                                    <th>Başvuru Tarihi</th>
                                    <th>Sınıfa Ata</th>
                                    <th>Düzenle</th>
                                </tr>
                                </thead>
                                <tbody

                                @foreach($data as $datas)
                                    <tr>

                                        <td>{{$datas->name}}</td>
                                        <td>{{$datas->kurs_adi}}</td>
                                        <td>{{$datas->email}}</td>
                                        <td>{{$datas->phone}}</td>
                                        <td>{{ \Carbon\Carbon::parse($datas->created_at)->format('d-m-Y') }}</td>
                                        <td style="width: 3%!important;">
                                            <a data-id="{{ $datas->id }}" class="btn btn-sm btn-danger class-click d-flex justify-content-between"><i class="ri-arrow-up-circle-fill"></i> Sınıfa Ata</a>
                                        </td>

                                        <td>
                                            <div class="hstack gap-3 fs-15">
                                                <a data-id="{{ $datas->id }}" class="btn btn-sm btn-success edit-click"><i class="ri-eye-2-line"></i></a>
                                                <a href="{{route('kesin-kayit-basvurulari.edit', ['id' => $datas->id])}}" class="btn btn-sm btn-info"><i class="ri-settings-2-fill"></i></a>
                                                <a href="javascript:void(0)"  class="btn btn-sm btn-danger" data-url={{route('kesin-kayit-basvurulari.delete', ['id'=>$datas->id]) }} data-id={{ $datas->id }} class="link-danger" id="delete_kesin_kayit"><i class="ri-delete-bin-5-line"></i></a>                                                </div>
                                        </td>
                                    </tr>
                                    @endforeach

                                    </tbody>
                            </table>
                        </div>
                    </div>
                </div><!--end col-->
            </div><!--end row-->
        </div>
    </div>


    <!-- Default Modals -->

    <div id="editModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="#" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel">Başvuruyu Gör</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                    </div>

                    <div class="modal-body">
                        <div class="card-body">
                            <div class="live-preview">
                                <div class="row gy-3">
                                    <input type="hidden" name="id" id="category_id">
                                    <div class="col-md-12">
                                        <div>
                                            <label class="form-label">Ad Soyad</label>
                                            <input type="text"  id="name" name="name" disabled  placeholder="Ad Soyad" class="form-control" value="{{ old('name') }}">
                                            <span class="text-danger">
                                            @error('name')
                                                {{ $message }}
                                                @enderror
                                             </span>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div>
                                            <label class="form-label">Kurs Adı</label>
                                            <input type="text"  id="kurs_adi" name="kurs_adi"  disabled placeholder="Kurs Adı" class="form-control" value="{{ old('kurs_adi') }}">
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
                                            <label class="form-label">E-Posta</label>
                                            <input type="text" id="email" name="email" disabled placeholder="E-Posta" class="form-control" value="{{ old('email') }}">
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
                                            <label class="form-label">Telefon</label>
                                            <input type="text" id="phone" name="phone"  disabled placeholder="Telefon" class="form-control" value="{{ old('phone') }}">
                                            <span class="text-danger">
                                    @error('email')
                                                {{ $message }}
                                                @enderror
                            </span>
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <!--end col-->
                                    <div class="col-md-12 d-flex justify-content-evenly">
                                        <div>
                                            <label class="form-label">Diploma</label><br>
                                            <a href="" id="diploma" target="_blank">İndir</a>
                                        </div>
                                        <div>
                                            <label class="form-label">Kimlik</label><br>
                                            <a href="" id="kimlik" target="_blank">İndir</a>
                                        </div>
                                        <div>
                                            <label class="form-label">Kurum Karti</label><br>
                                            <a href="" id="kurumkarti" target="_blank">İndir</a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">


                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Kapat</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div id="classModal" class="modal fade" tabindex="-1" aria-labelledby="classModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Form -->
                <form action="{{ route('kesin-kayit-basvurulari.sinifAta') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="classModalLabel">Başvuruyu Sınıfa Ata</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="card-body">
                            <div class="live-preview">
                                <div class="row gy-3">
                                    <input type="hidden" name="id" id="form_id">
                                    <div class="col-md-12">
                                        <div>
                                            <label class="form-label">Aktarmak İstediğiniz Sınıfı Seçiniz</label>
                                            <select id="sinif_id" class="form-select" name="sinif_id" aria-label="Default select example">
                                                <option selected disabled>Sınıf Seçiniz</option>
                                            </select>
                                            <span class="text-danger">
                                @error('sinif_id')
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
                        <button type="submit" class="btn btn-danger" data-bs-dismiss="modal">Kaydet</button>
                    </div>
                </form>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection

@section('addjs')

    <script src="{{ asset('backend/assets/libs/bootstrap-toogle/bootstrap-toggle.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/pages/sweetalerts.init.js') }}"></script>

    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <!--datatable js-->
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

    <script>
        document.getElementById('egitimSec').addEventListener('change', function () {
            var courseId = this.value;
            var url = "{{ route('kesin-kayit-basvurulari.index') }}";

            fetch(url + '?course_id=' + courseId)
                .then(response => response.text())
                .then(html => {
                    document.querySelector('tbody').innerHTML = new DOMParser()
                        .parseFromString(html, 'text/html')
                        .querySelector('tbody').innerHTML;
                })
                .catch(error => console.error('Error:', error));
        });

        $(function (){
            $('.edit-click').click(function (){
                var id = $(this).attr('data-id');
                $('#category_id').val(id); // Hidden input alanını doldur

                $.ajax({
                    type: 'GET',
                    url: '{{ route('kesin-kayit-basvurulari.getData') }}',
                    data: { id: id },
                    success: function (data) {
                        $('#editModal').modal('show');
                        $('#name').val(data.name);
                        $('#email').val(data.email);
                        $('#kurs_adi').val(data.kurs_adi);
                        $('#phone').val(data.phone);

                        function setLink(elementId, filePath) {
                            if (filePath) {
                                $('#' + elementId).attr('href', '{{ asset("kesin-kayit-evraklari") }}/' + filePath).text('İndir');
                            } else {
                                $('#' + elementId).removeAttr('href').text('Belge yüklenmemiş');
                            }
                        }

                        setLink('diploma', data.diploma);
                        setLink('kimlik', data.kimlik);
                        setLink('kurumkarti', data.kurumkarti);

                    },
                    error: function (xhr, status, error) {
                        console.error('AJAX Error: ', status, error);
                    }
                });
            });
        });

        <!-- AJAX ve Modal Kısmı -->

    $(function() {
            $('.class-click').click(function() {
                var id = $(this).data('id'); // Data-id özelliğini al
                $.ajax({
                    type: 'GET',
                    url: '{{ route('kesin-kayit-basvurulari.getSinif') }}',
                    data: { id: id },
                    success: function(data) {
                        console.log(data);
                        if(data.length > 0) {
                            $('#form_id').val(id);
                            var sinifSelect = $('#sinif_id');
                            sinifSelect.empty(); // Mevcut seçenekleri temizle

                            sinifSelect.append('<option selected disabled>Sınıf Seçiniz</option>');

                            data.forEach(function(item) {
                                sinifSelect.append('<option value="' + item.id + '">' + item.sinif_adi + '</option>');
                            });

                            $('#classModal').modal('show');
                        } else {
                            Swal.fire(
                                'Hata!',
                                'Sınıf Verisi Bulunamadı....',
                                'error'
                            );
                            console.error('Veri bulunamadı');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error: ', status, error);
                    }
                });
            });
        });



    </script>


    <script>
        $(document).ready(function() {
            $('#alternative-pagination').DataTable({


                buttons: [
                    {
                        extend: 'excelHtml5',
                        text: 'Excel İndir',
                        exportOptions: {
                            selected: true,
                            columns: [0, 1, 2, 3, 4] // Sadece belirtilen sütunları dahil et

                        }
                    },


                ],
                responsive: true, // Duyarlılık özelliğini etkinleştir
                lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "Tümü"]], // Gösterilen öğe sayısı seçenekleri
                paging: true // Sayfalama etkin
            });
        });
        // Excel İndir butonunu düzenleme
        $('#excelBtn').on('click', function() {
            $('#alternative-pagination').DataTable().button('.buttons-excel').trigger();
        });
    </script>

    <script>
        $(document).on('click', '#delete_kesin_kayit', function () {
            var user_id = $(this).attr('data-id');
            const url = $(this).attr('data-url');
            Swal.fire({
                title: 'Emin misiniz?',
                text: "Bu başvuruyu silmek istediğinize emin misiniz?",
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

