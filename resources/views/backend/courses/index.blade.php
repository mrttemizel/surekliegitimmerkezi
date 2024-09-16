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
                                    <th>Eğitim Resmi</th>
                                    <th>Eğitim Adı</th>
                                    <th>Eğitim Kategorisi</th>
                                    <th>Eğitim Durumu</th>
                                    <th>Toplu Öğrenci Yükle</th>
                                    <th>Düzenle</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $datas)
                                    <tr>
                                        <td style="width: 10%"><img
                                                src="{{ $datas->image ? asset('courses/'.$datas->image) : asset('courses/no_name.jpg') }}"
                                                alt="" class="rounded-circle avatar-xs"></td>
                                        <td>{{ $datas->egitim_adi ?? 'Değer girişmemiş' }}</td>
                                        <td>{{ $datas->getCategory->name ?? 'Değer girişmemiş' }}</td>
                                        <td><input class="switchStatus" data-id={{ $datas->id }} type="checkbox"
                                                   {{$datas->status == 0 ? '' : 'checked' }} data-toggle="toggle"
                                                   data-on="Aktif" data-off="Pasif" data-onstyle="success"
                                                   data-offstyle="danger"></td>
                                        <td>
                                            @if($datas->status == 1)
                                                <a href="javascript:void(0)" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#uploadExcelModal" data-id="{{ $datas->id }}">Sınıf Seç & Excel Yükle</a>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="hstack gap-3 fs-15">
                                                <a href="{{route('courses.edit', ['id' => $datas->id])}}"
                                                   class="btn btn-sm btn-success"><i class="ri-settings-4-line"></i></a>
                                                <a href="javascript:void(0)"
                                                   data-url={{route('courses.delete', ['id'=>$datas->id]) }} data-id={{ $datas->id }} class="btn
                                                   btn-sm btn-danger" id="delete_course"><i
                                                    class="ri-delete-bin-2-fill"></i></a>
                                            </div>
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
            $('.switchStatus').change(function () {
                var status = $(this).prop('checked');
                var id = $(this).attr('data-id');

                $.get("{{route('courses.switch')}}", { id: id, status: status }, function (data) {
                    if (data.success) {
                        console.log('Status updated successfully');
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

