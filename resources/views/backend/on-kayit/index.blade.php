@extends('backend.components.master')
@section('title')
    Ön Kayıt Listesi
@endsection
@section('css')
    <link href="{{asset('backend/assets/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">

@endsection
@section('content')
    @component('backend.components.breadcrumb')
        @slot('li_1')
            Ön Kayıt
        @endslot
        @slot('title')
            Ön Kayıt Listesi
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
                            <h5 class="card-title mb-0">Ön Kayıt Olanların Listesi</h5>
                            <div>
                                <select class="form-select me-2" id="egitimSec" aria-label="Eğitim Seç">
                                    <option selected="" disabled="">Eğitim Seç</option>
                                    @foreach($courses as $course)
                                        <option value="{{ $course->id }}">{{ $course->egitim_adi }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="buttons d-flex align-items-center">
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
                                   <!-- <th>Durum</th> -->
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $datas)
                                    <tr>
                                        <td>{{ $datas->name }}</td>
                                        <td>{{ $datas->kurs_adi }}</td>
                                        <td>{{ $datas->email }}</td>
                                        <td>{{ $datas->phone }}</td>
                                        <td>{{ \Carbon\Carbon::parse($datas->created_at)->format('d-m-Y') }}</td>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div><!--end row-->
        </div>
    </div>

@endsection

@section('addjs')

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
            var url = "{{ route('on-kayit-basvurulari.index') }}";

            fetch(url + '?course_id=' + courseId)
                .then(response => response.text())
                .then(html => {
                    document.querySelector('tbody').innerHTML = new DOMParser()
                        .parseFromString(html, 'text/html')
                        .querySelector('tbody').innerHTML;
                })
                .catch(error => console.error('Error:', error));
        });
    </script>
    <script>
        $(document).ready(function () {
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
        $('#excelBtn').on('click', function () {
            $('#alternative-pagination').DataTable().button('.buttons-excel').trigger();
        });


    </script>

    <script>
        $(document).on('click', '#delete_on_basvuru', function () {
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

