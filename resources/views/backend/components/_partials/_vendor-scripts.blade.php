
<!-- JAVASCRIPT -->

<script src="{{asset('backend/assets/js/jquery-3.7.0.min.js')}}"></script>
<script src="https://code.jquery.com/ui/1.13.3/jquery-ui.js"></script>

<script src="{{asset('backend/assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('backend/assets/libs/simplebar/simplebar.min.js')}}"></script>
<script src="{{asset('backend/assets/libs/node-waves/waves.min.js')}}"></script>
<script src="{{asset('backend/assets/libs/feather-icons/feather.min.js')}}"></script>
<script src="{{asset('backend/assets/js/pages/plugins/lord-icon-2.1.0.js')}}"></script>
<script src="{{asset('backend/assets/libs/toastify-js/toastr.min.js')}}"></script>
<script src="{{asset('backend/assets/libs/toastify-js/toastify-js.js')}}"></script>
<script src="{{asset('backend/assets/js/plugins.min.js')}}"></script>

<script src="{{asset('backend/assets/js/app.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
<script>
    @if(Session::has('message'))

        toastr.options.positionClass = 'toast-bottom-right';
        toastr.options.closeButton = 'true';
        toastr.options.progressBar = 'true';
        toastr.options.timeOut = '2500';

    var type="{{Session::get('alert-type'),'info'}}"
    switch (type){
        case 'info':
            toastr.info("{{Session::get('message')}}");
            break;

        case 'success':
            toastr.success("{{Session::get('message')}}");
            break;

        case 'warning':
            toastr.warning("{{Session::get('message')}}");
            break;

        case 'error':
            toastr.error("{{Session::get('message')}}");
            break;

    }

    @endif

</script>
@yield('addjs')
