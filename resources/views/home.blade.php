
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Document</title>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <script src="https://api.mapbox.com/mapbox-gl-js/v1.10.0/mapbox-gl.js"></script>
    <link href="https://api.mapbox.com/mapbox-gl-js/v1.10.0/mapbox-gl.css" rel="stylesheet" />


    <style>
        *{
            font-family: "Segoe UI";

        }
    </style>
</head>

<body>

    <div id="app">
        <header-component></header-component>
        <footer-component></footer-component>
    </div>

    <script src='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v3.1.3/mapbox-gl-directions.js'></script>
    <link rel='stylesheet' href='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v3.1.3/mapbox-gl-directions.css' type='text/css' />
</body>

</html>
