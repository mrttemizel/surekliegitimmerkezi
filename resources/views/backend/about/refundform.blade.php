@extends('backend.components.master')
@section('title')
    Ücret İade Formları
@endsection

@section('css')
    <link href="{{asset('backend/assets/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('backend/assets/libs/bootstrap-toogle/bootstrap-toggle.min.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    @component('backend.components.breadcrumb')
        @slot('li_1')
            Ücret İade Formları
        @endslot
        @slot('title')
            Ücret İade Formlar Listesi
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Form Ekle</h4>
                </div>
                <form action="{{route('refundform.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="live-preview">
                            <div class="row gy-3">
                                <div class="col-md-12">
                                    <div>
                                        <label class="form-label">Form Adı <span class="text-danger">*</span></label>
                                        <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div>
                                        <label class="form-label">Dosya <span class="text-danger">*</span></label>
                                        <input type="file" name="file" class="form-control" required>
                                        @error('file')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="hstack gap-2 d-grid">
                                        <button type="submit" class="btn btn-primary">Ekle</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Formlar Listesi</h4>
                </div>
                <div class="card-body">
                    @if($data->count() > 0)
                        <table class="table nowrap dt-responsive align-middle table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>Dosya</th>
                                    <th>Form Adı</th>
                                    <th>Gösterim</th>
                                    <th>İşlemler</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $item)
                                    <tr>
                                        <td>
                                            @if($item->file && file_exists(public_path('formlar/' . $item->file)))
                                                <a href="{{ asset('formlar/'.$item->file) }}" target="_blank"
                                                   class="btn btn-sm btn-secondary">
                                                    <i class="ri-download-2-fill"></i> İndir
                                                </a>
                                            @else
                                                <span class="text-muted">Dosya Yok</span>
                                            @endif
                                        </td>
                                        <td>{{ $item->name }}</td>
                                        <td>
                                            <input type="checkbox" class="switchStatus"
                                                   data-id="{{ $item->id }}"
                                                   {{ $item->status ? 'checked' : '' }}
                                                   data-toggle="toggle"
                                                   data-on="Aktif"
                                                   data-off="Pasif"
                                                   data-onstyle="success"
                                                   data-offstyle="danger">
                                        </td>
                                        <td>
                                            <div class="hstack gap-3 fs-15">
                                                <button type="button"
                                                        class="btn btn-sm btn-success edit-form"
                                                        data-id="{{ $item->id }}">
                                                    <i class="ri-settings-4-line"></i>
                                                </button>
                                                <button type="button"
                                                        class="btn btn-sm btn-danger"
                                                        id="delete-form"
                                                        data-id="{{ $item->id }}"
                                                        data-url="{{ route('refundform.delete', $item->id) }}">
                                                    <i class="ri-delete-bin-2-fill"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="text-center">
                            <p>Henüz form eklenmemiş.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('refundform.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" id="edit_id">
                    <div class="modal-header">
                        <h5 class="modal-title">Formu Düzenle</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Form Adı <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="edit_name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <div id="current_file"></div>
                            <label class="form-label">Yeni Dosya</label>
                            <input type="file" name="file" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">İptal</button>
                        <button type="submit" class="btn btn-primary">Kaydet</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

    <script src="{{ asset('backend/assets/libs/bootstrap-toogle/bootstrap-toggle.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            // Form düzenleme
            $('.edit-form').click(function() {
                const id = $(this).data('id');
                $.get("{{ route('refundform.getData') }}", { id: id }, function(data) {
                    $('#edit_id').val(data.id);
                    $('#edit_name').val(data.name);
                    $('#editModal').modal('show');
                });
            });

            // Durum değiştirme
            $('.switchStatus').change(function() {
                const id = $(this).data('id');
                const status = $(this).prop('checked');
                $.get("{{ route('refundform.switch') }}", { id: id, status: status });
            });

            // Silme işlemi
            $(document).on('click', '#delete-form', function() {
                var user_id = $(this).data('id');
                const url = $(this).data('url');
                
                Swal.fire({
                    title: 'Emin misiniz?',
                    text: "Bu formu silmek istediğinize emin misiniz?",
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
        });
    </script>
