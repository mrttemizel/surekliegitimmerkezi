@php
    use Carbon\Carbon;
@endphp
@extends('backend.components.master')
@section('title')
    Eğitimler
@endsection
@section('css')
    <link href="{{asset('backend/assets/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css"/>


    <!--datatable css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css"/>
    <!--datatable responsive css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css"/>

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">

    <link href="{{asset('backend/assets/libs/bootstrap-toogle/bootstrap-toggle.min.css')}}" rel="stylesheet"
          type="text/css"/>

@endsection
@section('content')
    @component('backend.components.breadcrumb')
        @slot('li_1')
            Eğitimler
        @endslot
        @slot('title')
            Eğitimler Listesi
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">Eğitimler Listesi</h5>
                            <a href="{{ route('courses.create') }}"
                               class="btn btn-primary waves-effect waves-light d-flex justify-content-between"><i
                                    class="ri-add-box-line"></i> &nbsp; Yeni Eğitim Ekle</a>
                        </div>
                        <div class="card-body">
                            <table id="alternative-pagination"
                                   class="table nowrap dt-responsive align-middle table-hover table-bordered"
                                   style="width:100%">
                                <thead>
                                <tr>

                                    <th>Adı</th>
                                    <th>Kategorisi</th>
                                    <th>Düzenle</th>
                                    <th>Durumu</th>
                                    <th>Sıra</th>
                                    <th>Resmi</th>
                                    <th>Ö. Yükle</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $datas)
                                    <tr>

                                        <td style="width: 4%;font-size: x-small">{{ $datas->egitim_adi ?? 'Değer girişmemiş' }}</td>
                                        <td style="width: 4%;font-size: x-small">{{ $datas->getCategory->name ?? 'Değer girişmemiş' }}</td>
                                        <td  style="width: 1%">
                                            <div class="hstack gap-3 fs-15">
                                                <a href="{{route('courses.edit', ['id' => $datas->id])}}"
                                                   class="btn btn-sm btn-success"><i class="ri-settings-4-line"></i></a>
                                                <a href="javascript:void(0)"
                                                   data-url={{route('courses.delete', ['id'=>$datas->id]) }} data-id={{ $datas->id }} class="btn
                                                   btn-sm btn-danger" id="delete_course"><i
                                                    class="ri-delete-bin-2-fill"></i></a>
                                            </div>
                                        </td>
                                        <td style="width: 1%">
                                            <button class="btn btn-sm toggle-status {{ $datas->status == 1 ? 'btn-success' : 'btn-danger' }}"
                                                    data-id="{{ $datas->id }}">
                                                {{ $datas->status == 1 ? 'Aktif' : 'Pasif' }}
                                            </button>
                                        </td>
                                        <td  style="width: 1%">{{ $datas->order ?? 'Değer girişmemiş' }}</td>
                                        <td style="width: 2%"><img
                                                src="{{ $datas->image ? asset('courses/'.$datas->image) : asset('courses/no_name.jpg') }}"
                                                alt="" class="rounded-circle avatar-xs"></td>
                                        <td  style="width: 1%">
                                            @if($datas->status == 1)
                                                <a href="javascript:void(0)" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#uploadExcelModal" data-id="{{ $datas->id }}">Sınıf Seç & Excel Yükle</a>
                                            @endif
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

@endsection
<!-- Modal for Class Selection and Excel Upload -->
<div class="modal fade" id="uploadExcelModal" tabindex="-1" aria-labelledby="uploadExcelLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('courses.uploadExcel') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadExcelLabel">Sınıf Seç & Excel Yükle</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Hidden Course ID Field -->
                    <input type="hidden" name="course_id" id="course_id" class="form-control">

                    <!-- Class Selection -->
                    <div class="mb-3">
                        <label for="class" class="form-label">Sınıf Seç</label>
                        <select name="class_id" id="class" class="form-select" required>
                            @foreach($classes as $class)
                                    <option value="{{ $class->id }}">{{ $class->sinif_adi }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Excel File Upload -->
                    <div class="mb-3">
                        <label for="excel_file" class="form-label">Excel Yükle</label>
                        <input type="file" name="excel_file" id="excel_file" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Yükle</button>
                </div>
            </form>
        </div>
    </div>
</div>
@section('addjs')

    <script src="{{ asset('backend/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/pages/sweetalerts.init.js') }}"></script>

    <!--datatable js-->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>


    <script src="{{asset('backend/assets/js/pages/datatables.init.js')}}"></script>

    <script src="{{ asset('backend/assets/libs/bootstrap-toogle/bootstrap-toggle.min.js') }}"></script>

    <script>
        $(function () {
            $(document).on('click', '.toggle-status', function () {
                var button = $(this);
                var id = button.data('id');
                var currentStatus = button.hasClass('btn-success') ? 1 : 0;
                var newStatus = currentStatus === 1 ? 0 : 1;

                $.get("{{ route('courses.switch') }}", { id: id, status: newStatus }, function (data) {
                    if (data.success) {
                        if (newStatus === 1) {
                            button.removeClass('btn-danger').addClass('btn-success').text('Aktif');
                        } else {
                            button.removeClass('btn-success').addClass('btn-danger').text('Pasif');
                        }
                        alert(data.message);
                        window.location.reload();
                    } else {
                        alert(data.message);
                        window.location.reload();
                    }
                });
            });
        });

        $('#uploadExcelModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var courseId = button.data('id');

            var modal = $(this);
            modal.find('#course_id').val(courseId);

            $.ajax({
                url: "{{ route('courses.getClasses') }}",
                type: 'GET',
                data: { course_id: courseId },
                success: function (response) {
                    var classSelect = modal.find('#class');
                    classSelect.empty();

                    $.each(response.classes, function (key, value) {
                        classSelect.append('<option value="' + value.id + '">' + value.sinif_adi + '</option>');
                    });
                }
            });
        });

        $(document).on('click', '#delete_course', function () {
            var user_id = $(this).attr('data-id');
            const url = $(this).attr('data-url');
            Swal.fire({
                title: 'Emin misiniz?',
                text: "Bu dersi silmek istediğinize emin misiniz?",
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

