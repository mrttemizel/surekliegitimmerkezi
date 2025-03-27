@extends('backend.components.master')
@section('title')
    Sınıflara Ait Öğrenciler Listesi
@endsection
@section('css')
    <link href="{{asset('backend/assets/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />

    <!--datatable css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <!--datatable responsive css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">

    <link href="{{asset('backend/assets/libs/bootstrap-toogle/bootstrap-toggle.min.css')}}" rel="stylesheet" type="text/css" />

@endsection
@section('content')
    @component('backend.components.breadcrumb')
        @slot('li_1')
            Sınıflar
        @endslot
        @slot('title')
            Sınıflara Ait Öğrenciler Listesi
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
                            <h5 class="card-title mb-0">Sınıflara Ait Öğrenciler Listesi</h5>
                            <form action="{{ route('class.filter') }}" method="GET" class="d-flex">
                                @csrf
                                <select class="form-select" name="sinif_select" aria-label="Default select example">
                                    <option selected disabled>Sınıf Seçiniz</option>
                                    @foreach($data as $datas)
                                        <option value="{{$datas->id}}">{{$datas->sinif_adi}}</option>
                                    @endforeach
                                </select>
                                <button type="submit" class="btn btn-primary">Getir</button>
                            </form>
                        </div>
                        <div class="card-body d-flex justify-content-center flex-column">
 
                            <table id="alternative-pagination" class="table nowrap dt-responsive align-middle table-hover table-bordered" style="width:100%">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Adı Soyadı</th>
                                    <th>TC</th>
                                    <th>Sınıf</th>
                                    <th>Eğitim</th>
                                    <th>Durumu</th>
                                    <th>Düzenle</th>
                                </tr>
                                </thead>
                                <tbody>@php
                                    //$classLists = collect();
                                    $sinif_id = $classLists->first()->sinif_id ?? null;
                                    $kurs_id = $classLists->first()->kurs_id ?? null;
                                    $isAnyActive = false;
                                @endphp

                                @foreach($classLists as $classList)
                                    @if($classList->status == 1)
                                        @php $isAnyActive = true; @endphp
                                    @endif
                                    <tr>
                                        <td>{{$classList->id}}</td>
                                        <td>{{$classList->name. ' '. $classList->surname}}</td>
                                        <td>{{$classList->tc}}</td>
                                        <td>{{$classList->getSinif->sinif_adi ?? 'Değer girişmemiş' }}</td>
                                        <td>{{$classList->kurs_adi}}</td>
                                        <td><input onchange="window.location.reload();" class="switchStatus" data-id={{ $classList->id }} type="checkbox" {{$classList->status == 0 ? '' : 'checked' }} data-toggle="toggle" data-on="Başarılı" data-off="Başarısız" data-onstyle="success" data-offstyle="danger"></td>
                                        <td>
                                            <div class="hstack gap-3 fs-15">
                                                <a href="{{ route('class.down', ['id' => $classList->id]) }}" class="btn btn-sm btn-info class-down" data-id="{{ $classList->id }}">
                                                    <i class="ri-arrow-down-circle-line"></i>
                                                </a>
                                                <a data-id="{{ $classList->id }}" class="btn btn-sm btn-success edit-click"><i class="ri-eye-2-line"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <button id="generate-certificates-btn" class="btn-info btn mt-2"
                                {{ $isAnyActive ? '' : 'disabled' }}>
                                Kursu Bitir - Sertifikaları Gönder
                            </button>
                        </div>
                    </div>
                </div><!--end col-->
            </div><!--end row-->
        </div>
    </div>

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

@endsection

@section('addjs')
    <!-- Mevcut JS'ler -->
    <script src="{{ asset('backend/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/pages/sweetalerts.init.js') }}"></script>

    <!--datatable js-->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

    <!-- DataTables başlatma dosyasını kaldıralım ve burada yapılandıralım -->
    <!-- <script src="{{asset('backend/assets/js/pages/datatables.init.js')}}"></script> -->

    <script src="{{ asset('backend/assets/libs/bootstrap-toogle/bootstrap-toggle.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        $(document).ready(function() {
            // DataTable'ı bir kez başlat
            var table = $('#alternative-pagination').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'excelHtml5',
                        text: 'Excel İndir',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5], // Düzenle sütunu hariç
                            modifier: {
                                page: 'all'
                            }
                        },
                        className: 'hidden-button'
                    }
                ],
                responsive: true,
                lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "Tümü"]],
                paging: true
            });

            // Excel butonunu manuel tetikle
            $('#excelBtn').on('click', function() {
                table.button('.buttons-excel').trigger();
            });
            
            // Diğer click handler'ları
            $('.edit-click').click(function() {
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
            
            // Class-down olayı için handler
            $('.class-down').on('click', function(e) {
                e.preventDefault(); // Sayfa yenilenmesini engelle
                var classId = $(this).data('id'); // İlgili class ID'yi al
                var url = $(this).attr('href'); // class.down rotasını al

                // SweetAlert ile onay penceresi
                Swal.fire({
                    title: 'Emin misiniz?',
                    text: "Bu Kişiyi Sınıftan Çıkarmak İstediğinize Emin misiniz?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Evet, Çıkar!',
                    cancelButtonText: 'Hayır, iptal et'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Eğer onaylandıysa AJAX isteğini gönder
                        $.ajax({
                            url: url,
                            type: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}', // CSRF token'ı ekleyin
                                id: classId,
                            },
                            success: function(response) {
                                if (response.success) {
                                    Swal.fire(
                                        'Başarılı!',
                                        'Sınıftan Başarılı Bir Şekilde Çıkarıldı.',
                                        'success'
                                    ).then(() => {
                                        location.reload(); // Sayfayı yenile
                                    });
                                } else {
                                    Swal.fire(
                                        'Hata!',
                                        'Bir hata oluştu.',
                                        'error'
                                    );
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error(xhr.responseText);
                                Swal.fire(
                                    'Hata!',
                                    'Bir hata oluştu.',
                                    'error'
                                );
                            }
                        });
                    }
                });
            });
            
            // SwitchStatus değişikliği için handler
            $('.switchStatus').change(function() {
                var status = $(this).prop('checked');
                var id=$(this).attr('data-id');

                $.get("{{route('class.switch')}}",{id:id,status:status}, function (data,status){

                });
            });
        });

        // Document ready dışında kalan event handler'lar
        $(document).on('click', '#delete_class', function() {
            var user_id = $(this).attr('data-id');
            const url = $(this).attr('data-url');
            Swal.fire({
                title: 'Emin misiniz?',
                text: "Bu sınıfı silmek istediğinize emin misiniz?",
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

        document.addEventListener('DOMContentLoaded', function() {
            const button = document.getElementById('generate-certificates-btn');
            if (button) {
                button.addEventListener('click', function() {
                    const sinifId = @json($sinif_id);
                    const kursId = @json($kurs_id);

                    axios.post('{{ route('certificates.generate') }}', {
                        sinif_id: sinifId,
                        kurs_id: kursId
                    })
                        .then(response => {
                            alert('Sertifikalar başarıyla oluşturuldu!');
                        })
                        .catch(error => {
                            console.error('Sertifikalar oluşturulurken bir hata oluştu:', error);
                        });
                });
            } else {
                console.error('Button not found.');
            }
        });
    </script>
@endsection

