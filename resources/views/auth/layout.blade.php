<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Document</title>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/auth/auth.css') }}" rel="stylesheet">

</head>

<body>
<div class=" pr-sm-5 pr-md-5 pl-sm-5 d-flex justify-content-center align-items-center vh-100">
    <div class="bg-white form shadow rounded-right d-flex w-100">

        @yield('content')


    </div>


</div>
</body>

</html>
