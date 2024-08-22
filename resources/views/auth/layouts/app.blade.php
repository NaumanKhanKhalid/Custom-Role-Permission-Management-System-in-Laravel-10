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
    <link rel="icon" href="" type="image/x-icon">
    <link href="{{ asset('dashboard-assets/assets/plugins/bootstrap/css/bootstrap.css')}}" rel="stylesheet">
    <link href="{{ asset('dashboard-assets/assets/css/style.css')}}" rel="stylesheet">
    <link href="{{ asset('dashboard-assets/assets/css/icons.css')}}" rel="stylesheet">
</head>

<body>

    @yield('content')

    <!-- Jquery js-->
    <script src="{{ asset('dashboard-assets/assets/plugins/jquery/jquery.min.js')}}"></script>

    @if ($errors->any())
        @foreach ($errors->all() as $index => $error)
            <script>
                flasher.error('{{ $error }}').priority({{ $loop->index + 1 }});
            </script>
        @endforeach
    @endif


</body>

</html>
