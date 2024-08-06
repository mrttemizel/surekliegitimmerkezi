@extends('backend.components.master')
@section('title')
    Kullanıcı Listesi
@endsection
@section('css')
    <link href="{{asset('backend/assets/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />

    <!--datatable css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <!--datatable responsive css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">

@endsection
@section('content')
    @component('backend.components.breadcrumb')
        @slot('li_1')
            Kullanıcılar
        @endslot
        @slot('title')
            Kullanıcı Listesi
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
                                <h5 class="card-title mb-0">Kullanıcı Listesi</h5>
                                <a href="{{ route('users.create') }}" class="btn btn-primary waves-effect waves-light d-flex justify-content-between"><i class="ri-add-box-line"></i> &nbsp; Yeni Kullanıcı Ekle</a>

                            </div>
                            <div class="card-body">
                                <table id="alternative-pagination" class="table nowrap dt-responsive align-middle table-hover table-bordered" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>SR No.</th>
                                        <th>Profil Resmi</th>
                                        <th>Ad Soyad</th>
                                        <th>E-Posta</th>
                                        <th>Telefon</th>
                                        <th>Kullanıcı Rolü</th>
                                        <th>Düzenle</th>
                                    </tr>
                                    </thead>
                                    <tbody
                                    @php $i = 0 @endphp
                                    @foreach($data as $datas)
                                        @php $i++ @endphp
                                        <tr>
                                            <td>{{$i}}</td>
                                            <td><img src="@if ($datas->image != '') {{ asset('users/'.$datas->image)  }}@else{{ asset('backend/my-image/no-image.svg') }} @endif" alt="" class="rounded-circle avatar-xxs"></td>
                                            <td>{{$datas->name}}</td>
                                            <td>{{$datas->email}}</td>
                                            <td>{{$datas->phone}}</td>
                                            @if ($datas->status == 1 )
                                                <td><h6 class="text-success fs-13 mb-0">Yönetici</h6></td>
                                            @elseif($datas->status == 2 )
                                                <td><h6 class="text-success fs-13 mb-0">Kullanıcı</h6></td>
                                            @endif
                                            <td>
                                                <div class="hstack gap-3 fs-15">
                                                    <a href="{{route('users.edit', ['id' => $datas->id])}}" class="link-primary"><i class="ri-settings-4-line"></i></a>
                                                    <a href="javascript:void(0)" data-url={{route('users.delete', ['id'=>$datas->id]) }} data-id={{ $datas->id }} class="link-danger" id="delete_user"><i class="ri-delete-bin-5-line"></i></a>                                                </div>
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

    <script>
        $(document).on('click', '#delete_user', function () {
            var user_id = $(this).attr('data-id');
            const url = $(this).attr('data-url');
            Swal.fire({
                title: 'Emin misiniz?',
                text: "Bu kullanıcıyı silmek istediğinize emin misiniz?",
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

