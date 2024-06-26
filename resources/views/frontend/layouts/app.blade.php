<!doctype html>
<html>

<head>
    <title>BrixtonCMM</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('frontend-assets/images/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('frontend-assets/images/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('frontend-assets/images/favicon-16x16.png') }}">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/fontawesome-iconpicker/3.2.0/css/fontawesome-iconpicker.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="{{ asset('frontend-assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend-assets/css/style2.css') }}" rel="stylesheet">
    <link href="{{ asset('dashboard-assets/assets/css/icons.css') }}" rel="stylesheet" />
    @stack('styles')
</head>

<body>
    <main>
        @include('frontend.layouts.header')


        @yield('content')

        @include('frontend.layouts.chat')
        @include('frontend.layouts.footer')
    </main>
</body>

</html>
<script></script>
<script src="{{ asset('dashboard-assets/assets/plugins/jquery/jquery.min.js') }}"></script>
@stack('scripts')
