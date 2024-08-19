@extends('backend.components.master')
@section('title') Dashboard  @endsection
@section('content')
    @component('backend.components.breadcrumb')
        @slot('li_1') Admin @endslot
        @slot('title') Dashboard  @endslot
    @endcomponent

    <div class="row">
        <!-- Pie Chart Section -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h4>Sınıfların Durumu</h4>
                </div>
                <div class="card-body">
                    <canvas id="statusPieChart"></canvas>
                </div>
                <div class="card-footer">
                    <p>Eklenen sınıfların statusune göre gösterimin yapıldığı bir grafiktir.</p>
                </div>
            </div>
        </div>

        <!-- Bar/Line Chart Section -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Ay Bazlı Öğrenci Kayıtı</h4>
                </div>
                <div class="card-body">
                    <canvas id="monthlyStudentsChart"></canvas>
                </div>
                <div class="card-footer">
                    <p>Eklenen öğrenci sayısının yıl ve ay olarak görterimin yapıldığı grafiktir.</p>
                </div>
            </div>
        </div>
    </div>
@endsection


