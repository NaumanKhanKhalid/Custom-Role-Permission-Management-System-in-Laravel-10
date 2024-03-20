<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>

    <!-- Meta data -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta content=" name=" description">
    <meta content="" name="author">
    <meta name="keywords" content="">

    <!-- Title -->
    <title>Login</title>

    <!--Favicon -->
    <link rel="icon" href="{{ asset('dashboard-assets/assets/images/brand/favicon.ico')}}" type="image/x-icon">

    <!-- Bootstrap css -->
    <link href="{{ asset('dashboard-assets/assets/plugins/bootstrap/css/bootstrap.css')}}" rel="stylesheet">

    <!-- Style css -->
    <link href="{{ asset('dashboard-assets/assets/css/style.css')}}" rel="stylesheet">
    <link href="{{ asset('dashboard-assets/assets/css/boxed.css')}}" rel="stylesheet">
    <link href="{{ asset('dashboard-assets/assets/css/dark.css')}}" rel="stylesheet">
    <link href="{{ asset('dashboard-assets/assets/css/skin-modes.css')}}" rel="stylesheet">

    <!-- Animate css -->
    <link href="{{ asset('dashboard-assets/assets/css/animated.css')}}" rel="stylesheet">

    <!---Icons css-->
    <link href="{{ asset('dashboard-assets/assets/css/icons.css')}}" rel="stylesheet">


    <!-- Notifications  Css -->
    <link href="{{ asset('dashboard-assets/assets/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />
    <!-- INTERNAL Time picker css -->
    <!-- Select2 css -->
    <link href="{{ asset('dashboard-assets/assets/plugins/select2/select2.min.css')}}" rel="stylesheet">

    <!-- P-scroll bar css-->
    <link href="{{ asset('dashboard-assets/assets/plugins/p-scrollbar/p-scrollbar.css')}}" rel="stylesheet">

</head>

<body>

    @yield('content')

    <!-- Jquery js-->
    <script src="{{ asset('dashboard-assets/assets/plugins/jquery/jquery.min.js')}}"></script>

    <!-- Bootstrap js-->
    <script src="{{ asset('dashboard-assets/assets/plugins/bootstrap/js/popper.min.js')}}"></script>
    <script src="{{ asset('dashboard-assets/assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>

    <!-- Select2 js -->
    <script src="{{ asset('dashboard-assets/assets/plugins/select2/select2.full.min.js')}}"></script>

    <!-- P-scroll js-->
    <script src="{{ asset('dashboard-assets/assets/plugins/p-scrollbar/p-scrollbar.js')}}"></script>
    <!-- Notifications js -->
    <script src="{{ asset('dashboard-assets/assets/plugins/notify/js/notifIt.js') }}"></script>
    <!-- Custom js-->
    <script src="{{ asset('dashboard-assets/assets/js/custom.js') }}"></script>


    @if (Session::has('success'))
    <script>
        notif({
                    msg: "<b><i class='fa fa-check fs-20 me-2'></i></b> {!! Session::get('success') !!}",
                    type: "success"
                });
    </script>
    @endif
    @if (Session::has('error'))
    <script>
        notif({
                    msg: "<b><i class='fa fa-exclamation-circle fs-20 me-2'></i></b> {!! Session::get('error') !!}",
                    type: "error"
                });
    </script>
    @endif

    @if ($errors->any())
@foreach ($errors->all() as $error)
<script>
    notif({
        msg: "<b><i class='fa fa-exclamation-circle fs-20 me-2'></i></b> {!! $error !!}",
        type: "error"
    });
</script>
@endforeach
@endif


</body>

</html>