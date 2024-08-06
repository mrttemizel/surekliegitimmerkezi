@extends('backend.components.master')
@section('title')
    Slider
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
            Slider
        @endslot
        @slot('title')
            Slider Listesi
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">Slider Listesi</h5>
                            <a href="{{ route('slider.create') }}" class="btn btn-primary waves-effect waves-light d-flex justify-content-between"><i class="ri-add-box-line"></i> &nbsp; Yeni Slider Ekle</a>

                        </div>
                        <div class="card-body">
                            <table id="alternative-pagination" class="table nowrap dt-responsive align-middle table-hover table-bordered" style="width:100%">
                                <thead>
                                <tr>
                                    <th>Sıralama</th>

                                    <th>Slider Resmi</th>
                                    <th>Slider Mobil Resmi</th>
                                    <th>Slider Ust Başlık </th>
                                    <th>Slider Durumu</th>
                                    <th>Düzenle</th>
                                </tr>
                                </thead>
                                <tbody id="orders">

                                @foreach($data as $datas)

                                    <tr id="slider_{{$datas->id}}">
                                        <td style="width: 3%!important;"><i class="ri-drag-move-fill ri-2x handle" style="cursor: move"></i></td>

                                        <td style="width: 10%"><img src="{{ asset('slider/'.$datas->image)}}" alt="" class="rounded-circle avatar-sm"></td>
                                        <td style="width: 10%"><img src="{{ asset('slider/'.$datas->image_mobil)}}" alt="" class="rounded-circle avatar-sm"></td>
                                        <td>{{ $datas->slider_ust_baslik ?? 'Değer girişmemiş' }}</td>
                                        <td><input class="switchStatus" data-id={{ $datas->id }} type="checkbox" {{$datas->status == 0 ? '' : 'checked' }} data-toggle="toggle" data-on="Aktif" data-off="Pasif" data-onstyle="success" data-offstyle="danger"></td>

                                        <td>
                                            <div class="hstack gap-3 fs-15">
                                                <a href="{{route('slider.edit', ['id' => $datas->id])}}" class="link-primary"><i class="ri-settings-4-line"></i></a>
                                                <a href="javascript:void(0)" data-url={{route('slider.delete', ['id'=>$datas->id]) }} data-id={{ $datas->id }} class="link-danger" id="delete_slider"><i class="ri-delete-bin-5-line"></i></a>                                                </div>
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

        $('#orders').sortable({
            handle:'.handle',
            update:function (){
             var siralama = $('#orders').sortable('serialize');
             $.get("{{route('slider.orders')}}?"+siralama,function (data,status){
                 toastr.success('Güncelleme Başarılı');
             });
            }
        });


        $(function (){
            $('.switchStatus').change(function (){
                var status = $(this).prop('checked');
                var id=$(this).attr('data-id');

                $.get("{{route('slider.switch')}}",{id:id,status:status}, function (data,status){

                });
            });

        })


        $(document).on('click', '#delete_slider', function () {
            var user_id = $(this).attr('data-id');
            const url = $(this).attr('data-url');
            Swal.fire({
                title: 'Emin misiniz?',
                text: "Bu slider silmek istediğinize emin misiniz?",
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

