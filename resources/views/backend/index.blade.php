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
@section('addjs')
<script>
    // Pie Chart Script
    var ctxPie = document.getElementById('statusPieChart').getContext('2d');
    var statusPieChart = new Chart(ctxPie, {
        type: 'pie',
        data: {
            labels: ['Tamamlanan', 'Devam Eden'],
            datasets: [{
                data: [{{ $statusCounts['tamamlanan'] }}, {{ $statusCounts['devam_eden'] }}],
                backgroundColor: ['#28a745', '#ffc107'],
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
            }
        }
    });

    // Bar/Line Chart Script
    var ctxLine = document.getElementById('monthlyStudentsChart').getContext('2d');
    var monthlyStudentsChart = new Chart(ctxLine, {
        type: 'bar', // or 'line' for a line chart
        data: {
            labels: {!! json_encode(array_keys($monthlyCounts)) !!},
            datasets: [{
                label: 'Number of Students',
                data: {!! json_encode(array_values($monthlyCounts)) !!},
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1,
                fill: true,
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1,
                    }
                }
            },
            plugins: {
                legend: {
                    position: 'top',
                },
            }
        }
    });
</script>
@endsection
