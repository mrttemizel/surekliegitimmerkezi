
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
