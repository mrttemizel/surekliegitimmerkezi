@extends('backend.components.master')
@section('title')
    Tüm Öğrencilerin Listesi Öğrenciler Listesi
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
<style>
    .pagination .page-link {
        padding: 0.5rem 1rem;
        font-size: 1rem; /* Adjust this if needed */
    }

    .pagination .page-item.active .page-link {
        background-color: #007bff;
        border-color: #007bff;
        color: white;
    }

    .pagination .page-item .page-link {
        border: 1px solid #dee2e6;
    }

    .pagination .page-link span {
        font-size: 1rem; /* Adjust the size of the arrow */
    }
</style>
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
                <div class="alert alert-success alert-dismissible fade show">
                    <strong>{{ session()->get('success') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if (session()->get('error'))
                <div class="alert alert-danger alert-dismissible fade show">
                    <strong>{{ session()->get('error') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="card">
                <div class="row mb-3">
                    <form id="filterForm" class="mb-3 row">
                        <div class="col-md-3 mb-2">
                            <input type="text" class="form-control" id="filterTc" name="tc"
                                   value="{{ request()->get('tc') }}" placeholder="TC">
                        </div>
                        <div class="col-md-3 mb-2">
                            <input type="text" class="form-control" id="filterName" name="name"
                                   value="{{ request()->get('name') }}" placeholder="Adı Soyadı">
                        </div>
                        <div class="col-md-3 mb-2">
                            <select class="form-select" id="filterEgitim" name="egitim">
                                <option selected disabled>Eğitim Seç</option>
                                @foreach($coursesData as $course)
                                    <option
                                        value="{{ $course->egitim_adi }}" {{ request()->get('egitim') == $course->egitim_adi ? 'selected' : '' }}>{{ $course->egitim_adi }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 mb-2">
                            <select class="form-select" id="filterSinif" name="sinif">
                                <option selected disabled>Sınıf Seç</option>
                                @foreach($classData as $class)
                                    <option
                                        value="{{ $class->sinif_adi }}" {{ request()->get('sinif') == $class->sinif_adi ? 'selected' : '' }}>{{ $class->sinif_adi }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 mb-2">
                            <button type="submit" id="filterButton" class="btn btn-primary">Filtrele</button>
                            <button type="button" id="resetButton" class="btn btn-secondary">Filtreyi Sıfırla</button>
                        </div>
                    </form>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Adı Soyadı</th>
                            <th>Barcode</th>
                            <th>TC</th>
                            <th>Sınıf</th>
                            <th>Eğitim</th>
                            <th>Adres</th>
                            <th>KVKK</th>
                            <th>Başarı Durumu</th>
                            <th>İndir</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($classLists as $classList)
                            <tr>
                                <td>{{ $classList->id }}</td>
                                <td>{{ $classList->name . ' ' . $classList->surname }}</td>
                                <td>{{ $classList->barcode ?? 'Sertifika Henüz Oluşmamış' }}</td>
                                <td>{{ $classList->tc }}</td>
                                <td>{{ $classList->getSinif->sinif_adi ?? 'Değer girişmemiş' }}</td>
                                <td>{{ $classList->kurs_adi }}</td>
                                <td>{{$classList->address}}</td>
                                <td>
                                    @if($classList->kvkk)
                                        <span style="color: green; font-weight: bold;">Onaylı</span>
                                    @else
                                        <span style="color: red; font-weight: bold;">Onaysız</span>
                                    @endif
                                </td>
                                <td>
                                    <input type="checkbox" class="switchStatus"
                                           data-id="{{ $classList->id }}" {{ $classList->status ? 'checked' : '' }}>
                                </td>
                                <td>
                                    @if(!empty($classList->sertificate))
                                        <a href="{{ asset($classList->sertificate) }}" class="btn btn-sm btn-primary" target="_blank">
                                            <i class="ri-file-download-line"></i> İndir
                                        </a>
                                    @else
                                        Sertifika Yok
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">
                        <li class="page-item {{ $classLists->onFirstPage() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $classLists->previousPageUrl() }}" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        @for ($i = 1; $i <= $classLists->lastPage(); $i++)
                            <li class="page-item {{ $classLists->currentPage() == $i ? 'active' : '' }}">
                                <a class="page-link" href="{{ $classLists->url($i) }}">{{ $i }}</a>
                            </li>
                        @endfor
                        <li class="page-item {{ $classLists->hasMorePages() ? '' : 'disabled' }}">
                            <a class="page-link" href="{{ $classLists->nextPageUrl() }}" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
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
    <!-- Include DataTables CSS and JS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>

    <script src="{{ asset('backend/assets/libs/bootstrap-toogle/bootstrap-toggle.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        $(document).ready(function () {
            // Filter button click event
            $('#filterButton').on('click', function () {
                const tc = $('#filterTc').val();
                const name = $('#filterName').val();
                const egitim = $('#filterEgitim').val();
                const sinif = $('#filterSinif').val();

                // Redirect with filters
                window.location.href = `{{ route('class.all-list') }}?tc=${tc}&name=${name}&egitim=${egitim}&sinif=${sinif}`;
            });
        });
        document.getElementById('resetButton').addEventListener('click', function() {
            document.getElementById('filterTc').value = '';
            document.getElementById('filterName').value = '';
            document.getElementById('filterEgitim').selectedIndex = 0;
            document.getElementById('filterSinif').selectedIndex = 0;
            document.getElementById('filterForm').submit();  // Submit the form to reset filters
        });
    </script>
@endsection
