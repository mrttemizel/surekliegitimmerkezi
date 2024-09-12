@php
    use Carbon\Carbon;
@endphp
@extends('backend.components.master')
@section('title')
    Eğitimler
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
                            <a href="{{ route('courses.create') }}" class="btn btn-primary waves-effect waves-light d-flex justify-content-between"><i class="ri-add-box-line"></i> &nbsp; Yeni Eğitim Ekle</a>

                        </div>
                        <div class="card-body">
                            <table id="alternative-pagination" class="table nowrap dt-responsive align-middle table-hover table-bordered" style="width:100%">
                                <thead>
                                <tr>
                                    <th>Eğitim Resmi</th>
                                    <th>Eğitim Adı </th>
                                    <th>Eğitim Kategorisi </th>
                                    <th>Eğitim Durumu</th>
                                    <th>Düzenle</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($data as $datas)

                                    <tr>
                                        <td style="width: 10%"><img src="{{ $datas->image ? asset('courses/'.$datas->image) : asset('courses/no_name.jpg') }}" alt="" class="rounded-circle avatar-xs"></td>
                                        <td>{{ $datas->egitim_adi ?? 'Değer girişmemiş' }}</td>
                                        <td>{{ $datas->getCategory->name ?? 'Değer girişmemiş' }}</td>
                                        <td><input class="switchStatus" data-id={{ $datas->id }} type="checkbox" {{$datas->status == 0 ? '' : 'checked' }} data-toggle="toggle" data-on="Aktif" data-off="Pasif" data-onstyle="success" data-offstyle="danger"></td>
                                        <td>
                                            <div class="hstack gap-3 fs-15">
                                                <a href="{{route('courses.edit', ['id' => $datas->id])}}" class="btn btn-sm btn-success"><i class="ri-settings-4-line"></i></a>
                                                <a href="javascript:void(0)" data-url={{route('courses.delete', ['id'=>$datas->id]) }} data-id={{ $datas->id }} class="btn btn-sm btn-danger" id="delete_course"><i class="ri-delete-bin-2-fill"></i></a>                                                </div>
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
        $(function (){
            $('.switchStatus').change(function (){
            var status = $(this).prop('checked');
            var id=$(this).attr('data-id');

            $.get("{{route('courses.switch')}}",{id:id,status:status}, function (data,status){

                });
            });

        })

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

